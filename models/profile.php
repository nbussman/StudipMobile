<?php

// !!! totaler pfad zum bild -> ändern
// require evtl nicht möglich!
require_once($STUDIP_BASE_PATH."lib/user_visible.inc.php");
require_once($STUDIP_BASE_PATH."lib/classes/Institute.class.php");


class Profile {

    # TODO args?
    static function findUser_old( $user_id )
    {
	$items = array();
	$db = \DBManager::get();
	$fields           	 = 	'auth_user_md5.user_id,
                           	 auth_user_md5.Vorname        AS vorname,
                           	 auth_user_md5.Nachname       AS nachname,
							 auth_user_md5.Email	      AS mail,
							 user_studiengang.user_id,
							 user_studiengang.studiengang_id,
							 user_studiengang.semester    AS semester,
							 abschluss.abschluss_id,
							 abschluss.name		      AS abName,
							 user_studiengang.abschluss_id,
							 studiengaenge.studiengang_id,
							 studiengaenge.name	      AS stgName
					 ';
	$query 			="SELECT $fields 
					FROM `auth_user_md5` 
					LEFT JOIN user_studiengang ON auth_user_md5.user_id = user_studiengang.user_id
					LEFT JOIN studiengaenge    ON studiengaenge.studiengang_id = user_studiengang.studiengang_id
					LEFT JOIN abschluss        ON abschluss.abschluss_id = user_studiengang.abschluss_id
					WHERE auth_user_md5.user_id =  '$user_id'";
        $result = $db->query($query);

	//echo dirname(__FILE__);
	//$img_url = "../../pictures/user/".$user_id."_normal.png";
	foreach ($result as $row) 
    {
		$items[] = array(
                        'id'            => $user_id,
                        'name'          => $row['vorname'] . ' ' . $row['nachname'],
			            'abschluss'	    => $row['abName'],
			            'stg'		    => $row['stgName'],
			            'mail'		    => $row['mail'],
			            'semester'	    => $row['semester']
                    );
	}
	return $items;
    }
    
    static function findUser( $id )
    {	
    	if (get_visibility_by_id( $id ))
        {
		    $user_data = User::find($id)->getData();
		    
		    if ( ($user_data["visible"]=="no") || ($user_data["visible"]=="never"))		return null;
		    
		    $inst_fields = "Institut_id, user_id, sprechzeiten, raum, Telefon, Fax, visible";
		    $query       = "SELECT $inst_fields FROM `user_inst` WHERE user_inst.user_id = '$id' AND user_inst.externdefault='1'";
		    $stmt 	     = \DBManager::get()->query($query);
	        $user_inst   =  $stmt->fetchAll();
	        
	        if (!empty($user_inst[0]["Institut_id"]))
	        {
		        $inst      = \Institute::find($user_inst[0]["Institut_id"]);
		        $institute = array("inst_name" =>$inst->name, "inst_strasse" => $inst->strasse, 
		        				   "inst_url"=>$inst->url , "inst_plz" => $inst->plz,
		        				   "inst_telefon" => $inst->telefon,"inst_email" => $inst->email,
		        				   "inst_fax" => $inst->fax);
	        }
	        else
	        {$user_inst = null;}
	        
		    
		    
		    return array("user_data"=>$user_data, "user_inst"=>$user_inst[0], "inst_info"=>$institute);
		 }
		 return null;
    }
    

}
?>