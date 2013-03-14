<?

$this->set_layout("layouts/mail_list");
$page_title = "Neue Nachricht";
$page_id = "mail-write";

?>
  
<div data-role="page" id="<?= $page_id ?: '' ?>">
	<? include dirname(__FILE__).'./../layouts/side_menu.php'; ?>

	<div data-role="header" data-theme="a">
        	<? include dirname(__FILE__).'./../layouts/side_menu_link.php'; ?>
        	<h1>Nachrichten</h1>
        	<a href="#popupMenu" data-rel="popup" data-role="button" data-inline="true">Neue</a>
        	<div data-role="popup" id="popupMenu" data-theme="a">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="d">
					<li><a href="<?= $controller->url_for("mails/index") ?>">Eingang</a></li>
					<li><a href="<?= $controller->url_for("mails/list_outbox") ?>">Ausgang</a></li>
					<li data-role="divider" data-theme="a">Neue Nachricht</li>
				</ul>
			</div>
	</div><!-- /header -->
      <div data-role="content">
      <?
      		if (!empty( $empfData ))
      		{
      			// adressat wurde gewählt
	      		?>
	      			<p>
	      			<form action="<?= $controller->url_for("mails/send", htmlReady($empfData['username'])) ?>" method="POST">
	      				<div class="ui-grid-b a_bit_smaller_text" data-theme="c" style="font-size:10pt;">
                        	<div class="ui-block-a">
	                        	<img  src="
	                        		<?= $controller->url_for("avatars/show", $empfData["user_id"], 'medium') ?>" 
	                        		alt="Profil-Bild">
                        	</div>
                        	<div class="ui-block-b">
	                        	<h3>Empfänger: </h3><?=$empfData['vorname'] ?> <?=$empfData['nachname'] ?>
                        	</div>
                        </div><!-- /grid-a -->
	      				<hr>
	      				<h3>Betreff</h3>
	      				<input name="mail_title">
	      				<h3>Nachricht</h3>
	      				<textarea style="min-height:200px;" name="mail_message">Sehr geehrte(r) <?=$empfData['vorname'] ?> <?=$empfData['nachname'] ?>,

Mit freundlichen Grüßen</textarea>
	      				<button value="submit">Senden</button>
	      				</p>
	      		<?
      		}
      		else
      		{
	      		//kein adressat wurde gewählt, es werden alle teilnehmer aller besuchten veranstaltungen 
	      		//zur auswahl gestellt
	      		
	      		?>
				<ul id="courses" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-divider-theme="d" >
				<li data-role="divider" data-theme="d">Bitte wählen Sie einen Empfänger:</li>
				<?
					foreach ($members AS $member)   
					{
					?>
				        <li>
					        <a href="<?= $controller->url_for("mails/write", htmlReady($member['user_id'])) ?>">
						        <img src="<?= $controller->url_for("avatars/show", $member['user_id'], 'medium') ?>" class="ui-li-thumb">
						        <h3><?=htmlReady($member["title_front"]) ?> <?=htmlReady($member['Vorname']) ?>  <?=htmlReady($member['Nachname'])?> </h3>
						    </a>
				        </li>
				    <?
				    }
				    ?>
				</ul>
				<?
      		}
      
      ?>
	  </div>
</div>