<?php
include 'Dropbox/autoload.php';
fopen("http://localhost/~nils/studip/public/sendfile.php?force_download=0&type=0&file_id=aa164a04d7fa4f69535ec3d7d99f57a5&file_name=Auto_Plan.xls", "r");
$this->set_layout("layouts/single_page_normal");
$page_title      = "Dateien droppen";
$page_id         = "courses-dropfiles";

// custom settings
$consumerKey     = '5wty9mf06gcuco0';
$consumerSecret  = 'hveok3hllw48hji';
$call_back_link  = "http://localhost/~nils/studip/public/plugins.php/studipmobile/courses/dropfiles/" . $seminar_id;
$new_token       = true;

// is set if the user is logged in
$connection_good = false;

//check if the php pear dropbox extension is installed
if (1==1)
{

	//require 'Dropbox/autoload.php';

	$oauth   = new Dropbox_OAuth_PEAR ($consumerKey, $consumerSecret);
	$dropbox = new Dropbox_API        ($oauth, Dropbox_API::ROOT_SANDBOX);

	// For convenience, definitely not required
	//header('Content-Type: text/plain');

	// We need to start a session
	session_start();

    //check if tokens are already stored
    if ( isset( $db_tokens[0]['token'], $db_tokens[0]['token_secret'] ) )
    {
     // user already got dropbox linked
     $_SESSION['state']         = 3;
     $_SESSION['oauth_tokens']  = array( "token" => $db_tokens[0]['token'], 
                         "token_secret" =>  $db_tokens[0]['token_secret'] );
    }


	// There are multiple steps in this workflow, we keep a 'state number' here
	if (isset($_SESSION['state'])) {
	    $state = $_SESSION['state'];
	} else {
	    $state = 1;
	}

	// switch cases for autification
        switch($state) 
                        {
                        
                            /* In this phase we grab the initial request tokens
                               and redirect the user to the 'authorize' page hosted
                               on dropbox */
                            case 1 :
                                echo "Step 1: Acquire request tokens\n";
                        
                                $tokens = $oauth->getRequestToken();
                        
                        
                                // Note that if you want the user to automatically redirect back, you can
                                // add the 'callback' argument to getAuthorizeUrl.
                                $link = $oauth->getAuthorizeUrl( $call_back_link ) . "\n";
                                $_SESSION['state'] = 2;
                                $_SESSION['oauth_tokens'] = $tokens;
                                ?>
                                <ul data-role="listview" data-inset="true" data-theme="e">
                                        <li>
                                                <center><img src="<?=$plugin_path ?>/public/images/dropbox.png" ></center>
                                                <h1>Dropbox mit Studip verbinden</h1>
                                                Um Dateien mit ihrer Dropbox auszutauschen müssen Sie Ihre Dropbox mit Studip verbinden.<br /> Hierzu müssen Sie sich einloggen.<br /> Dateien werden sie unter<strong>Apps/studipmobile</strong> finden.<br /><small>StudIp erhält nicht auf Ihre gesamte Dropbox Zugriff.</small>
                                        </li>
                                </ul>
                                <a href="<?=$link ?>" data-role="button" data-theme="b">StudIp verbinden</a>
                                <?
                                die();
                        
                            /* In this phase, the user just came back from authorizing
                               and we're going to fetch the real access tokens */
                            case 2 :
                                $oauth->setToken($_SESSION['oauth_tokens']);
                                $tokens = $oauth->getAccessToken();
                                $_SESSION['state'] = 3;
                                $_SESSION['oauth_tokens'] = $tokens;
                                // There is no break here, intentional
                        
                            /* This part gets called if the authentication process
                               already succeeded. We can use our stored tokens and the api 
                               should work. Store these tokens somewhere, like a database */
                            case 3 :
                                try
                                {
                                        $oauth->setToken($_SESSION['oauth_tokens']);
                                        $connection_good = true;
                                }
                                catch(Exception $e)
                                {
                                        echo "gespeicherter key falsch";
                                        $_SESSION['state'] = 1;
                                        $new_token = false;
                                }
                                
                                break;
                        }
}
else
{
	?>
	<ul data-role="listview" data-inset="true" data-theme="e">
		<li>
			<center><img src="<?=$plugin_path ?>/public/images/dropbox.png" ></center>
			<h1>Dropbox Fehler</h1>
			<p>Leider ist von dem Systemadministrator nicht die PHP Pear Erweiterung Dropbox installiert worden.<br /> Daher steht Ihnen dieses Feature nicht zu Verfügung.</p>
		</li>
	</ul>
	<?
}

if ( $connection_good == true )
{
    print_r($tokens);
    // save key in database
    $db    = \DBManager::get();
            $query = "INSERT INTO `dropbox_tokens` 
                      (user_id, token, token_secret)
                      VALUES ('$this->user_id', '$token['token']', '$token['token_secret']')";
            $result = $db->query($query);

    $accInfo= $dropbox->getAccountInfo();
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
    <?
	//Uploading files
	?>
	<script>
	        uploadFileDropbox("http://localhost/~nils/studip/public/sendfile.php?force_download=1&type=0&file_id=aa164a04d7fa4f69535ec3d7d99f57a5&file_name=Auto_Plan.xls","Ordner/files/veranstaltung","Auto_Plan.xls", "<?= $controller->url_for("courses/upload") ?>"); 
	        
	        <?
	        foreach($files AS $file)
            {
	            ?>
	                uploadFileDropbox("<?=$file["link"] ?>","Ordner/files/veranstaltung", "<?=$file["name"] ?>", "<?= $controller->url_for("courses/upload") ?>");
	            <?
	        }
	        ?>
	</script>
	<ul id="uploadList" data-role="listview" data-inset="true" data-theme="b" data-divider-theme="a">
		<li data-role="list-divider">Abgleich beginnt</li>
	</ul>
	<?
}
?>