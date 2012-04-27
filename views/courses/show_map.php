<?
$this->set_layout("layouts/show_map");
$page_title = "Karte";
$page_id = "courses-show_map";

?>

<script type="text/javascript">
        $(function() {
                // Also works with: var yourStartLatLng = '59.3426606750, 18.0736160278';
                var yourStartLatLng = new google.maps.LatLng(<?=$center ?>);
                $('#map_canvas').gmap({'center': yourStartLatLng,
					zoom: 13, 
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					navigationControl: true});
		$('#map_canvas').gmap().bind('init', function() 
		{ 
			$('#map_canvas').gmap('addMarker', { 'position':  '<?=$position['coordinate'] ?>', 'bounds': false}).click(function() 
			{
				$('#map_canvas').gmap('openInfoWindow', { 'content': '<?=$position['text'] ?>' }, this);
			});                                                                                                                                                                                                                               
		});
        });
</script>
<div class="ui-bar-c ui-corner-all ui-shadow" style="padding:1em;">
	<div id="map_canvas" style="height:400px"></div>
</div>