<?php
namespace Studip\Mobile;


class CalendarModell {

        static function getMonthDates($user_id, $month, $year)
        {
	        return array(
	        			1 => 3,
	        			2 => 2,
	        			3 => 1,
	        			4 => 0,
	        			5 => 6,
	        			6 => 0,
	        			7 => 2,
	        			8 => 1,
	        			9 => 0,
	        			10 => 6,
	        			11 => 0,
	        			12 => 2,
	        			13 => 1,
	        			14 => 3,
	        			15 => 6,
	        			16 => 0,
	        			17 => 2,
	        			18 => 1,
	        			19 => 0,
	        			20 => 6,
	        			21 => 2,
	        			22 => 1,
	        			23 => 0,
	        			24 => 6,
	        			25 => 0,
	        			26 => 2,
	        			27 => 1,
	        			28 => 0,
	        			29 => 0,
	        			30 => 1,
	        			31 => 4
	        );
        }
        
        static function getDayDates($user_id, $weekday)
        {
        	//get current semester
        	$semdata = new \SemesterData();
        	$current_semester	 = $semdata->getCurrentSemesterData();
        	$current_semester_id = $current_semester['semester_id'];
        	
        	return \CalendarScheduleModel::getEntries($user_id,$current_semester, 0800,2000,array($weekday-1),false);
        }
        
        static function getCalendarEvents($user_id, $month, $year)
        {
	        $db = \DBManager::get();
                   
            $query ="       SELECT *
                            FROM calendar_events
                            WHERE           message.message_id   =  '$msg_id'
                                    AND     message_user.user_id <> message.autor_id
                                    AND     message_user.deleted =  '0'
                            LIMIT 0,1";
            
            $result = $db->query($query);
            foreach ($result as $row) 
            {
                $items[] = array(
                    'id'            => $row['message_id'],
                    'title'         => $row['subject'],
                    'author'        => $row['vorname'] . ' ' . $row['nachname'],
                    'author_id'     => $row['autor_id'],
                    'message'       => $row['message'],
                    'mkdate'        => $row['mkdate'],
                    'receiver'      => get_fullname($row['receiver'])
                );
            }

        }
        
}
