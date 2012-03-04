<?php

namespace Studip\Mobile;

class Quickdail {
    static function get_number_unread_mails( $user_id )
    {
	    $items = array();
            $db = \DBManager::get();
            
            $query ="       SELECT COUNT(*)
                            FROM message_user
                            WHERE           user_id =  '$user_id '
                                    AND     readed  = 0
				    AND     deleted = 0
				    AND     snd_rec = 'rec'";
            
            $result = $db->query($query);
	    foreach ($result as $row) 
            {

	  		$ausgabe=$row[0];
	    }
            return $ausgabe;
    }
	
    static function get_next_courses( $user_id )
    {
	$items = array();
        $db = \DBManager::get();

	$semester = \SemesterData::getCurrentSemesterData();
	$semester_begin = $semester["beginn"];
	$semester_ende  = $semester["ende"];

	$today =date("N");
	
	// !!! bisher ohne cycling, kein Dozent
	// !! bisher die ersten 5 in der woche
	// was ist cycle bzw weekoffset inseminar seminar_cycle_dates
	$fields= "seminar_user.Seminar_id 		AS Seminar_id,
		  seminar_user.user_id,
		  seminar_user.visible,
	 	  seminare.Seminar_id,
		  seminare.start_time,
		  seminare.Name				AS name,
		  seminar_cycle_dates.start_time 	AS beginn,
		  seminar_cycle_dates.end_time		AS ende,
		  seminar_cycle_dates.start_time,	
		  seminar_cycle_dates.weekday		AS weekday,
		  seminar_cycle_dates.seminar_id,
		  seminar_cycle_dates.description	AS description
		 ";
	$query = "SELECT $fields
		  FROM  seminar_user
		  JOIN  seminare ON seminar_user.Seminar_id = seminare.Seminar_id
		  JOIN  seminar_cycle_dates ON seminar_user.Seminar_id = seminar_cycle_dates.seminar_id
		  WHERE     seminar_user.user_id = '$user_id' 
		  	AND seminar_user.visible = 'yes'
		        AND seminare.start_time  >= '$semester_begin'
		  ORDER BY seminar_cycle_dates.weekday, seminar_cycle_dates.start_time	
		  LIMIT 0, 5
		 ";
	$result = $db->query($query);
	
	foreach($result as $row)
	{
		$items[] = array(
                        'id'            => $row['Seminar_id'],
                        'title'         => $row['name'],
                        'beginn'     	=> substr($row['beginn'], 0, 5),
                        'ende'       	=> substr($row['ende'], 0, 5),
                        'weekday'       => $row['weekday'],
			'description'   => $row['description']
                    );
	}

	return $items;
    }
   
}
