<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/activity.php";

use Studip\Mobile\Activity;

/**
 *    ActivitiesController to give newest 
 *    information to the view
 *    @author Marcus Lunzenauer - mlunzena@uos.de
 *    @author André Klaßen - aklassen@uos.de
 *    @author Nils Bussmann - nbussman@uos.de
 */
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

    function index_action($seminar_cur=0)
    {
        $this->activities = Activity::findAllByUser($this->currentUser()->id, $seminar_cur);
    }
}
