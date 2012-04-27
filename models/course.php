<?php
namespace Studip\Mobile;


class Course {
    static function findAllByUser($user_id)
    {
        foreach (\SemesterData::GetSemesterArray() as $key => $value){
            if (isset($value['beginn']) && $value['beginn'])
                $sem_start_times[] = $value['beginn'];
        }

        $sem_number_sql = "INTERVAL(start_time," . join(",",$sem_start_times) .")";
        $sem_number_end_sql = "IF(duration_time=-1,-1,INTERVAL(start_time+duration_time," . join(",",$sem_start_times) ."))";

        $query = "SELECT seminare.VeranstaltungsNummer AS sem_nr, schedule_seminare.color AS color, seminare.Name, seminare.Seminar_id, seminare.status as sem_status, 
                         seminar_user.status, seminar_user.gruppe, seminare.chdate, seminare.visible, admission_binding,modules,IFNULL(visitdate,0) as visitdate, 
                         admission_prelim, {$sem_number_sql} as sem_number, {$sem_number_end_sql} as sem_number_end $add_fields
                FROM seminar_user LEFT 
                JOIN seminare  USING (Seminar_id)
                LEFT JOIN schedule_seminare      ON (schedule_seminare.user_id='$user_id'   AND schedule_seminare.seminar_id=seminare.Seminar_id)
                LEFT JOIN object_user_visits ouv ON (ouv.object_id=seminar_user.Seminar_id  AND ouv.user_id='$user_id' AND ouv.type='sem')
                $add_query
                WHERE seminar_user.user_id = '$user_id'";

        $stmt = \DBManager::get()->query($query);

        return $stmt->fetchAll();
    }

    static function find($id)
    {
        return new Course($id);
    }

    static function get_token( $user_id )
    {
        $query ="       SELECT *
                        FROM dropbox_tokens
                        WHERE           dropbox_tokens.user_id =  '$user_id'
			";

	$stmt = \DBManager::get()->query($query);
	return $stmt->fetchAll();
    }

    static function find_files( $id = null )
    {
	$db = \DBManager::get();
        $files = array();

        $query ="       SELECT *
                        FROM Dokumente
                        WHERE           Dokumente.seminar_id =  '$id'
                        ORDER BY mkdate
			LIMIT 0,30
			";
        
        $result = $db->query($query);
        foreach ($result as $row) 
        {
	    // getLink
	    $link = $row['url'];
	    if (($row['url'] == "") OR(!$row['url']) )
	    {
		$link    = GetDownloadLink($row['dokument_id'], $row['filename'], 0,'force_download');
	    }
	
	    // get file extension
	    $path_parts = pathinfo($row['filename']);
	    $extension  = strtoupper($path_parts['extension']);
	    //get extension icon
	    switch($extension)
	    {
		case "PDF":
			$icon_link= "/public/images/icons/files32/pdf.png";
			break;     
		case "XLS":        
			$icon_link= "/public/images/icons/files32/xls.png";
			break;     
		case "PPT":        
			$icon_link= "/public/images/icons/files32/ppt.png";
			break;     
		case "ZIP":        
			$icon_link= "/public/images/icons/files32/zip.png";
			break;     
		case "RTF":        
			$icon_link= "/public/images/icons/files32/rtf.png";
			break;     
		case "TXT":        
			$icon_link= "/public/images/icons/files32/txt.png";
			break;     
		case "TGZ":        
			$icon_link= "/public/images/icons/files32/tgz.png";
			break;     
		default:           
			$icon_link= "/public/images/icons/files32/_blank.png";
	    }
            $files[] = array(
                'id'            => $row['dokument_id'],
                'name'          => $row['name'],
		'Seminar_id'    => $row['seminar_id'],
                'author'        => $row['author_name'],
                'author_id'     => $row['user_id'],
                'description'   => $row['description'],
                'mkdate'        => $row['mkdate'],
                'filesize'      => $row['filesize'],
		'link'	        => $link,
		'filename'      => $row['filename'],
		'icon_link'      => $icon_link,
		'extension'     => $extension
            );
        }

	return $files;
    }

    function __construct($id)
    {
        $this->delegate = new \Seminar($id);
    }

    function __get($key)
    {
        return $this->delegate->$key;
    }

    function isAuthorized($user_id)
    {
        return true;
    }
}
