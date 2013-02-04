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
    	
    	/*

        
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
			 ";
		$result = $db->query($query);
		
		$i = 0;
		foreach($result as $row)
		{
			$i++;
			$items[$i] = array(
	                        'id'            => $row['Seminar_id'],
	                        'title'         => $row['name'],
	                        'beginn'     	=> substr($row['beginn'], 0, 5),
	                        'ende'       	=> substr($row['ende'], 0, 5),
	                        'weekday'       => $row['weekday'],
	                        'description'   => $row['description']
	                    );
		}
*/
		
		//get current semester
    	$semdata = new \SemesterData();
    	$current_semester	 = $semdata->getCurrentSemesterData();
    	$current_semester_id = $current_semester['semester_id'];
    	
    	$entries = \CalendarScheduleModel::getEntries($user_id,$current_semester, 0800,2000, array(0,1,2,3,4,5,6),false) ;

    	
    	$output  = array();
    	$counter = 0;
    	$currentWeekDay =date("N")-1;
    	$currentTime = date("Gi");
    	if (!empty($entries))
    	{
	    	for ($i = 0; $i <= 6; $i++)
			{
				$currentWeekDay +=$i;
				if($currentWeekDay > 6) $currentWeekDay = 0;
				$currentDayObject= $entries[$currentWeekDay];
				if (!empty($currentDayObject))
				{
					//sortieren der einträge des tages
					$arrayObject = new \ArrayObject( $currentDayObject->getEntries() );
					$arrayObject->uasort('Helper::cmpEarlier');
					foreach( $arrayObject->getArrayCopy() AS $entry)
					{
						if ($counter >= 3) 
						{
							break; 
							$i=7; 
						}
						
						if (($entry["start"]>$currentTime) || ($i!=0))
						{
							$output[ $counter ] = array("title"=>$entry["title"], "description"=>$entry["content"], 	
												  	    "beginn"=>$entry["start_formatted"],"ende"=>$entry["end_formatted"],
												  	    "weekday"=>($currentWeekDay+1), "id" => substr($entry["id"], 0, 32) );
							$counter++;
						}
					}
				}
			}
    	}
    	else return null;
		return $output;
		/*
//var_dump($output);
		//nur die nächsten 3 sollen auftauchen
		$currentWeekDay =date("N");
		$i = 0;

		if (!empty($items))
		{
			$ausgabe = array();
			//suchen des nächsten Cycles
			for ($i = 0; $i <= 6; $i++)
			{
				$currentWeekDay +=$i;
				if($currentWeekDay > 7) $currentWeekDay = 1;
				foreach($items AS $item)
				{
					//an dem gesuchten wochentag event ....
					if ($item['weekday'] == $currentWeekDay)
					{
						//nächstes event gefunden
						//Auffinden der nächsten beiden
						$ausgabe[1] = $item;
						$nextitemID = $item['weekday'];
						if (isset($items[ $nextitemID ]))
						{
							//zweites gefunden
							$ausgabe[2] = $items[ 1 ];
							$nextitemID++;
						}
						else
						{
							$ausgabe[2] = $items[ 1 ];
							$nextitemID = 2;
						}
						if (isset($items[ $nextitemID ]))
						{
							//zweites gefunden
							$ausgabe[3] = $items[ 1 ];
						}
						else
						{
							$ausgabe[3] = $items[ 1 ];
						}
						//fertig
						$i=8;
						break;
					}
				}
			}
		}
		else
		{
			return null;
		}
		
		return $ausgabe;
*/
    }
   
}
