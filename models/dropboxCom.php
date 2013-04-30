<?php

namespace Studip\Mobile;

require_once('Dropbox/autoload.php');

class DropboxCommunication {

	var $consumerKey     = '5wty9mf06gcuco0';
	var $consumerSecret  = 'hveok3hllw48hji';
	
	
	static function dropConnect ( $user_id, $call_back_link )
	{
		session_start();
		
		$stored_token  = self::get_token( $user_id );
		$connectStatus = self::tryToConnect( $call_back_link, $user_id , $stored_token[0] );
		
		return $connectStatus;
	}
	
	static function tryToConnect ( $call_back_link, $user_id, $token = null )
	{
		if (isset($token))
		{
			//token übergeben
			$_SESSION['oauth_tokens']  = array( "token" => $token['token'], 
	                         		     "token_secret" =>  $token['token_secret'] );
	        $_SESSION['state']         = 3;
	        $state					   = 3;
		}

		if (( !isset($_SESSION['state']) ))
		{
			 //ganz neu
			 $_SESSION['state']        = 1;
		}
		$state	=  $_SESSION['state'];
		
		//try to login
		$consumerKey     = '5wty9mf06gcuco0';
		$consumerSecret  = 'hveok3hllw48hji';
		$oauth   = new \Dropbox_OAuth_PEAR ($consumerKey, $consumerSecret);
		$dropbox = new \Dropbox_API        ($oauth, \Dropbox_API::ROOT_SANDBOX);
		try{
		switch($state) 
        {
        
            /* In this phase we grab the initial request tokens
               and redirect the user to the 'authorize' page hosted
               on dropbox */
            case 1 :
                $tokens 					= $oauth->getRequestToken();
                $link 						= $oauth->getAuthorizeUrl( $call_back_link ) . "\n";

                // Note that if you want the user to automatically redirect back, you can
                // add the 'callback' argument to getAuthorizeUrl.
                $link = $oauth->getAuthorizeUrl( $call_back_link ) . "\n";
                $_SESSION['state'] 			= 2;
                $_SESSION['oauth_tokens'] 	= $tokens;
                return $link;
                break;
        
            /* In this phase, the user just came back from authorizing
               and we're going to fetch the real access tokens */
            case 2 :
                $oauth->setToken($_SESSION['oauth_tokens']);
                try{
                    $tokens            		  = $oauth->getAccessToken();
                    $_SESSION['state'] 		  = 3;
                    $state             		  = 3;
                    $_SESSION['oauth_tokens'] = $tokens;
                    
                }
                catch( \PEAR_Exception $e){
                	
                    $_SESSION['state']        = 1;
                    $state                    = 1;
                    $_SESSION['oauth_tokens'] = NULL;
                    $tokens                   = NULL;
                    $link = $oauth->getAuthorizeUrl( $call_back_link ) . "\n";
                    return self::tryToConnect( $call_back_link, $user_id );
                    break;
                }
                // There is no break here, intentional
        
            /* This part gets called if the authentication process
               already succeeded. We can use our stored tokens and the api 
               should work. Store these tokens somewhere, like a database */
            case 3 :
                try
                {
                        $oauth->setToken($_SESSION['oauth_tokens']);
                        //checks if Connection is Good
                        $dropbox->getAccountInfo();
                }
                catch(\Dropbox_Exception $e)
                {
                        $_SESSION['state'] = 1;
                        $state             = 1;
                        $link = $oauth->getAuthorizeUrl( $call_back_link ) . "\n";
                        unset($_SESSION['oauth_tokens']);
                        // delete the stored token
                        self::deleteToken($user_id);
                        return self::tryToConnect( $call_back_link, $user_id );
                }
                catch(\HTTP_OAuth_Exception $e)
                {
                    	$_SESSION['state'] = 1;
                        $state             = 1;
                        $link = $oauth->getAuthorizeUrl( $call_back_link ) . "\n";
                        unset($_SESSION['oauth_tokens']);
                        // delete the stored token
                        self::deleteToken($user_id);
                        return self::tryToConnect( $call_back_link, $user_id );
                }
                break;
        }
        //connection should be good
        self::storeToken($user_id);
        return "connected";
        }
        catch(Exception $e)
        { return false;}
        catch(\HTTP_OAuth_Exception $e)
                {return false;}
        catch(\Dropbox_Exception $e)
                {return false;}

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
    
    static function storeToken( $user_id )
    {
    	$token_token  = $_SESSION['oauth_tokens']['token'];
    	$token_secret = $_SESSION['oauth_tokens']['token_secret'];
    	$db    = \DBManager::get();

	    if ( (isset($token_token)) && (isset($token_secret)) )
	    {
		    //if stored token is the same as the new one do nothing
		    //if it's different -> update 
		    //else simply store it
		    $stored_tokens = self::get_token( $user_id );
		    if (empty($stored_tokens))
		    {
			    //token need to be stored
			    $query = "INSERT INTO `dropbox_tokens` 
	        		  			 (user_id,     token,          token_secret)
	        		  	  VALUES ('$user_id', '$token_token', '$token_secret')";
	        	$result = $db->query($query);
		    }
	    }
    } 
    
    static function deleteToken($user_id)
    {
    	$db    = \DBManager::get();
    	$query = "DELETE FROM `dropbox_tokens` WHERE user_id='$user_id'";
	    $db->query($query);
    }
    
    static function getDropboxObject($token)
    {
	    
    }
    

}
