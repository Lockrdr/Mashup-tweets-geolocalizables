<html>
<head>
	<title>Tweets Geolocalizables</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/default.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
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
	
	<div id="view">
		<div id="head">
			<div align=center id="main">
			  <h1><a >Geolocalizable Tweets</a></h1>
			</div>
		</div>
		
		 <div id="content">
			<div id="contentBlock">
			  <div class="item mainItem">
					<br>
					<h1>Search Inside Tweets</h1>
					<br>

					<form id='form' action='connect.php' method='post'>
					<input title='busqueda' name ='busqueda' type ='text'>
					<input id ="tweetWord" type='submit' value=' Find Tweets '>
					</form>

					<h2 id='tituloQuery'></h2>
					<br>
					<div id="map" style = "width:715px;height:715px;"></div>
			  </div>
			</div>
		 </div>
		 
	  <div id="foot">
		<p class="fl">&copy; all rights reserved</p>
		<p class="fr">created by Ricardo de la Rosa Vivas y Daniel Ruiz Manero <img src="img/penguin.png" style="width:15px;"></p>
	  </div>
	  
	</div>
	
	<div align=center>This Web Page has been created for the SC second practice</div>


</body>
</html>








