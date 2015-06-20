<table width="110%" style="margin-left:-50px;" >
    <tr align="center" >
        <td align="center" >
            <iframe src="/_designer/starter_pack.php" height="1000" width="100%" frameBorder="0" id="iframe-vinyls-mini"></iframe>
        </td>
    </tr>
</table>
<?php 
$flashMode = false;
if($flashMode): ?>
<table width="100%" ><tr align="center" ><td align="center" >

<script language="JavaScript" type="text/javascript">
<!--
// Version check based upon the values entered above in "Globals"
var hasReqestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);
// Check to see if the version meets the requirements for playback
if (hasReqestedVersion) {
	// if we've detected an acceptable version
	// embed the Flash Content SWF when all tests are passed
	AC_FL_RunContent(
				"src", "images/order_form_starter",
				"flashVars", "type=10&v=201004d",
				"width", "898",
				"height", "1100",
				"wmode", "transparent",
				"align", "middle",
				"id", "order_form_starter",
				"quality", "high",
				"bgcolor", "#FFFFFF",
				"name", "order_form_starter",
				"allowScriptAccess","sameDomain",
				"type", "application/x-shockwave-flash",
				'codebase', 'http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab',
				"pluginspage", "http://www.adobe.com/go/getflashplayer"
	);
}
// -->
</script>

</td></tr></table>
<?php endif;?>