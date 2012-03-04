<?

$this->set_layout("layouts/single_msg");
$page_title = "Nachricht";
$page_id = "mail-show";
if (sizeof($mail)) 
{
        $time = date("H:i",$mail[0]['mkdate']);
        $day = date("l, j. F, Y",$mail[0]['mkdate']);
        ?>
        <ul data-role="listview">
        			<li data-role="fieldcontain">

        					<h3><?= htmlReady($mail[0]['title']) ?></h3>
        					<p><strong><?=$day ?> </strong></p>
        			</li>
        			<li data-role="fieldcontain">
        					<p style="padding-top:12px;">
        					        <strong>An:</strong> <?= htmlReady($mail[0]['receiver']) ?><br>
        						<strong>Von:</strong> <?= htmlReady($mail[0]['author']) ?>
        					</p>
        					<span class="ui-li-count"> <?=$time ?> Uhr</span>
        			</li>
        </ul>
        <p style="font-family: Helvetica,Arial,sans-serif;font-size: 12px;font-weight: normal;white-space:wrap;">
        	<br />
        	<?= preg_replace('/\r\n|\r|\n/','<br \>',$mail[0]['message']) ?>
        </p>
        <?php
}
else
{
        ?>
        <p>Beim Laden der Nachricht ist ein Fehler aufgetreten.</p>
        <?
}
?>