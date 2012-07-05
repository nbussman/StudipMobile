<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/activity.php";

use Studip\Mobile\Activity;

class ActivitiesController extends StudipMobileController
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
        $this->activities = Activity::findAllByUser($this->currentUser()->id);
    }
}
