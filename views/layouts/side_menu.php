<?
?>
<div id="menu">
  <h3>Menu</h3>
  <ul>
    <li class="active"><a href="<?= $controller->url_for("quickdial") ?>" class="externallink" data-ajax="false" class="contentLink">
		<img src="<?= $plugin_path ?>/public/images/quickdial/bw/quick.png">
    	Start
    </a></li>
    <li><a href="<?= $controller->url_for("activities") ?>" class="externallink" data-ajax="false" class="contentLink">
    	<img src="<?= $plugin_path ?>/public/images/quickdial/bw/news.png" />
    	News
   	</a></li>
    <li><a href="<?= $controller->url_for("calendar") ?>" class="externallink" data-ajax="false" class="contentLink">
    	<img src="<?= $plugin_path ?>/public/images/quickdial/bw/schedule.png" />
    	Planer
    </a></li>
    <li><a href="<?= $controller->url_for("mails") ?>" class="externallink" data-ajax="false" class="contentLink">
    	<img src="<?= $plugin_path ?>/public/images/quickdial/bw/mail.png" />
    	Nachrichten
    </a></li>
    <li><a href="<?= $controller->url_for("courses") ?>" class="externallink" data-ajax="false" class="contentLink">
    	<img src="<?= $plugin_path ?>/public/images/quickdial/bw/seminar.png" />
    	Kurse
    </a></li>
    <li><a href="<?= $controller->url_for("profiles/show") ?>" class="externallink" data-ajax="false" class="contentLink">
    	<img src="<?= $plugin_path ?>/public/images/quickdial/bw/profile.png" />
    	Ich
    </a></li>
  </ul>
</div>