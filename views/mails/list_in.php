<div data-role="page" id="<?= $page_id ?: '' ?>">
	<div data-role="header" data-theme="a">
        	<a href="<?= $controller->url_for("quickdial") ?>" rel="external" data-icon="grid" data-iconpos="notext" data-theme="c"><?=_("Menu")?></a>
        	<h1><?=$page_title ?: 'Stud.IP' ?></h1>
        	<a href=""data-theme="c">Bearbeiten</a>
	</div><!-- /header -->
      <div data-role="content">
 <? //<ul id="messages" data-role="listview" data-filter="true" data-inset="false" data-divider-theme="d"> ?>
 <ul id="swipeMe" data-role="listview" data-filter="true" data-inset="false" data-divider-theme="d">
<?
//laden der nachrichten in subpages
foreach ($inbox as $mail)
{
        if ( ( !$day ) || ( date("l, j. F, Y",$mail['mkdate']) != $day ) )
        {
                $day = date("l, j. F, Y",$mail['mkdate']);
                ?>
                        <li  data-role="list-divider"><?= htmlReady($day) ?></li>
                <?php
        }
        
        $time = date("H:i",$mail['mkdate']);
?>

        <li data-theme="c" data-swipeurl="swiped.html?1">
                <a href="#<?= htmlReady($mail['id']) ?>" data-transition="slideup">
                <?
                if ($mail['readed'] == 0)
                {
                        ?> <img src="<?= $plugin_path ?>/public/images/icons/blue_dot.png" class="ui-li-icon uis-corner-none ui-li-thumb"> <?php
                }
                else
                {
                        ?> <img src="<?= $plugin_path ?>/public/images/icons/invisible_dot.png" class="ui-li-icon uis-corner-none ui-li-thumb"> <?php
                }
                ?>
                <h3><?= htmlReady($mail['author']) ?></h3>
                <p><strong><?= htmlReady($mail['title']) ?></strong></p>
                
                <p><?= htmlReady($mail['message']) ?>
                <p class="ui-li-aside"><strong><?= htmlReady($time) ?></strong></p>
        </a></li>

<?php
}
?>
	<li data-theme="e" data-role="list-divider"><a href=""><center>weitere Nachrichten</center></a></li>	
        </ul>
  </div><!-- /content -->


  <div data-role="footer" data-id="footer" data-position="fixed">
    <div data-role="navbar" data-iconspos="top">
                   <ul class="ui-grid-b">
                           <li class="ui-block-a"><a href="<?= $controller->url_for("mails/index") ?>" data-theme="c" data-icon="studip-inbox" data-transition="flip">Eingang</a></li>
                           <li class="ui-block-b"><a href="<?= $controller->url_for("mails/list_outbox") ?>" data-theme="c" data-icon="studip-shoebox"  data-transition="flip">Ausgang</a></li>
                           <li class="ui-block-c"><a href="<?= $controller->url_for("mails/show_msg") ?>" data-theme="c" data-icon="studip-envelope" data-transition="slideup">Neu Nachricht</a></li>
                   </ul>
    </div>
  </div>

</div>

<?
   	// preload single message pages 
	foreach ($inbox as $mail)
	{
		?>
		<div data-role="page" id="<?= htmlReady($mail['id']) ?: '' ?>" >

		      <div data-role="header" data-theme="b">
		        <a href="<?= $controller->url_for("quickdial") ?>" data-icon="grid"  data-theme="d"><?=_("Menu")?></a>
		        <h1><?= htmlReady($mail['author']) ?></h1>
		        <a href="javascript:history.back();" data-icon="check" data-transition="slidedown" data-theme="d">Fertig</a>
		      </div><!-- /header -->

		      <div data-role="content">
				<?
				$time = date("H:i",$mail['mkdate']);
			        $day = date("l, j. F, Y",$mail['mkdate']);
			        ?>
			        <ul data-role="listview">
			        			<li data-role="fieldcontain">

			        					<h3><?= htmlReady($mail['title']) ?></h3>
			        					<p><strong><?=$day ?> </strong></p>
			        			</li>
			        			<li data-role="fieldcontain">
			        					<p style="padding-top:12px;">
			        					        <strong>An:</strong> <?= htmlReady($mail['receiver']) ?><br>
			        						<strong>Von:</strong> <?= htmlReady($mail['author']) ?>
			        					</p>
			        					<span class="ui-li-count"> <?=$time ?> Uhr</span>
			        			</li>

			        </ul><br>
						
			        <p style="font-family: Helvetica,Arial,sans-serif;font-size: 11pt;font-weight: normal;white-space:wrap;">
			        	<br />
			        	<?= preg_replace('/\r\n|\r|\n/','<br \>',$mail['message']) ?>
			        </p>

		      </div><!-- /content -->


		      <div data-role="footer" data-id="footer" data-position="fixed" data-theme="c">
		        <div data-role="navbar" data-iconspos="top">
		                       <ul class="ui-grid-b">
		                               <li class="ui-block-a"><a href="<?= $controller->url_for("mails/index") ?>" data-theme="c" data-icon="star" data-transition="flip">Markieren</a></li>
		                               <li class="ui-block-b"><a href="<?= $controller->url_for("mails/list_outbox") ?>" data-theme="c" data-icon="back"  data-transition="flip">Weiterleiten</a></li>
		                               <li class="ui-block-c"><a href="<?= $controller->url_for("mails/show_msg") ?>" data-theme="c" data-icon="check" data-transition="slideup">Antworten</a></li>
		                       </ul>
		        </div>
		      </div>

		    </div>
		<?
	}
?>
