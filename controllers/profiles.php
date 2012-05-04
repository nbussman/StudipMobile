<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/profile.php";

use Studip\Mobile\Activity;

class ProfilesController extends StudipMobileController
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
        $this->profile = Profile::finduser( $this->currentUser()->id );
    }
}
