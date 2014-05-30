
function openWinNoresize(url, width, height) {
        var win = window.open(url, '_blank','resizable=no,scrollbars=yes,status=no,directories=no,toolbar=no,address=no,menubar=no,width='+width+',height='+height);
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_findObj(n, d) { //v4.01
var p,i,x; if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function mm_showhidelayers() { //v6.0
var i,p,v,obj,args=mm_showhidelayers.arguments;
for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
obj.visibility=v; }
}

fixMozillaZIndex=true; //Fixes Z-Index problem with Mozilla browsers but causes odd scrolling problem, toggle to see if it helps
_menuCloseDelay=500;
_menuOpenDelay=150;
_subOffsetTop=0;
_subOffsetLeft=1;


with(menuStyle=new mm_style()){
align="center";
menuheight=28;
imageheight:28;
itemheight:28;
imagepadding=0;
padding=0;
zindex=80;
}

with(menuSub=new mm_style()){
align="left";
bordercolor="#95acd3";
borderstyle="solid";
borderwidth=1;
fontfamily="Trebuchet MS, Tahoma, Arial";
fontsize="11";
fontweight="bold";
fontstyle="normal";
itemheight=31;
menuheight=31;
itemwidth=141;
menuheight=141;
headerbgcolor="#FFFFFF";
headercolor="#000000";
offbgcolor="#456eb2";
offcolor="#ffffff";
onbgcolor="#365d9c";
oncolor="#ffffff";
/*outfilter="randomdissolve(duration=0.0)";*/
/*overfilter="Fade(duration=0.0);Alpha(opacity=100)";*/
padding=7;
pagebgcolor="#365d9c";
pagecolor="#ffffff";
separatorcolor="#95acd3";
separatorsize=1;
zindex=81;
}