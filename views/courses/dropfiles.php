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


//NO SIDE MENU: BECAUSE THIS CAUSE AN ERROR-> DIE IS LOADED TWICE -> EVERY REQUEST IS SEND TWICE =(


$this->set_layout("layouts/single_page_back_nosidemenu");
$page_title      = "Dateien droppen";
$page_id         = "courses-dropfiles";

if (($dropCom != "connected"))
{
	?>
	<ul data-role="listview" data-inset="true" data-theme="e">
	    <li>
	            <center><img src="<?=$plugin_path ?>/public/images/dropbox.png" ></center>
	            <h1>Dropbox mit Studip verbinden</h1>
	            Um Dateien mit ihrer Dropbox auszutauschen müssen Sie Ihre Dropbox mit Studip verbinden.<br /> 
	            Hierzu müssen Sie sich einloggen.<br /> Dateien werden sie unter<strong>Apps/studipmobile</strong> 
	            finden.<br /><small>StudIp erhält nicht auf Ihre gesamte Dropbox Zugriff.</small>
	    </li>
    </ul>
    <a href="<?=$dropCom ?>" data-role="button" data-theme="b">StudIp verbinden</a>
	<?
}
elseif($dropCom == "connected")
{
	// der nutzer ist eingelogged 
	//nun können dateien hochgeladen werden
	
	try
	{
		$consumerKey 	= '5wty9mf06gcuco0';
        $consumerSecret = 'hveok3hllw48hji';
        $oauth   = new \Dropbox_OAuth_PEAR( $consumerKey, $consumerSecret );
        $dropbox = new \Dropbox_API( $oauth,\Dropbox_API::ROOT_SANDBOX );

        $oauth->setToken( $_SESSION['oauth_tokens'] );
		$accInfo= $dropbox->getAccountInfo();
	}
	catch (\DropboxException $e)
	{
		echo "Es ist ein Fehler aufgetreten, bitte laden Sie die Seite neu.";
		die();
	}
    ?>
    <ul data-role="listview" data-inset="true" data-theme="e">
        <li>
            <h1>Verbundener Dropbox Account</h1>
            <fieldset class="ui-grid-a">
             <div class="ui-block-a" style="font-size:10pt;font-weight:normal;">Name:<br>Mail:</div> 
             <div class="ui-block-b" style="font-size:10pt;font-weight:normal;"><?=$accInfo["display_name"] ?> <br><?=$accInfo["email"] ?> </div>       
            </fieldset>
        </li>
    </ul>
    
    
    <script>
         //create_folders('<?= $controller->url_for("courses/createDropboxFolder", htmlReady( $seminar_id )) ?>');
         //creating folders, after that: uploading files
         $.ajax(
			{
			  	type:  "GET",
			  	url:   '<?= $controller->url_for("courses/createDropboxFolder", htmlReady( $seminar_id )) ?>',
			  	data:  { },
				success: function( data )
				{
				    DROPBOX_COUNTER = 0;
					var newLI           = document.createElement("li");
					newLI.className         = "ui-li ui-li-static ui-body-b ui-corner-top ui-corner-bottom";
					newLI.innerHTML =  "Ordnerstruktur angelegt. Sie können diese Seite nun verlassen.";
					document.getElementById("uploadList").appendChild(newLI);
				},
				error: function()
				{
					var newLI           = document.createElement("li");
					newLI.innerHTML =  "Anlegen Ordnerstruktur fehlgeschlagen. Versuchen Sie es erneut.";
					newLI.className         = "ui-li ui-li-static ui-body-b ui-corner-top ui-corner-bottom";
					document.getElementById("uploadList").appendChild(newLI);
				}
			}).done(function() { 
					send="alreadySend";
					<?
						list($upload_link) = explode( "?cid=",$controller->url_for("courses/upload") );
						foreach($files AS $file)
						{
							?>
								uploadFileDropbox("<?=htmlReady($upload_link) ?>","<?= $file['id'] ?>");
							<?
						}
					?>
			});
         
    </script>
    <ul id="uploadList" data-role="listview" data-inset="true" data-theme="b" data-divider-theme="a">
        <li data-role="list-divider">Abgleich beginnt</li>
    </ul>
    
<?
}
