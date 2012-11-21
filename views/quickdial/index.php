<?
$this->set_layout("layouts/quickdial");
$page_title = _("Uni Osnabrück");

?>


      
      <div class="ui-grid-b" >
          <div class="ui-block-a grid">
            <a href="<?= $controller->url_for("activities") ?>">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/news.png" /><br />
              <span>News</span>
            </a>
          </div>
          <div class="ui-block-b grid">
            <a href="<?= $controller->url_for("calendar") ?>"  rel="external">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/schedule.png" /><br />
              <span>Planer</span>
            </a>
          </div>
          <div class="ui-block-c grid">
            <a href="<?= $controller->url_for("mails") ?>/" rel="external">
	      <?
	      	if ($number_unread_mails > 0)
		{ 
			?>
			<span class="notification"><?= $number_unread_mails ?></span>
			<?
		}
		?>
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/mail.png" /><br />
              <span>Nachrichten</span>              
            </a>
          </div>
          
          <div class="ui-block-a grid scndrow">
            <a href="<?= $controller->url_for("courses") ?>" rel="external">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/seminar.png" /><br />
              <span>Kurse</span>
            </a>
          </div>
          <div class="ui-block-b grid scndrow">
            <a href="<?= $controller->url_for("dropfiles") ?>">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/dropbox.png" /><br />
              <span>DropFiles</span>
            </a>
          </div>
          <div class="ui-block-c grid scndrow">
            <a href="html/community.html">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/community.png" /><br />
              <span>Community</span>
            </a>
          </div>
      </div>
      
      <div class="bookmark">
          Für eine bessere Darstellung fügen Sie diese Seite zum <b>Home-Bildschirm</b> hinzu!
        <div class="chat-bubble-arrow-border"></div>
        <div class="chat-bubble-arrow"></div>
      </div>
    
    
   
    <?
	$i=0;

    	foreach($next_courses as $next)
	{
		if($i > 0)
		{
			$selektor=" ticker-r".$i;
		}
		?>
			<div class="ticker<?=$selektor ?>">

			        <div class="tickerhead">
			          <span style="float:left;"><img src="<?= $plugin_path ?>/public/images/quickdial/ticker-left.png" /></span>
			            Nächste Veranstaltung:
			          <span style="float:right;"><img src="<?= $plugin_path ?>/public/images/quickdial/ticker-right.png" /></span>
			        </div>

			        <div class="tickercontent">
			          von <?=$next["beginn"] ?> bis <?=$next["beginn"] ?><br />
			          <b><?=$next["title"] ?></b><br />
			          <?=$next["description"] ?>
			        </div>

			</div>
		<?
		$i++;
	}

    ?>

    