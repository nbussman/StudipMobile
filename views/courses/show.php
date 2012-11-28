<?
$this->set_layout("layouts/single_page_back");
$page_title = "Kurse";
$page_id = "courses-show";

if ( $course->visible == 1 )
{
// print title and subtitle
?>

<h2 class="insetText"><?= htmlReady($course->name) ?></h2>
<? if ($course->subtitle) { ?>
    <h4 style="position:relative;top:-15px;"><?= htmlReady($course->subtitle) ?></h4>
<? } 
        

/* var_dump($course->delegate->getUndecoratedData()); */
/* var_dump($course->delegate->getSingleDates()); */

if ($course->metadate)
{
        //termine
        ?>
        <div data-role="collapsible" data-theme="c" data-content-theme="d" class="small_text">
           <h3>Termine</h3>
        <?
        
        // print beginn
        if ($course->metadate->seminarStartTime)
        {
                ?>
                        <div class="ui-grid-b a_bit_smaller_text" data-theme="c" style="font-size:10pt;">
                        	<div class="ui-block-a"><strong>Beginn:</strong></div>
                        	<div class="ui-block-b"><?= Helper::stamp_to_dat(htmlReady($course->metadate->seminarStartTime)) ?></div>
                        </div><!-- /grid-a -->
                        <div class='little_space'></div>
                <? 
        }
        // print cycledates
        if ($course->metadate->cycles)
        {
        		
                $single_cycledate= true;
                foreach ($course->metadate->cycles AS $cycle_date)
                {
                        ?>
                                <div class="ui-grid-b a_bit_smaller_text" data-theme="c">
                                	<div class="ui-block-a"><strong><?= htmlReady($cycle_date->description) ?></strong></div>
                                	<div class="ui-block-b"><?=Helper::get_weekday($cycle_date->weekday) ?><br> von <?=htmlReady(substr($cycle_date->start_time, 0,5)) ?> Uhr<br>bis <?=htmlReady(substr($cycle_date->end_time, 0,5)) ?> Uhr</div>
                                	<? 
                                	if(isset($resources[$cycle_date->metadate_id][name]))
                                	{
                                	    ?>
                                	    <div class="ui-block-c">Ort: <?= htmlReady($resources[$cycle_date->metadate_id][name]) ?></div>
                                	    <?
                            	    }
                            	    ?>
                                </div><!-- /grid-b -->
                        <?
                        if ($single_cycledate)
                        {
                            echo "<div class='little_space'></div>";
                            $single_cycledate = false;
                        }
                }
        }
        ?>
                </div>
        
        <?
        	//Beschreibung
        ?>
        <div data-role="collapsible" data-theme="c" data-content-theme="d">
           <h3>Beschreibung</h3>
           <?
           	echo Helper::correctText($course->description); 
           ?>
        </div>
        <?
        // sonstiges
        ?>
        <div data-role="collapsible" data-theme="c" data-content-theme="d">
           <h3>Weiteres</h3>
        <?
                // Nummer
                if ($course->seminar_number){
                ?>
                <div class="ui-grid-a a_bit_smaller_text">
                	<div class="ui-block-a"><strong>Nummer:</strong></div>
                	<div class="ui-block-b"><?=htmlReady($course->seminar_number) ?></div>
                </div><!-- /grid-a -->
                <?
                }
                // teilnehmer
                if ($course->participants){
                ?>
                <div class="ui-grid-a a_bit_smaller_text">
                	<div class="ui-block-a"><strong>Teilnehmer:</strong></div>
                	<div class="ui-block-b"><?=htmlReady($course->participants) ?></div>
                </div><!-- /grid-a -->
                <?
                }
                // Voraussetzungen
                if ($course->requirements){
                ?>
                <div class="ui-grid-a a_bit_smaller_text">
                	<div class="ui-block-a"><strong>Voraussetzungen:</strong></div>
                	<div class="ui-block-b"><?=htmlReady($course->requirements) ?></div>
                </div><!-- /grid-a -->
                <?
                }
                //Leistungsnachweis
                if ($course->leistungsnachweis){
                ?>
                <div class="ui-grid-a a_bit_smaller_text">
                	<div class="ui-block-a"><strong>L. Nachweis:</strong></div>
                	<div class="ui-block-b"><?=htmlReady($course->leistungsnachweis) ?></div>
                </div><!-- /grid-a -->
                <?
                }
                // ects
                if ($course->ects){
                ?>
                <div class="ui-grid-a a_bit_smaller_text">
                	<div class="ui-block-a"><strong>ECTS-Punkte:</strong></div>
                	<div class="ui-block-b"><?=htmlReady($course->ects) ?> LP</div>
                </div><!-- /grid-a -->
                <?
                }
                // Lernorganisation
                if ($course->orga){
                ?>
                <div class="ui-grid-a a_bit_smaller_text">
                	<div class="ui-block-a"><strong>Lernorganisation:</strong></div>
                	<div class="ui-block-b"><?=htmlReady($course->orga) ?></div>
                </div><!-- /grid-a -->
                <?
                }
                // Sonstiges
                if ($course->Sonstiges){
                ?> 
                <div class="ui-grid-a a_bit_smaller_text">
                	<div class="ui-block-a"><strong>Sonstiges:</strong></div>
                	<div class="ui-block-b"><?=htmlReady($course->Sonstiges) ?></div>
                </div><!-- /grid-a -->
                <?
                }
        ?>
                </div>
        <?
}



?>
<br>
<!--
<ul id="course-new-content" data-role="listview" style="margin-top: 1.5em; margin-bottom: 1.5em;">
    <li data-theme="a">News<span class="ui-li-count">1</span></li>
    <li data-theme="a">Forumsbeiträge<span class="ui-li-count">3</span></li>
</ul>
-->

<fieldset class="ui-grid-a">
  <div class="ui-block-a">
    <a href="<?= $controller->url_for("activities/index", htmlReady($course->id)) ?>" data-role="button" data-iconpos="right" data-icon="star" data-theme="b">News</a>
  </div>
  <div class="ui-block-b">
    <a href="#" data-role="button" data-iconpos="right" data-icon="star" data-theme="b">Forum</a>
  </div>

  <div class="ui-block-a">
    <a href="<?= $controller->url_for("courses/list_files", htmlReady($course->id)) ?>" data-role="button">Dateien</a>
  </div>
  <div class="ui-block-b">
    <a href="<?= $controller->url_for("courses/show_members", htmlReady($course->id)) ?>"  class="externallink" data-ajax="false" data-role="button" data-iconpos="right" data-icon="" >Teilnehmer</a>
  </div>
</fieldset>


<?
$resources_locations = array();

foreach ($resources AS $reso)
{
	if ( is_numeric($reso['latitude']) && is_numeric($reso['longitude']))
	{
		//wenn keine geoinfos: aus array kicken
		$resources_locations[] = $reso;				
	}
}

if ( empty($resources_locations) )
{
	echo "<center><h3>Leider keine Geoinformationen vorhanden</h3></center>";
}
else
{

	$first_resource = array_shift($resources_locations);
	array_unshift($resources_locations,$first_resource);
?>

<script type="text/javascript">
        $(function() {
                var yourStartLatLng = new google.maps.LatLng(<?=$first_resource['latitude'] ?> ,<?=$first_resource['longitude'] ?>);
                $('#map_canvas').gmap({'center': yourStartLatLng,
					zoom: 14, 
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					'disableDefaultUI':true,
					navigationControl: false});
		$('#map_canvas').gmap().bind('init', function() 
		{ 
			<?
			foreach ($resources_locations AS $resource)
			{
				if ( !empty($resource['latitude']) ||  !empty($resource['longitude']))
				?>
				$('#map_canvas').gmap('addMarker', { 'position':  '<?=$resource['latitude'] ?> ,<?=$resource['longitude'] ?>', 'bounds': false}).click(function() 
				{
					$('#map_canvas').gmap('openInfoWindow', { 'content': '<?=htmlReady($resource[name]) ?>' }, this);
				});
				<?
			}
			?>  
			                                                                                                                                                                                                                             
		});
        });
</script>
<div class="ui-bar-c ui-corner-all ui-shadow" style="margin-top:2em;">
	<div id="map_canvas" style="height:300px"></div>
</div>
<div class="ui-grid-solo">
	<div class="ui-block-a"><a href="<?= $controller->url_for("courses/show_map", htmlReady($course->id)) ?>"  class="externallink" data-ajax="false" data-role="button" data-iconpos="right" data-icon="" >Karte vergr&ouml;&szlig;ern</a></div>
</div>


<?
}
?>



<?
}
else
{
        ?>
                <h2>Der Kurs ist leider nicht sichtbar</h2>
        <?
}
