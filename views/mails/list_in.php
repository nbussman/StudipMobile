
<div data-role="page" id="<?= $page_id ?: '' ?>">
	<div data-role="header" data-theme="a">
        	<a href="<?= $controller->url_for("quickdial") ?>" class="externallink" data-icon="grid" data-iconpos="notext" data-theme="c"><?=_("Menu")?></a>
        	<h1><?=$page_title ?: 'Stud.IP' ?></h1>
        	<a href=""data-theme="c">Bearbeiten</a>
	</div><!-- /header -->
      <div data-role="content">
 <? //<ul id="messages" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-inset="false" data-divider-theme="d"> ?>
 <ul id="swipeMe" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-inset="false" data-divider-theme="d">
<?
//laden der nachrichten 
//wenn eingang leer
if ( empty($inbox) )
{
    ?>
        <li data-theme="e" data-role="list-divider" data-swipeurl=""><center>Keine Nachrichten vorhanden</center></li>
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

            <li data-theme="c" data-swipeurl="<?= $controller->url_for("mails/index", $intervall ,htmlReady($mail['id'])) ?>">
                    <a href="<?= $controller->url_for("mails/show_msg", htmlReady($mail['id'])) ?>" data-transition="slideup">
                    <?
                    if ($mail['readed'] == 0)
                    {
                            Helper::getColorball("#1B4EA9",10);
                    }
                    else
                    {
                            Helper::getColorball("#000000",10,true);
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
	<li data-theme="e" data-role="list-divider" data-swipeurl=""><a href=""><center>weitere Nachrichten</center></a></li>	
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

