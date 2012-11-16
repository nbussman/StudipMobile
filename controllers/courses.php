<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/course.php";
<<<<<<< HEAD
=======

>>>>>>> 3f9395817e821753bae80db600cc893a89fcd3dc
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
<<<<<<< HEAD
    	
        $this->course      = Course::find($id);
        $this->resources   = Course::getResources($this->course);
=======
        $this->course      = Course::find($id);
        $this->resources   = Course::getResourses($this->course);
>>>>>>> 3f9395817e821753bae80db600cc893a89fcd3dc
        //Course::createDropboxFolders($id);
        if (!$this->course) {
            throw new Trails_Exception(404);
        }

        if (!$this->course->isAuthorized($this->currentUser()->id)) {
            throw new Trails_Exception(403);
        }
<<<<<<< HEAD
        
        //Course::getRootResource("51ad4b7100d3a8a1db61c7b099f052a6");
=======
>>>>>>> 3f9395817e821753bae80db600cc893a89fcd3dc
    }

    function show_map_action($id)
    {
	    $this->course      = Course::find($id);
<<<<<<< HEAD
        $this->resources   = Course::getResources($this->course);
=======
        $this->resources   = Course::getResourses($this->course);
>>>>>>> 3f9395817e821753bae80db600cc893a89fcd3dc
    }
    /*
     * @brief Action for sync files width the dropbox
     *        user takens for dropbox sync saved in sql table 
     * @param id the seminar id
     */
    function dropfiles_action( $id = null )
    {
<<<<<<< HEAD
    	$this->seminar_id  = $id;
    	$this->db_tokens   = Course::get_token($this->currentUser()->id);
    	$this->files       = Course::find_files($id);
    	$this->user_id	   = $this->currentUser()->id;
=======
    	$this->seminar_id = $id;
    	$this->db_tokens  = Course::get_token($this->currentUser()->id);
    	$this->files      = Course::find_files($id);
>>>>>>> 3f9395817e821753bae80db600cc893a89fcd3dc
    }
    
    function upload_action( $fileid)
    {
	    $this->upload_info = Course::DropboxUpload($fileid);
    }
    
    function createDropboxFolder_action( $semId )
    {
        $this->createdFolderInfo = Course::createDropboxFolders( $semId );
    }
<<<<<<< HEAD
    function show_members_action( $semId )
    {
	    $this->members = Course::getMemmbers( $semId );
    }
=======
>>>>>>> 3f9395817e821753bae80db600cc893a89fcd3dc
}
