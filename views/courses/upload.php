<?php
/*
 * This script shoud upload a file to a 
 * special folder in the users dropbox.
 * The session should bestarted and the
 * user should be logged in already.
 *
 * @author Nils Bussmann <nbussman@uos.de>
 * @date   05.02.2011
 * @param  filename should be the path to the local file 
 * @param  folder the folder in the dropbox
 *
 * @return fail:filename    if something went wrong
 * 	   success:filename if all went right
 *         exists:filename  if the file already exists
 */

$file     = $_GET["filename"];
$filename = basename($file);
$folder   = $_GET["folder"];
/* session shu be started, user sshould logged in*/
/* Please supply your own consumer key and consumer secret */
$consumerKey = '5wty9mf06gcuco0';
$consumerSecret = 'hveok3hllw48hji';

require 'Dropbox/autoload.php';

session_start();
try{
	$oauth   = new Dropbox_OAuth_PEAR( $consumerKey, $consumerSecret );
	$dropbox = new Dropbox_API( $oauth,Dropbox_API::ROOT_SANDBOX );

	$oauth->setToken( $_SESSION['oauth_tokens'] );


	//Check if the directories are created and
	//single subfolders in $folders
	$folders = explode( "/", $folder );
	$checked_path = "/";
	foreach ( $folders AS $subfolder )
	{
		$found_folder = false;	
		$info = $dropbox->getMetaData( $checked_path );
		foreach( $info["contents"] AS $meta_info )
		{
			if ( $meta_info["is_dir"] == 1 )
			{
				$found_folder = true;
				break;
			}
		}
		if ( !$found_folder )
		{
			$dropbox->createFolder( $checked_path . "/" . $subfolder ,'sandbox');
		}
		if ( $checked_path == "/" )
			$checked_path .= $subfolder;
		else
			$checked_path .= "/" .$subfolder;
	} // benötigte Ornder sind nicht vorhanden

	//check if file already exisits
	$found = false;
	$info  = $dropbox->getMetaData( $folder );
	foreach ( $info["contents"] AS $array_files)
	{
		if ( strpos( $array_files["path"], $filename ) != false)
		{
			echo "exists:" . $filename;
			$found = true;
		}
	} // $found gibt an ob die Datei bereits existiert

	//Upload the file if nessasery
	if ( $found == false )
	{
		if( $dropbox->putFile( $folder . "/". basename( $file ), $file ) ) 
		{
			echo "success:" . $filename;
		} 
		else 
		{
			echo "fail:" . $filename;
		}
	}
}
catch(Dropbox_Exception $e)
{
	// something went wrong, not specified
	// to specify the error there are other exeptions to catch
	echo "fail:" . $filename;
}
catch(HTTP_OAuth_Exception $e)
{
	echo "fail:" . $filename;
}