
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
//laden der nachrichten 
//wenn eingang leer
if ( empty($inbox) )
{
    ?>
        <li data-theme="e" data-role="list-divider"><center>Keine Nachrichten vorhanden</center></li>
    <?
}
else
{
    //wenn array nicht leer
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

            <li data-theme="c" data-swipeurl="<?= $controller->url_for("mails/index", htmlReady($mail['id'])) ?>">
                    <a href="<?= $controller->url_for("mails/show_msg", htmlReady($mail['id'])) ?>" data-transition="slideup">
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
<?
}
?>
</ul>
</div><!-- /content -->

<?
    // print footer
    echo $this->render_partial('mails/footer.php');
?>

</div>

