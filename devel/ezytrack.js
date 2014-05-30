var ezyversion = "0.1";
function setCookie(name, value, expires, path, domain, secure) {
 var curCookie = name + "=" + escape(value) +
  ((expires) ? "; expires=" + expires.toGMTString() : "") +
  ((path) ? "; path=" + path : "") +
  ((domain) ? "; domain=" + domain : "") +
  ((secure) ? "; secure" : "");
 document.cookie = curCookie;
}
function getCookie(name) {
  var dc = document.cookie;
  var prefix = name + "=";
  var begin = dc.indexOf("; " + prefix);
  if (begin == -1) {
    begin = dc.indexOf(prefix);
    if (begin != 0) return null;
  } else
    begin += 2;
  var end = document.cookie.indexOf(";", begin);
  if (end == -1)
    end = dc.length;
  return unescape(dc.substring(begin + prefix.length, end));
}
function registerCookie(name,value) {
 var now = new Date();
 now.setTime(now.getTime() + 24 * 60 * 60 * 1000);
 setCookie(name,value,now,"/");
}
if (!getCookie("ezypage")) { registerCookie("ezypage",window.location) };
if (!getCookie("ezyref")) { registerCookie("ezyref",document.referrer) };