strHtml =  '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="<? echo $codebase;?>" WIDTH="141" HEIGHT="375" id="navigation_03" ALIGN="">';
strHtml += '<PARAM NAME=movie VALUE="../flash/navigation.swf">';
strHtml += '  <PARAM NAME=quality VALUE=high>';
strHtml += '  <PARAM NAME=bgcolor VALUE=#EE0280>';
strHtml += '  <EMBED src="../flash/navigation.swf" quality=high bgcolor=#EE0280  WIDTH="141" HEIGHT="375" NAME="navigation_03" ALIGN=""';
strHtml += ' TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED> ';
strHtml += '</OBJECT>';
document.write(strHtml);
