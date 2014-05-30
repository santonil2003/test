strHtml =  '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"';
strHtml += 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="350" HEIGHT="1170"  id="prod" ALIGN="">';
strHtml += '<PARAM NAME=movie VALUE="images/order_iron_on.swf?productID=<?=PRODUCT_ID?>">';
strHtml += '<PARAM NAME=quality VALUE=high>';
strHtml += '<PARAM NAME=bgcolor VALUE=#FFFFFF>';
strHtml += '<EMBED src="images/order_iron_on.swf?productID=<?=PRODUCT_ID?>" quality=high bgcolor=#FFFFFF  WIDTH="350" HEIGHT="1170"  NAME="prod" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>';
strHtml += '</OBJECT>';
document.write(strHtml);
