<?
// Copyright (C) 2013  Nils Bussmann

// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program. If not, see <http://www.gnu.org/licenses/>.

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
	echo "<center><h3>Leider sind für diesen Kurs keine Geoinformationen vorhanden</h3></center>";
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
					$('#map_canvas').gmap('openInfoWindow', { 'content': '<span style="font-weight:bold"><?=htmlReady($resource[name]) ?></span><br><span style="font-weight:normal;"><?=htmlReady($resource[description]) ?></span' }, this);
				});
				<?
			}
			?>  
			                                                                                                                                                                                                                             
		});
        });

</script>
<div class="ui-bar-c ui-corner-all ui-shadow" style="margin-top:0em;">
	<div id="map_canvas" style="height:335px;"></div>
</div>

<script type="text/javascript">
	// stellt sicher, dass immer 80% der höhe von der karte gefüllt sind 
	$("#map_canvas").height( $(window).height() - (0.1 * $(window).height()));
	$(window).resize(function(){
		$("#map_canvas").height( $(window).height() - (0.2 * $(window).height()));		
	});
</script>
<?
}
?>
