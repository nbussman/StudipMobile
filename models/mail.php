<?php
namespace Studip\Mobile;

require_once $this->trails_root .'/models/course.php';

class Mail {

        static function findAllByUser($user_id, $intervall, $inbox = true)
        {
                return self::get_mails($user_id, $intervall, $inbox);
        }
        
        static function findMsgById($user_id, $msg_id, $mark=0)
        {
                return self::get_mail($user_id, $msg_id, $mark);
        }
        static function deleteMessage( $id, $user_id )
        {
                $db    = \DBManager::get();
                $query = "UPDATE `message_user` 
                          SET deleted = '1' 
                          WHERE     message_user.user_id    ='$user_id' 
                                AND message_user.message_id ='$id'";
                $result = $db->query($query);
        }
        private function get_mail($user_id, $msg_id, $mark=0)
        {
                if ($msg_id == null)
                {
                        return null;
                }
                
                // Nachricht auslesen
                $items = array();
                $db = \DBManager::get();
                
                $user_fields            = 'auth_user_md5.user_id,
                                           auth_user_md5.Vorname        AS vorname,
                                           auth_user_md5.Nachname       AS nachname';
                $msg_fields             = 'message.message_id           AS message_id,
                                           message.message              AS message,
                                           message.subject              AS subject, 
                                           message.autor_id             AS autor_id, 
                                           message.mkdate               AS mkdate';
                $msg_user_fields        = 'message_user.message_id,
                                           message_user.user_id         AS receiver';
                       
                       
                $query ="       SELECT $user_fields, $msg_fields, $msg_user_fields
                                FROM message
                                JOIN auth_user_md5 ON message.autor_id =auth_user_md5.user_id 
                                JOIN message_user USING (message_id)
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
                
                                // 
                                // $db = \DBManager::get();
                                // // Receiver volltext bestimmen
                                // $query ="       SELECT $user_fields
                                //                         FROM   auth_user_md5
                                //                         WHERE  auth_user_md5.user_id = '$items[0]['receiver_id']'
                                //                         LIMIT 0,1";
                                // $result = $db->query($query);
                                // foreach ($result as $row) 
                                // {
                                //         $items[0]['receiver'] = $row['vorname'] . ' ' . $row['nachname'];
                                // }
                                // 
                // als gelesen/ungelesen markieren
                if ($mark == 1)
                {
                    echo "test ..... !";
                    $query2 = "UPDATE `message_user` 
                              SET readed = '0' 
                              WHERE     message_user.user_id    ='$user_id' 
                                    AND message_user.message_id ='$msg_id'";
                }
                else
                {
                    $query2 = "UPDATE `message_user` 
                              SET readed = '1' 
                              WHERE     message_user.user_id    ='$user_id' 
                                    AND message_user.message_id ='$msg_id'";
                }
                $db->query($query2);
                return $items;
        }
        private function get_mails($user_id, $intervall, $inbox = true)
        {
                $items = array();
                $db = \DBManager::get();
                
                $user_fields            = 'auth_user_md5.user_id,
                                           auth_user_md5.Vorname        AS vorname,
                                           auth_user_md5.Nachname       AS nachname';
                $msg_fields             = 'message.message_id           AS message_id,
                                           message.message              AS message,
                                           message.subject              AS subject, 
                                           message.autor_id             AS autor_id, 
                                           message.mkdate               AS mkdate';
                $msg_user_fields        = 'message_user.message_id,
                                           message_user.user_id         AS receiver,    
                                           message_user.snd_rec,
                                           message_user.readed';
                if ($inbox == true)
                {
                        // query for inbox
                        $query ="       SELECT $user_fields, $msg_fields, $msg_user_fields
                                        FROM message_user
                                        JOIN message       ON message_user.message_id = message.message_id
                                        JOIN auth_user_md5 ON message.autor_id =auth_user_md5.user_id 
                                        WHERE message_user.user_id =  '$user_id' 
                                          AND message_user.snd_rec = 'rec'
                                          AND message_user.deleted =  '0'
                                        ORDER BY message.mkdate DESC
                                        LIMIT 0,30";
                }
                else
                {
                        // query for outbox outbox
                        $query ="       SELECT $user_fields, $msg_fields, $msg_user_fields
                                        FROM message
                                        JOIN message_user       ON message.message_id = message_user.message_id
                                        JOIN auth_user_md5      ON message_user.user_id = auth_user_md5.user_id
                                        WHERE message.autor_id =  '$user_id' 
                                          AND message_user.snd_rec = 'snd'
                                          AND message_user.deleted =  '0'
                                        ORDER BY message.mkdate DESC
                                        LIMIT 0,30";
                }         
                
                $result = $db->query($query);
                
                foreach ($result as $row) {
                    $items[] = array(
                        'id'            => $row['message_id'],
                        'title'         => $row['subject'],
                        'author'        => $row['vorname'] . ' ' . $row['nachname'],
                        'author_id'     => $row['autor_id'],
                        'message'       => $row['message'],
                        'mkdate'        => $row['mkdate'],
                        'readed'       => $row['readed'],
                        'receiver'      => get_fullname($row['receiver'])
                    );

                }
                
                
                return $items;
        }
        
        static function findAllInvolvedMembers ( $userId )
        {	
        	//get all seminars 
        	$seminare = Course::findAllByUser( $userId );
        	$seminarIdString = "";
        	foreach ($seminare AS $seminar)
        	{
	        	if ($seminarIdString == "")  $seminarIdString .= " Seminar_id='".$seminar["Seminar_id"]."' ";
	        	else						 $seminarIdString .= "OR   Seminar_id='".$seminar["Seminar_id"]."' ";
        	}

        	$query = "SELECT seminar_user.Seminar_id, seminar_user.user_id, seminar_user.visible, 
	    			  seminar_user.status, auth_user_md5.Vorname, auth_user_md5.Nachname, user_info.title_front
	    		      FROM   seminar_user
	    		      JOIN 	 auth_user_md5 ON auth_user_md5.user_id = seminar_user.user_id
	    		      JOIN   user_info     ON auth_user_md5.user_id = user_info.user_id
	    		      WHERE $seminarIdString
	    		      ORDER BY auth_user_md5.Nachname
	    		      ";	
			$stmt = \DBManager::get()->query($query);
			$result = $stmt->fetchAll();
			
			//to do dublicate entfernen 
			
			return array_unique($result); 
        }

}
