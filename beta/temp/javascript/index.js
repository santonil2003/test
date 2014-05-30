 if (doflash) {
   document.write("	<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' width='718' height='371' id='home_top' align='middle'>");
   document.write("	<param name='movie' value='images/home_top.swf?mydynamic=ascascascac' />");
   document.write("	<param name='quality' value='high' />");
   document.write("<param name='bgcolor' value='#5b7ab3' />");
   document.write("<embed src='images/home_top.swf?mydynamic=ascascascac' quality='high' bgcolor='#5b7ab3' width='718' height='371' name='home_top' align='middle' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />"); 
   document.write("	</object> ");
 }
 else {
  document.write("<img src='images/noflash.gif' width='718' height='145' border='0' alt='no flash alt tag'>");
  document.write("<br />You can download the flash plugin here: <a href='javascript: openIt();'>Macromedia</a><br />");
  document.write("<br />If you don't want to install flash, you can view our printable order form here: <a href='pdf/order_form.pdf'>Printable Order Form</a>");
 }

