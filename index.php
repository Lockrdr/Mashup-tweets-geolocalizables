<?php
session_start();




echo "

<html>
<head>
	<title>TweetGeolocalizables</title>
</head>
<script src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>


<link rel='stylesheet' href='style.css'>


<script type='text/javascript' src='lib/jquery-1.11.2.js'></script>



<script>



google.maps.event.addDomListener(window, 'load', function(){

	
	geocoder = new google.maps.Geocoder()

	var mapOptions = {
		center: new google.maps.LatLng(35, 0),
		zoom: 1,
		mapTypeId: google.maps.MapTypeId.TERRAIN 
	};

	map=new google.maps.Map(document.getElementById('map'), mapOptions);




codeAddress('caracas');";

for ($x = 0; $x <= 20; $x++) 
	{

    	echo  "codeAddress(".'"'.$_SESSION["row_count_$x"].'");';
	}

echo"


});


function codeAddress(address) {


	var address= address;
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {

			var marker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location,
				title: 'salchicha'
			});

		} else {
			//alert('Geocode was not successful for the following //reason: ' + status);
		}
	});
}

</script>



<body>

	<h1>Buscar tweets</h1>

	<form id='form' action='connect.php' method='post'>
	<input title='busqueda' name ='busqueda' type ='text'>
	<input type='submit' value='Encuentra tweets'>
	</form>


	$_SESSION[row_count_0];
	

	<div id='map'></div>


</body>
</html>
	"


?>




