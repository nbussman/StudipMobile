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


namespace Studip\Mobile;

require_once $this->trails_root .'/models/course.php';

class Mail {

		/**
		 *	Get latest 30 Messages from a user starting
		 *	width intervall. 
		 *	@param $user_id		owner of the message
		 *	@param $intervall	where to start
		 *	@param $inpox 		list from inbox or outbox
		 */	
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
		static function get_mail($user_id, $msg_id, $mark=0)
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
										AND     message_user.user_id =  '$user_id'
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
		static function get_mails($user_id, $intervall, $inbox = true)
		{
				$items = array();
				$db = \DBManager::get();
				
				$user_fields	= 'auth_user_md5.user_id,
								   auth_user_md5.Vorname	AS vorname,
								   auth_user_md5.Nachname	AS nachname';
				$msg_fields		= 'message.message_id		AS message_id,
								   message.message			AS message,
								   message.subject 			AS subject, 
								   message.autor_id			AS autor_id, 
								   message.mkdate			AS mkdate';
				$msg_user_fields= 'message_user.message_id,
								   message_user.user_id		AS receiver,    
								   message_user.snd_rec,
								   message_user.readed';
				if ($inbox == true)
				{
					$where = "WHERE message_user.user_id =  '".$user_id."' 
							AND message_user.snd_rec = 'rec'
							AND message_user.deleted =  '0'"; 
				}
				else
				{
					$where = "WHERE message.autor_id =  '".$user_id."'
							AND message_user.snd_rec = 'snd'
							AND message_user.deleted =  '0'"; 
				}         

				$query ="SELECT $user_fields, $msg_fields, $msg_user_fields
						 FROM message
						 JOIN message_user	ON message.message_id = message_user.message_id
						 JOIN auth_user_md5	ON message_user.user_id = auth_user_md5.user_id
						 ".$where."
						 ORDER BY message.mkdate DESC
						 LIMIT 0,30";
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
			
			
			//dublicate entfernen 
			//zunäcsht alle user_ids in array packen
			$user_ids = array();
			foreach( $result AS $member)
			{
				if (!in_array( $member["user_id"] , $user_ids ))
					array_push($user_ids, $member["user_id"]);
			}
			
			//löschen der eigenen id
			unset( $user_ids[array_search($userId,$user_ids)] );
			
			//jetzt alle einmal in ausgaben array packen
			$ausgabe = array();
			foreach( $result AS $member)
			{
				if (in_array( $member["user_id"] , $user_ids ))
				{
					array_push($ausgabe, $member);	
					unset( $user_ids[array_search($member["user_id"],$user_ids)] );
				}
			}
			
			
			return $ausgabe; 
		}
		static function send ( $empf, $betreff, $nachricht, $abs)
		{
			//Nachricht Objekt erstellen
			$message    = new \messaging();
			
			// wenn empfänger kein array, mach ein draus
			if (is_array($empf))
			{
				$empf_array = array(0 => $empf);
			}
			else
			{
				$empf_array = $empf;
			}
			
			//senden der Nachricht
			$send = $message->insert_message(mysql_escape_string(utf8_decode($nachricht)), mysql_escape_string($empf_array), 
						mysql_escape_string($abs), '', '', '', '',mysql_escape_string( utf8_decode($betreff)), '', 'normal');
			if ($send > 0)	return true;
			return false;
		}
		

}
