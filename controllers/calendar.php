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
require dirname(__FILE__) . "/../models/calendarModel.php";

use Studip\Mobile\calendarModel;

/**
 *    Get cycle events and dates for schedule and calendar
 *    @author Nils Bussmann - nbussman@uos.de
 */
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
            // if no weekday -> make one
        	if ($weekday == NULL)
        	{
	        	$weekday = date("N");
        	}
            //give weekday to the view
        	$this->weekday = $weekday;
        	//get events for current weekday
            $this->termine = calendarModel::getDayDates($this->currentUser()->id, $weekday);

        }
        function kalender_action($year = NULL, $month = NULL)
        {
            //if no date -> make one
        	if (empty($year) || empty($month))
        	{
	        	$month = date("n");
	        	$year  = date("Y");
        	}
            //make a timestamp for the date
        	$this->stamp = mktime(0,0,0,$month,1, $year);
        	//get dates of the month 
        	$this->dates = calendarModel::getMonthDates( $this->currentUser,$this->stamp );
            //get the dots for each day
            $this->dots = calendarModel::getMonthDayCounts( $this->dates );

        }

}

