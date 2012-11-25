<?php
namespace Studip\Mobile;

require_once('Dropbox/autoload.php');

class DropboxCommunication {

	var $consumerKey     = '5wty9mf06gcuco0';
	var $consumerSecret  = 'hveok3hllw48hji';
	
	var $oauth   = new Dropbox_OAuth_PEAR ($consumerKey, $consumerSecret);
	var $dropbox = new Dropbox_API        ($oauth, Dropbox_API::ROOT_SANDBOX);

	const ERROR_WHILE_LOGIN = 0;
	const NO_TOKEN_STORED 	= 1;
	
	const LOGGED_IN			= 9;

    function __construct()
    {
	    
    }
    
    
	function login( $user_id, $link, $step)
	{
		$call_back_link  =  $link;

		//check ob token für user in datenbank vorhanden
		$savedToken = DropboxCommunication::get_token( $user_id );
		if (empty ($savedToken) )
		{
			//keinen gespeicherten token gespeichert
			return NO_TOKEN_STORED;
		}
		else
		{
			//es wurde ein token gespeichert
			//login versuch damit
			
			//loginverscuh erfolgreich
			return true;
			
			//loginversuch fehlgeschlagen
				//token löschen
				//return DropboxCommunication::login( $user_id, $link ); 
		}
	}
	
	static function get_token( $user_id )
    {
        $query ="       SELECT *
                        FROM 	dropbox_tokens
                        WHERE   dropbox_tokens.user_id =  '$user_id'
			";
	$stmt = \DBManager::get()->query($query);
	return $stmt->fetchAll();
    }


}
