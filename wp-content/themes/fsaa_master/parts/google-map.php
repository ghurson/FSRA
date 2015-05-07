<h1 style='position: relative; z-index: 2;'><?php the_field("map_title"); ?></h1>
<div id='google_map' style='height: 500px;'></div>

<?php
$loc = get_field("marker_location");
?>

<script type='text/javascript'>
	function initialize() {
		var mapOptions = {
			center: {lat: -4.7494, lng: 55.483918},
			zoom: 14
		};
		var map = new google.maps.Map(document.getElementById('google_map'), mapOptions);
		var myLatlng = new google.maps.LatLng(<?php print $loc['lat']; ?>, <?php print $loc['lng']; ?>);
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
		});



		var infowindow = new google.maps.InfoWindow({
			content: '<p style="color: black">Four Seasons<br />Resort Seychelles</p>'
		});

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map, marker);
		});

	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>