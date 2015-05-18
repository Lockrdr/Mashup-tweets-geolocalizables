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
		size: '700x700',
		mapTypeId: google.maps.MapTypeId.TERRAIN,
		
	};

map=new google.maps.Map(document.getElementById('map'), mapOptions);
var infowindow = new google.maps.InfoWindow({
	 	content: ""
	 });


function codeAddress(myLat,myLng,temp,Tweet,topic,user,createdAt,profileImage,location,skyStatus,screenName) {

	var marker = new google.maps.Marker({
			map: map,
			position: {lat: myLat, lng: myLng},
			title: temp.toString()+' grados'
		});

	google.maps.event.addListener(marker,'click',function(){
		infowindow.setContent('<div id="content">'+
    '<div id="siteNotice">'+
    '</div>'+
    
	'<b>Profile: </b><br>'+user+
	'<br> @'+screenName+
	'<br><img src="'+profileImage+'" style="width:75px;height:75px"><br>'+
    
   '<br>'+ Tweet+ '</p>'+
   '<b>Tweeted at: </b>'+createdAt+'<br><br>'+
    
    '<b>Location: </b>'+location+'<br>'+
    '<b>Temperature: </b>'+temp+' Cº<br>'+
    '<b>Sky state </b>'+skyStatus+'<br>'+
      '</p>'+
    
    '</div>');
	 	infowindow.open(map,marker);

	});
}
var lat;
var lng;
var temp;
var Tweet;
var topic;
var user;
var screenName;
var createdAt;
var profileImage;
var location;
var skyStatus;



<?php
session_start();

if(array_key_exists('total',$_SESSION)){
	for ($x = 0; $x <= $_SESSION['total']-1; $x++) 
	{

		if($_SESSION['row_count_'.$x]!= null){

			//se usa json_encode para escapar los saltos de linea
			echo"
			topic = '".$_SESSION["topic"]."';
			user = ".json_encode($_SESSION['row_count_'.$x]["user"]).";
			screenName = '".$_SESSION['row_count_'.$x]["screenName"]."';
			createdAt = '".$_SESSION['row_count_'.$x]["createdAt"]."';
			profileImage = '".$_SESSION['row_count_'.$x]["profileImage"]."';
			location = '".$_SESSION['row_count_'.$x]["location"]."';
			skyStatus = '".$_SESSION['row_count_'.$x]["skyStatus"]."';

		
			lat = ".$_SESSION['row_count_'.$x]['coords']['lat'].";
			lng = ".$_SESSION['row_count_'.$x]['coords']['lng'].";

			";	

			if($_SESSION['row_count_'.$x]['temp']==''){
				echo "temp='Temp not available'";

			}else
				echo "temp=".$_SESSION['row_count_'.$x]['temp'].";";

		
			echo "
			
			Tweet = ". json_encode($_SESSION['row_count_'.$x]['Tweet']).";";


	    	echo  "codeAddress(lat,lng,temp,Tweet,topic,user,createdAt,profileImage,location,skyStatus,screenName)";
				
		
		}
		
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

	<h2 id='tituloQuery'></h2>

	<div id="map" style = "width:800px;height:800px;"></div>


</body>
</html>








