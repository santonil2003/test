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
var map_id = '1';

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

function returnCode(){

var returnCode = ''; 
returnCode+='<script type="text/javascript">\n';
returnCode+='function initialize() {\n';
returnCode+='if (GBrowserIsCompatible()) {\n';
returnCode+='var map = new GMap2(document.getElementById("map_canvas'+map_id+'"));\n';
returnCode+='var point = new GLatLng('+lat+','+long+');\n';
returnCode+='map.setCenter(point, '+zoom+');\n';
returnCode+='map.addControl(new GSmallMapControl());\n';
if(marker!=null){
  returnCode+='map.addOverlay(new GMarker(point));\n';
}
returnCode+='}\n';
returnCode+='}\n';returnCode+='<' + '/' + 'script>\n';

alert(returnCode);
return true;
}

</script>
</head><body onload="initialize()" onunload="GUnload()" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FDFDFD">
<tr> 
<td>
<table>
  <tr>
    <td>
    <table width="100%">
      <tr>
        <td>Latitiude: </td><td><input id="lat" name="lat" type="text" value="" onchange="updateMap(this);"></td>
      </tr>
      <tr>
        <td>Longtitude: </td><td><input id="lng" name="lng" type="text" value="" onchange="updateMap(this);"><td>
      </tr>
      <tr>
        <td>Zoom: </td><td><input id="zoom" name="zoom" type="text" value="" onchange="updateMap(this);"><td>
      </tr>
      <tr>
        <td>Marker: </td><td><input id="marker" name="marker" type="checkbox" value="" onchange="updateMap(this);"><td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td>
      <div id="map_canvas" style="width: 250px; height: 250px; overflow: hidden"></div>
    </td>
  </tr>
  <tr>
    <td align="center">
      <input type="button" name="cancel" id="cancel" value="Cancel">&nbsp;&nbsp;<input type="button" name="insert" id="insert" value="Insert Map" onClick="returnCode();">
    </td>
  </tr>
</table>
</td>
</tr>
</table>
</body>
</html>