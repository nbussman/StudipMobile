<?php

// !!! totaler pfad zum bild -> ändern

class Profile {

    # TODO args?
    static function findUser( $user_id )
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
					JOIN user_studiengang ON auth_user_md5.user_id = user_studiengang.user_id
					JOIN studiengaenge    ON studiengaenge.studiengang_id = user_studiengang.studiengang_id
					JOIN abschluss        ON abschluss.abschluss_id = user_studiengang.abschluss_id
					WHERE auth_user_md5.user_id =  '$user_id'";
        $result = $db->query($query);

	//echo dirname(__FILE__);
	$img_url = "../../pictures/user/".$user_id."_normal.png";
	foreach ($result as $row) 
        {
		$items[] = array(
                        'id'            => $user_id,
                        'name'          => $row['vorname'] . ' ' . $row['nachname'],
			'abschluss'	=> $row['abName'],
			'stg'		=> $row['stgName'],
			'mail'		=> $row['mail'],
			'semester'	=> $row['semester']
                    );
	}
	return $items;
    }

}
?>