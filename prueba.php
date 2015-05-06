<!DOCTYPE html>
<html>
<body>


  <h1>My first PHP page</h1>

  <script type='text/javascript' src='lib/jquery-1.11.2.js'></script>




  <script>
/*
(function() {
  var weatherResutl = "http://www.myweather2.com/developer/forecast.ashx?uac=zThV.WApjN&query=24.15,56.32";
  $.getJSON( weatherResutl, {
    tagmode: "any",
    format: "jsonp"
  })
    .done(function( data ) {
      $.each( data.items, function( i, item ) {
        console.log ("ea");
      });
    });
})();


var invocation = new XMLHttpRequest();
var url = 'http://www.myweather2.com/developer/forecast.ashx?uac=zThV.WApjN&query=24.15,56.32';


function callOtherDomain(){
  if(invocation)
  {
      invocation.open('POST', url, true);
    invocation.setRequestHeader('JSONP', 'application/xml');
    invocation.onreadystatechange = work;
    invocation.send(); 
  }
}
function work(){
  console.log("funciono?");
}

callOtherDomain();*/
</script>

  <script type="text/javascript">







/*
 $.getJSON('http://www.myweather2.com/developer/forecast.ashx?uac=zThV.WApjN&query=24.15,56.32"', 
    function(data) {
    console.log(data);
    });


var xmlhttp;
var txt,x,i;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    xmlDoc=xmlhttp.responseXML;
    txt="";
    x=xmlDoc.getElementsByTagName("temp");
    for (i=0;i<x.length;i++)
      {
      txt=txt + x[i].childNodes[0].nodeValue + "<br>";
      }
    document.getElementById("myDiv").innerHTML=txt;
    }
  }
xmlhttp.open("GET","http://www.myweather2.com/developer/forecast.ashx?uac=zThV.WApjN&query=24.15,56.32",true);
xmlhttp.send();
function ajaxCallSucceed() {
	alert("bien");

};

function ajaxCallFailed() {
alert("mal");

};
*/

$.ajax({


	url: "http://benalman.com/code/projects/php-simple-proxy/ba-simple-proxy.php?url=http%3A%2F%2Fwww.myweather2.com%2Fdeveloper%2Fforecast.ashx%3Fuac%3DzThV.WApjN%26query%3D24.15%2C56.32",
	
	// data: {uac:"zThV.WApjN", query:"24.15,56.32"},
   
 
   
	  dataType: "jsonp",
    //jsonpCallback: 'jsonpCallback',
	  success: function (data) {
             console.log("succes");
        },
        failure: function(error){
            console.log("fail");
        },
        error : function (result, xh) {
        alert("error");
    }



});
function jsonpCallback(data){
    alert("jsonpCallback");
}

/*

$('#').load(
    'http://localhost:8080/sc/Mashuptweetsgeolocalizables/proxy.php', {
        csurl: 'http://www.myweather2.com/developer/forecast.ashx?uac=zThV.WApjN&query=24.15,56.32',
        uac: 'zThV.WApj', 
        query: '24.15,56.32', 
    }
);
*/
</script>

<div id="myDiv">

</div>
</body>
</html>