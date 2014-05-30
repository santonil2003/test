<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Twin Ocean Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<!-- 
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAjAjO-jmVe4G4vqZRSpWsqhSfpuv1JTFqJOHBnrSzOirm8Uv61xSQeudCBuKeGwQr_v68x3motJQIqA"
            type="text/javascript"></script>
-->
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAjAjO-jmVe4G4vqZRSpWsqhSfpuv1JTFqJOHBnrSzOirm8Uv61xSQeudCBuKeGwQr_v68x3motJQIqA"
            type="text/javascript"></script>
<script type="text/javascript">

var lat= -25.999709979893115;
var long= 133.1975555419922;
var zoom= 3;
var use_marker = false;
var marker = null;
var map;

function setMapCenter(){
  $("lat").value = lat;
  $("lng").value = long;
  $("zoom").value = zoom; 
  map.setCenter(new GLatLng(lat,long), zoom);
}


function setmarker(point) {

  if(use_marker == true) {
  
    if(point == null){
      var point = new GLatLng(lat,long);
    }
      
    if(marker != null) {
      marker.remove();
      marker = null;
    }
     
    marker = new GMarker(point, {draggable: true});

    GEvent.addListener(marker, "dragstart", function() {
  	   map.closeInfoWindow();
  	 });

    GEvent.addListener(marker, "dragend", function() { 
      var point = this.getPoint();
      lat= point.y;
		long= point.x;
		zoom= map.getZoom();
      setMapCenter();
    });

    map.addOverlay(marker);
  }

}


function updateMap(obj){
  switch(obj.id) {
    case 'lat':
      lat = parseFloat(obj.value);
      zoom = map.getZoom();
      break;
    case 'lng':
      long = parseFloat(obj.value);
      zoom = map.getZoom();
      break;
    case 'zoom':
      zoom = parseInt(obj.value);
      break;
    case 'marker':
      if(obj.checked == true) {
        use_marker = true;
        if(marker == null) {
 		    setmarker();
 		  }
      } else {
        use_marker = false;
        if(marker != null) {
  		    marker.remove();
  		    marker = null;
 		  }
      }
      break;
      
  }
  
  if(use_marker != false){
    setMapCenter();
  }
}



function initialize() {
  if (GBrowserIsCompatible()) {
  
    map = new GMap2(document.getElementById("map_canvas"));
    map.setCenter(new GLatLng(lat,long), zoom);
    map.addControl(new GSmallMapControl());
    GEvent.addListener(map,"click", function(overlay,point) { 
      lat= point.y;
		long= point.x;
		zoom= map.getZoom();
      setmarker(point);
      setMapCenter();
	 });
	  
    $("lat").value = lat;
	 $("lng").value = long;
    $("zoom").value = zoom;
    
  }
}

function $(id){
  return document.getElementById(id);
}

</script>
<style type="text/css">
<!--
body {
	background-color: #FDFDFD;
}
-->
</style></head><body onload="initialize()" onunload="GUnload()" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0">
<table width="100%" height="87" border="0" cellpadding="0" cellspacing="0" >
  <tr> 
    <!--<td height="106" colspan="2" class="adminBg"><img src="images/header_logo.gif" width="281" height="106" align="left"><img src="images/header_echidna.gif" width="167" height="106" align="right"></td>-->
	<td height="91" bgcolor="#333333"><table width="100%" height="94" border="0" cellpadding="0" cellspacing="0" style="background-image: url('images/b_header.gif'); background-position: right;">

            <tr>

                        <td width="277"><img src="images/logo.gif" alt="logo" width="256" height="94" border="0"></td>

                        <td align="center"><img src="images/h_admin.gif" width="388" height="94" alt="ADMINISTRAION"></td>

                        <td width="277" align="right" valign="top"><img src="images/echidna_logo.gif" alt="Echidna Web Design" width="174" height="94" border="0"></td>

            </tr>

</table>
</td>
  </tr>
</table>
 <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FDFDFD">
  <tr> 
    <td width="150"  valign="top" align="center" bgcolor="#FDFDFD">
      <?php include("admin_nav.php"); ?>
		  <!-- end header -->