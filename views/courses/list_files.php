<?php

$this->set_layout("layouts/single_page_back");
$page_title = "Dateien";
$page_id = "courses-list_files";

if (sizeof($files)) 
{
    	?>
	<a href="<?= $controller->url_for("courses/dropfiles", htmlReady($seminar_id)) ?>" class="externallink" data-ajax="false" data-role="button" data-theme="b">Alle Dateien in meine Dropbox</a><br>
	<ul id="files" data-role="listview" data-filter="false" data-count-theme="b">
		<?
		foreach($files AS $file)
		{
			?>
			<li><a href="<?=$file["link"] ?>" class="externallink" data-ajax="false">
				<!-- <img src="<?= $plugin_path ?>/public/images/activities/files.png" class="ui-li-icon"> -->
				<img src="<?=$plugin_path ?><?=$file["icon_link"] ?>" class="ui-li-icon">
				<div style="padding-left:10px;">
					<h3><?=htmlReady($file["name"]) ?></h3>
					<p><strong><?=htmlReady($file["author"]) ?></strong></p>
					<p><?=htmlReady($file["description"]) ?></p>
				</div>
				<!-- <p class="ui-li-count"><strong> <?=$file["extension"] ?> </strong></p> -->
			</a></li>
			
			<?
		}
		?>
	</ul>	
	<?
} 
else 
{ 
	?>
	<ul data-role="listview" data-inset="true" data-theme="e">
		<li>Zu dieser Veranstaltung sind leider keine Dateien vorhanden.</li>
	</ul>
	<? 
} 
?>