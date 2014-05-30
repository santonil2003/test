var bo_ns_id = 0;

function startIeFix(){
if(isIE()){
document.write('<noscript id="bo_ns_id_' + bo_ns_id + '">');
}
}

function endIeFix(){
if(isIE()){
var theObject = document.getElementById("bo_ns_id_" + bo_ns_id++);
var theNoScript = theObject.innerHTML;
document.write(theNoScript);
}
}

function isIE(){
var strBrowser = navigator.userAgent.toLowerCase();
if(strBrowser.indexOf("msie") > -1 && strBrowser.indexOf("mac") < 0){
return true;
}else{
return false;
}
}