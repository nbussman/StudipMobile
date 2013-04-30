<?php
namespace Studip\Mobile;

$RELATIVE_PATH_CALENDAR = $GLOBALS['RELATIVE_PATH_CALENDAR'];
require_once(  $GLOBALS['RELATIVE_PATH_CALENDAR'] . "/lib/DbCalendarMonth.class.php" );


class calendarModel {
	static function getMonthDates($user_id, $timestamp)
	{
		$_calendar = \Calendar::getInstance($user_id);
		// hat leserechte : $_calendar->havePermission( 2 )
		$cal = new \DbCalendarMonth($_calendar, $timestamp, null, \Calendar::getBindSeminare($user_id) );

		$start_stamp   = $cal->getStart();
		$end_stamp     = $cal->getEnd();
		$daily_seconds = 86400;  //secound of a single day
		$monthDates    =  array();
		$act_stamp      = $start_stamp;
		$i=0;
		while ($act_stamp <= $end_stamp)
		{
			$event = $cal->getEventsOfDay($act_stamp);  
			if ($event!= NULL)
			{ 
				foreach ($event as $key => $value) 
				{
					if (($value != NULL) && (is_object($value)))
					{
						//if is type of CalendarEvent .... 
						if (is_a($value, 'CalendarEvent') || is_a($value, 'SeminarEvent'))
						{
							if ($value->getPermission() >= 2)
							{
									$monthDates[$i][$key]["title"] =  $value->getTitle ();
									$monthDates[$i][$key]["start"] =  date("G:i", $value->getStart());
									$monthDates[$i][$key]["end"] =  date("G:i", $value->getEnd());
									$monthDates[$i][$key]["description"] =  $value->getDescription();
									$monthDates[$i][$key]["duration"] =  date('H:i', $value->getDuration());
									$monthDates[$i][$key]["location"] =  $value->getLocation();
							}
						}                            
					}
					else
					{
						$monthDates[$i][$key] = NULL;
					}
				}
			}
			else
			{
				$monthDates[$i] = NULL;
			}
			$i++;
			$act_stamp += $daily_seconds;

		}
		// var_dump($monthDates);exit();
		return $monthDates;
	}

	static function getMonthDayCounts($monthevents)
	{
			$MonthDayCounts = array();
			foreach ($monthevents as $key => $value) 
			{
				$MonthDayCounts[$key] = count($value);
			}
			return $MonthDayCounts;
	}

	static function getMonthDayCountsRaw($user_id, $timestamp)
	{
			$monthevents = calendarModel::getMonthDates($user_id, $timestamp);
			$MonthDayCounts = array();

			foreach ($monthevents as $key => $value) 
			{
				$MonthDayCounts[$key] = count($value);
			}
			return $MonthDayCounts;
	}
	
	static function getDayDates($user_id, $weekday)
	{
		//get current semester
		$semdata 							= new \SemesterData();
		$current_semester			= $semdata->getCurrentSemesterData();
		$current_semester_id 	= $current_semester['semester_id'];
		
		return \CalendarScheduleModel::getEntries($user_id, $current_semester, 0800 ,2000,array($weekday-1),false);
	}
	
	static function getCalendarEvents($user_id, $month, $year)
	{
		$db = \DBManager::get();
		$query ="SELECT *
						FROM calendar_events
						WHERE           message.message_id   =  '$msg_id'
										AND     message_user.user_id <> message.autor_id
										AND     message_user.deleted =  '0'
						LIMIT 0,1";
		
		$result = $db->query($query);
		foreach ($result as $row) 
		{
				$items[] = array(
						'id'				=> $row['message_id'],
						'title'			=> $row['subject'],
						'author'		=> $row['vorname'] . ' ' . $row['nachname'],
						'author_id'	=> $row['autor_id'],
						'message'		=> $row['message'],
						'mkdate'		=> $row['mkdate'],
						'receiver'	=> get_fullname($row['receiver'])
				);
		}

	}
}
