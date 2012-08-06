<?
$this->set_layout("layouts/show_map");
$page_title = "Karte";
$page_id = "courses-show_map";


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
			foreach ($resources AS $resource)
			{
				?>
				$('#map_canvas').gmap('addMarker', { 'position':  '<?=$resource['latitude'] ?> ,<?=$resource['longitude'] ?>', 'bounds': false}).click(function() 
				{
					$('#map_canvas').gmap('openInfoWindow', { 'content': '<?=$resource[name] ?>' }, this);
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
