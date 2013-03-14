<div data-role="content"  style="padding:15px 3px 0px;">
<?
$this->set_layout("layouts/single_msg");
$page_title = "Nachricht";
$page_id = "mail-show";
if (sizeof($mail)) 
{
        $time = date("H:i",$mail[0]['mkdate']);
        $wochentag = Helper::get_weekday(date("N", $mail[0]['mkdate']));
		$monat      = Helper::get_moth(date("m", $mail[0]['mkdate']));
		$day = $wochentag.date(", j. ",$mail[0]['mkdate']).$monat.date(", Y",$mail[0]['mkdate']);
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
        	<?= htmlReady($mail[0]['message'],TRUE, TRUE); ?>
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
</div><!-- /content -->


<div data-role="footer" data-id="footer" data-position="fixed" data-theme="c">
    <div data-role="navbar" data-iconspos="top">
        <ul class="ui-grid-a">
            <li class="ui-block-a"><a id="marikieren" href="<?= $controller->url_for("mails/show_msg",htmlReady($mail[0]['id']), htmlReady(true)) ?>" data-theme="c" data-icon="star" data-transition="flip">Markieren</a></li>
            <li class="ui-block-b"><a id="antworten" href="<?= $controller->url_for("mails/write",htmlReady($mail[0]['author_id'])) ?>" data-theme="c" data-icon="check" data-transition="slideup">Antworten</a></li>
        </ul>
    </div>
</div>