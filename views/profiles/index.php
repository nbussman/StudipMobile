<?php

$this->set_layout("layouts/single_page");
$page_title = $profile[0]["name"]?:"Profil";
$page_id = "profile-index";

?>
<div class="ui-grid-a" >
       <div class="ui-block-a">
		<img class="contact" src="<?= $controller->url_for("avatars/show", $profile[0]['id'], 'normal') ?>" alt="Profil-Bild">
	</div>
       <div class="ui-block-b">
         <ul data-role="listview" data-theme="c" data-inset="true" style="font-size:9pt;">
           <?
                if(isset($profile[0]['mail']))
                {
                        ?>
                                <li><a href="mailto:<?=htmlReady($profile[0]['mail']) ?>"><?=htmlReady($profile[0]['mail']) ?></a></li>
                        <?
                }
           ?>
	   <?
	   	foreach($profile AS $p)
		{
		        if (isset($p['semester'], $p['stg']))
		        {
			        ?>
			                <li><a href=""><?=htmlReady($p['stg']) ?> (<?=htmlReady($p['semester']) ?>.)</a></li>
			        <?
			}
		}
	   if (isset($profile[0]['abschluss']))
	   {
	           ?>
                                <li><a href=""><?=htmlReady($profile[0]['abschluss']) ?></a></li>
                   <?
           }
           ?>
	   <li><a href="">Nachricht senden</a></li>
         </ul>
       </div>
</div>

<?

?>