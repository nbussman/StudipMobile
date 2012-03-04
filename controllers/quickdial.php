<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/quickdail.php";

use Studip\Mobile\Quickdail;

class QuickdialController extends StudipMobileController
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
	// get next 5 courses of the day
	$this->next_courses 		=	Quickdail::get_next_courses( $this->currentUser()->id );
        

	// get numbers of new mails
	$this->number_unread_mails 	=	Quickdail::get_number_unread_mails( $this->currentUser()->id );

	
    }
}
