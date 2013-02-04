<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/calendarModel.php";

use Studip\Mobile\CalendarModell;


class CalendarController extends StudipMobileController
{
        /**
         * custom before filter (see StudipMobileController#before_filter)
         */
        function before()
        {
                # require a logged in User or else redirect to session/new
                $this->requireUser();
        }
        
        function index_action($weekday=NULL )
        {
        	if ($weekday == NULL)
        	{
	        	$weekday = date("N");
        	}
        	$this->weekday = $weekday;
        	
            $this->termine = CalendarModell::getDayDates($this->currentUser()->id, $weekday);

        }
        function kalender_action($year = NULL, $month = NULL)
        {
        	if (empty($year) || empty($month))
        	{
	        	$month = date("n");
	        	$year  = date("Y");
        	}
        	$this->stamp = mktime(0,0,0,$month,1, $year);
        	
        	$this->dates = CalendarModell::getMonthDates( $this->currentUser,$this->stamp );
            $this->dots = CalendarModell::getMonthDayCounts( $this->dates );

        }

}

