<?
$this->set_layout("layouts/show_map");
$page_title = "Karte";
$page_id = "courses-show_map";



// orte ohne geoinfo nicht anzeigen
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


$first_resource = array_shift($resources);
array_unshift($resources,$first_resource);
?>


<script type="text/javascript">
        $(function() {
                // Also works with: var yourStartLatLng = '59.3426606750, 18.0736160278';
                var yourStartLatLng = new google.maps.LatLng(<?=$first_resource['latitude'] ?> ,<?=$first_resource['longitude'] ?>);
                $('#map_canvas').gmap({'center': yourStartLatLng,
					zoom: 14, 
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					navigationControl: true});
		$('#map_canvas').gmap().bind('init', function() 
		{ 
			<?
			foreach ($resources_locations AS $resource)
			{
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
<div class="ui-bar-c ui-corner-all ui-shadow" style="margin-top:0em;">
	<div id="map_canvas" style="height:355px"></div>
</div>

<?
}
?>
