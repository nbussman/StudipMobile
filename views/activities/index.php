<?
$this->set_layout("layouts/single_page");
$page_title = "Stud.IP - Activity Feed";
$page_id = "activities-index";
?>

<ul id="activities" data-role="listview" data-filter="true" data-filter-placeholder="Suchen">
    <? foreach ($activities as $activity) { 
/* 	    var_dump($activity); */
    ?>
    	<li class="activity" data-activity="<?= htmlReady($activity['id']) ?>">
    		<? if (!empty($activity["link"])){ ?>
    			<a href="<?=$controller->url_for($activity['link']) ?>" rel="external">
    		<? } ?>
	             <img src="<?= $controller->url_for("avatars/show", $activity['author_id']) ?>"
	                  alt="<?= htmlReady($activity['category']) ?>"
	                 class="ui-li-icon" style="padding-top: 20px">
	             <img   src="<?= $plugin_path ?>/public/images/activities/<?= htmlReady($activity['category']) ?>.png" 
	             		alt="<?= htmlReady($activity['category']) ?>" class="ui-li-icon">
	             <h3><?= htmlReady($activity['title']) ?></h3>
	             <p><strong><?= htmlReady($activity['author']) ?></strong></p>
	             <p><?= htmlReady($activity['content']) ?></p>
	             <p class="ui-li-aside"><strong><?= htmlReady($activity['readableTime']) ?></strong></p>
	         <? if (!empty($activity["link"])){ ?>
	         	</a>
	         <? } ?>
	     </li>
    <? } ?>
</ul>
