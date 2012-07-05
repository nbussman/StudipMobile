<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/course.php";

use Studip\Mobile\Course;

class CoursesController extends StudipMobileController
{
    /**
     * custom before filter (see StudipMobileController#before_filter)
     */
    function before()
    {
        # require a logged in User or else redirect to session/new
        $this->requireUser();
    }

    function index_action()
    {
        $this->semester = \SemesterData::GetSemesterArray();
        $this->courses = Course::findAllByUser($this->currentUser()->id);
    }

    function list_files_action($id = null)
    {
	    $this->seminar_id = $id;
        $this->files = Course::find_files($id);
    }
 
    function show_action( $id = null )
    {
        $this->course     = Course::find($id);
        if (!$this->course) {
            throw new Trails_Exception(404);
        }

        if (!$this->course->isAuthorized($this->currentUser()->id)) {
            throw new Trails_Exception(403);
        }
    }

    function show_map_action()
    {
	    $this->center  = "52.278889, 8.043056";
    	$this->position = array(
                    		'coordinate'  => ' 52.283654, 8.025483',
    				'text'	      => '<h3>Verwaltungsgeb&auml;ude</h3> <small>Universit&auml;t Osnabr&uuml;ck</small>'
    		            );
    }
    /*
     * @brief Action for sync files width the dropbox
     *        user takens for dropbox sync saved in sql table 
     * @param id the seminar id
     */
    function dropfiles_action( $id = null )
    {
    	$this->seminar_id = $id;
    	$this->db_tokens  = Course::get_token($this->currentUser()->id);
    	$this->files      = Course::find_files($id);
    }
    
    function upload_action( $fileid)
    {
	    $this->upload_info = Course::DropboxUpload($fileid);
    }
    
    function createDropboxFolder_action( $semId = null )
    {
        if ($semId != null)
        {
            $this->createdFolderInfo = Course::createDropboxFolders( $semId );
        }
        else
        {
            $this->createdFolderInfo ="Failed:";
        }
    }
}
