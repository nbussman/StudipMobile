<?php
// Copyright (C) 2013  Nils Bussmann

// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program. If not, see <http://www.gnu.org/licenses/>.

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/course.php";

use Studip\Mobile\Course;

/**
 *    get the courses and all combined stuff, like files and 
 *    members ...
 *    @author Nils Bussmann - nbussman@uos.de
 */
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
        // get current semester
        $this->semester = \SemesterData::GetSemesterArray();
        // get all courses
        $this->courses  = Course::findAllByUser($this->currentUser()->id);
    }

    function list_files_action($id = NULL)
    {
        // is the user in the course?
        $course      = Course::find($id);

        if (!Course::isReadable($id, $this->currentUser()->id)) {
            throw new Trails_Exception(403);
        }
        // give seminarId to the view
        $this->seminar_id   = $id;
        // get files as array and give it to the view
        $this->files        = Course::find_files($id, $this->currentUser()->id);
    }
 
    function show_action( $id = NULL )
    {
        // get specific course  
        $this->course      = Course::find($id);
        // get specific ressources for the course
        $this->resources   = Course::getResources($this->course);

        //exception if course is not readable
        if (!$this->course) {
            throw new Trails_Exception(404);
        }
        if (!Course::isReadable($id, $this->currentUser()->id)) {
            throw new Trails_Exception(403);
        }
        
    }

    function show_map_action($id)
    {
        // get specific course object
        $this->course      = Course::find($id);
        // get destinations of the course
        $this->resources   = Course::getResources($this->course);
        if (!Course::isReadable($id, $this->currentUser()->id)) {
            throw new Trails_Exception(403);
        }
    }

    function dropfiles_action( $id = NULL )
    {
        session_start();
        //$call_back_link  = "http://localhost/~nbussman/studip2/public/plugins.php/studipmobile/courses/dropfiles/".$id;
        
        if (!Course::isReadable($id, $this->currentUser()->id)) {
            throw new Trails_Exception(403);
        }
        //generate the callbacklink
        $call_back_link =  "http://".$_SERVER['HTTP_HOST'].$this->url_for("courses/dropfiles", htmlReady($id) );
        // give seminar id to the view
        $this->seminar_id       = $id;
        // get files to sync width the userers dropbox
        // the view starts the upload via ajax
        $this->files            = Course::find_files($id, $this->currentUser()->id);
        // give user_id t the view
        $this->user_id          = $this->currentUser()->id;
        // start the sync prozess
        $this->dropCom          = Course::connectToDropbox( $this->currentUser()->id, $call_back_link );
    }
    /*
     *  this controller function is called by the view via ajax
     *  the user should be connected to dropbox
     */
    function upload_action( $fileid )
    {
        // try to upload a specific file to the users dropboxs
        $this->upload_info = Course::DropboxUpload($fileid);
    }
    
    /*
     *  this controller makes sure that the folder structure
     *  of the specific course is correctly mapped in the 
     *  users dropbox. 
     *  if not: make the structure
     */
    function createDropboxFolder_action( $semId )
    {
        $this->createdFolderInfo = Course::createDropboxFolders( $semId );
    }

    /*
     *  give an array width all members to the view
     */
    function show_members_action( $semId )
    {
        $this->members = Course::getMembers( $semId );
        if (!Course::isReadable($semId, $this->currentUser()->id)) {
            throw new Trails_Exception(403);
        }
    }

    /*
     *  drops all files of all the courses to the users dropbox
     *  !! not implemented right now
     */
    function dropAll_action()
    {
        session_start();
        $call_back_link         = $_SERVER['HTTP_HOST'].$this->url_for("courses/dropfiles", htmlReady($id) );
        $this->files            = Course::finaAllFiles( $this->currentUser()->id );
        $this->user_id          = $this->currentUser()->id;
        $this->courses          = Course::findAllByUser($this->currentUser()->id);
        $this->dropCom          = Course::connectToDropbox( $this->currentUser()->id, $call_back_link );
    }
    function json_courses_action()
    {
        // get current semester
        $this->semester = \SemesterData::GetSemesterArray();
        // get all courses
        $this->courses  = Course::findAllByUser($this->currentUser()->id);
    }
    
    /*
     * @brief Action for sync files width the dropbox
     *        user takens for dropbox sync saved in sql table 
     * @param id the seminar id
     */
    
    // function dropfiles_action( $id = NULL )
    // {
    //     session_start();
    //     $this->seminar_id       = $id;
    //     $this->consumerKey      = Course::getDropboxKey();
    //     $this->consumerSecret   = Course::getDropboxKeySecret();
    //     $this->db_tokens        = Course::get_token($this->currentUser()->id);
    //     $this->files            = Course::find_files($id, $this->currentUser()->id);
    //     $this->user_id          = $this->currentUser()->id;
    // }
}
