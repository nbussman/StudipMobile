<?
$this->set_layout("layouts/single_page_back");
$page_title = "Teilnehmer";
$page_id = "courses-show_members";

//rolle
$status = '';
?>



<ul id="courses" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-divider-theme="d" >
<?
	foreach ($members AS $member)   
	{
		if ($status != $member['status'])
		{
		$status=$member['status'];
		?>
			<li data-role="list-divider">
	         <?=ucfirst(htmlReady($member['status'])) ?>
	        </li>
	    <?
		}
		?>
        <li>
	        <a href=" <?= $controller->url_for("profiles/show", htmlReady($member['user_id'])) ?>" rel="external">
		        <img src="<?= $controller->url_for("avatars/show", $member['user_id'], 'medium') ?>" class="ui-li-thumb">
		        <h3><?=htmlReady($member["title_front"]) ?> <?=htmlReady($member['Vorname']) ?>  <?=htmlReady($member['Nachname'])?> </h3>
		    </a>
        </li>
    <?
    }
    ?>
</ul>