<html>
<head>
	<title>TweetGeolocalizables</title>
</head>
<script src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>
<link rel='stylesheet' href='style.css'>
<script type='text/javascript' src='lib/jquery-1.11.2.js'></script>
<script>

google.maps.event.addDomListener(window, 'load', function(){
	
	var mapOptions = {
		center: new google.maps.LatLng(35, 0),
		zoom: 1,
		mapTypeId: google.maps.MapTypeId.TERRAIN 
	};

map=new google.maps.Map(document.getElementById('map'), mapOptions);
var infowindow = new google.maps.InfoWindow({
	 	content: ""
	 });


function codeAddress(myLat,myLng,temp,Tweet) {

	var marker = new google.maps.Marker({
			map: map,
			position: {lat: myLat, lng: myLng},
			title: temp.toString()+' grados'
		});

	google.maps.event.addListener(marker,'click',function(){
		infowindow.setContent(Tweet);
	 	infowindow.open(map,marker);

	});
}
var lat;
var lng;
var temp;
var Tweet;

var string = "fasdf\
asdfasd"

<?php
session_start();

for ($x = 0; $x <= $_SESSION['total']-1; $x++) 
	{

		if($_SESSION['row_count_'.$x]!= null){

			
			echo"

			lat = ".$_SESSION['row_count_'.$x]['coords']['lat'].";
			lng = ".$_SESSION['row_count_'.$x]['coords']['lng'].";
			temp = ".$_SESSION['row_count_'.$x]['temp'].";
			Tweet = \"".$_SESSION['row_count_'.$x]['Tweet']."\";
			";

			if($_SESSION['row_count_'.$x]['temp']=="")
			{
				echo "temp = ''";
			}


	    	echo  "codeAddress(lat,lng,temp,Tweet)";
		}
		
	}

?>
});



</script>

<body>

	<h1>Buscar tweets</h1>

	<form id='form' action='connect.php' method='post'>
	<input title='busqueda' name ='busqueda' type ='text'>
	<input type='submit' value='Encuentra tweets'>
	</form>

	<div id='map'></div>


</body>
</html>








