<?

$this->set_layout("layouts/mail_list");
$page_title = "Nachrichten";
$page_id = "mail-outbox";

?>
  
<div data-role="page" id="<?= $page_id ?: '' ?>">
	<div data-role="header" data-theme="a">
        	<a href="<?= $controller->url_for("quickdial") ?>" class="externallink" data-ajax="false" data-icon="grid" data-iconpos="notext" data-theme="c"><?=_("Menu")?></a>
        	<h1><?=$page_title ?: 'Stud.IP' ?></h1>
        	<a href="#popupMenu" data-rel="popup" data-role="button" data-inline="true">Ausgang</a>
        	<div data-role="popup" id="popupMenu" data-theme="a">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="b">
					<li><a href="<?= $controller->url_for("mails/index") ?>">Eingang</a></li>
					<li data-role="divider" data-theme="a">Ausgang</li>
					<li><a href="<?= $controller->url_for("mails/write") ?>">Neue Nachricht</a></li>
				</ul>
			</div>
	</div><!-- /header -->
    <div data-role="content" data-scroll="y">
        <ul id="swipeMe" data-role="listview" data-filter="true" 
         	data-filter-placeholder="Suchen" data-inset="false" data-divider-theme="d" >

			<?
			//wenn ausgang leer
			if ( empty($outbox) )
			{
			    ?>
			        <li data-theme="e" data-role="list-divider" data-swipeurl=""><center>Keine Nachrichten vorhanden</center></li>
			    <?
			}
			else
			{
			    //wenn ausgang nicht leer
			    foreach ($outbox as $mail)
			    {
			            if ( ( !$day ) || ( date("j.m.Y",$mail['mkdate']) != $dayCount ) )
				        {	
				        		$wochentag = Helper::get_weekday(date("N", $mail['mkdate']));
				        		$monat      = Helper::get_moth(date("m", $mail['mkdate']));
				        		$day = $wochentag.date(", j. ",$mail['mkdate']).$monat.date(", Y",$mail['mkdate']);
				
				                $dayCount = date("j.m.Y",$mail['mkdate']);
				                                    ?>
				                        <li  data-role="list-divider"><?= htmlReady($day) ?></li>
				                <?php
				        }
			        
			            $time = date("H:i",$mail['mkdate']);
			            ?>
			
			            <li data-theme="c" data-swipeurl="<?= $controller->url_for("mails/list_outbox", htmlReady($mail['id'])) ?>">
			                    <a href="<?= $controller->url_for("mails/show_msg", htmlReady($mail['id'])) ?>"  data-transition="slideup">
			                        <img src="<?= $plugin_path ?>/public/images/icons/invisible_dot.png" class="ui-li-icon uis-corner-none ui-li-thumb">
			                        <h3><?= htmlReady($mail['author']) ?></h3>
			                        <p><strong><?= htmlReady($mail['title']) ?></strong></p>
			                
			                        <p><?= htmlReady($mail['message']) ?></p>
			                        <p class="ui-li-aside"><strong><?= htmlReady($time) ?></strong></p>
			                    </a>
			            </li>
			
			    <?php
			    }
			}
			?>
		</ul>
<?

?>
	</div><!-- Content -->
</div><!-- /page -->