<?php

<<<<<<< HEAD
$this->set_layout("layouts/single_page_back");
=======
$this->set_layout("layouts/single_page_normal");
>>>>>>> 3f9395817e821753bae80db600cc893a89fcd3dc
$page_title = "Dateien";
$page_id = "courses-list_files";

if (sizeof($files)) 
{
    	?>
	<a href="<?= $controller->url_for("courses/dropfiles", htmlReady($seminar_id)) ?>" rel="external" data-role="button" data-theme="b">Alle Dateien in meine Dropbox</a><br>
	<ul id="files" data-role="listview" data-filter="false" data-count-theme="b">
		<?
		foreach($files AS $file)
		{
			?>
			<li><a href="<?=$file["link"] ?>" rel="external">
				<!-- <img src="<?= $plugin_path ?>/public/images/activities/files.png" class="ui-li-icon"> -->
				<img src="<?=$plugin_path ?><?=$file["icon_link"] ?>" class="ui-li-icon">
				<div style="padding-left:10px;">
<<<<<<< HEAD
					<h3><?=htmlReady($file["name"]) ?></h3>
					<p><strong><?=htmlReady($file["author"]) ?></strong></p>
					<p><?=htmlReady($file["description"]) ?></p>
=======
					<h3><?=$file["name"] ?></h3>
					<p><strong><?=$file["author"] ?></strong></p>
					<p><?=$file["description"] ?></p>
>>>>>>> 3f9395817e821753bae80db600cc893a89fcd3dc
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