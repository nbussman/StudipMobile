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

    function list_files_action($id = NULL)
    {
		$this->seminar_id 	= $id;
        $this->files 		= Course::find_files($id, $this->currentUser()->id);
    }
 
    function show_action( $id = NULL )
    {
    	
        $this->course      = Course::find($id);
        $this->resources   = Course::getResources($this->course);
        //Course::createDropboxFolders($id);
        if (!$this->course) {
            throw new Trails_Exception(404);
        }

        if (!$this->course->isAuthorized($this->currentUser()->id)) {
            throw new Trails_Exception(403);
        }
        
        //Course::getRootResource("51ad4b7100d3a8a1db61c7b099f052a6");
    }

    function show_map_action($id)
    {
	    $this->course      = Course::find($id);
        $this->resources   = Course::getResources($this->course);
    }
    /*
     * @brief Action for sync files width the dropbox
     *        user takens for dropbox sync saved in sql table 
     * @param id the seminar id
     */
    /*
function dropfiles_action( $id = NULL )
    {
    	session_start();
    	$this->seminar_id  		= $id;
    	$this->consumerKey 		= Course::getDropboxKey();
    	$this->consumerSecret 	= Course::getDropboxKeySecret();
    	$this->db_tokens   		= Course::get_token($this->currentUser()->id);
    	$this->files      		= Course::find_files($id, $this->currentUser()->id);
    	$this->user_id	   		= $this->currentUser()->id;
    	
    }
*/
    function dropfiles_action( $id = NULL )
    {
    	session_start();
    	//$call_back_link  = "http://localhost/~nbussman/studip2/public/plugins.php/studipmobile/courses/dropfiles/".$id;
    	echo $call_back_link;
    	$call_back_link = $GLOBALS['ABSOLUTE_URI_STUDIP'].$this->url_for("courses/dropfiles", htmlReady($id) );
    	$this->seminar_id  		= $id;
    	$this->files      		= Course::find_files($id, $this->currentUser()->id);
    	$this->user_id	   		= $this->currentUser()->id;
    	$this->dropCom 			= Course::connectToDropbox( $this->currentUser()->id, $call_back_link );
    }
    
    function upload_action( $fileid )
    {
	    $this->upload_info = Course::DropboxUpload($fileid);
    }
    
    function createDropboxFolder_action( $semId )
    {
        $this->createdFolderInfo = Course::createDropboxFolders( $semId );
    }
    function show_members_action( $semId )
    {
	    $this->members = Course::getMembers( $semId );
    }
}
