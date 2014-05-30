<?

require_once("../constants.php");
linkme();
session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

include("formparts.php");
include("formtypes.php");

if($_GET["type"]=="" || !$_GET["type"]){
	header("location:addphoneorder.php?startrecord=".$_GET["startrecord"]."&showperpage=".$_GET["showperpage"]);
}

// check for currency
if(!isset($_COOKIE['currency'])){
	// default to AU dollars
	//setcookie("currency", 1, time()+3600);
	setcookie("currency", 1);
}

//echo "COOKIE=".$_COOKIE['currency'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - add phone order item</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>

<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td valign="top" align="center">
				<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9">
					<tr>
						<td bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
					<tr>
						<td><img src="../images/spacer_trans.gif" height="1" width="600" border="0"></td>
					</tr>
					<tr>
						<td>
						<?
						$type = $_GET["type"];
						switch($type){
							case "vinyl":
								vinyl();
								break;
							case "diylarge":
								diylabel(9);
								break;
							case "diysmall":
								diylabel(8);
								break;
							case "mini":
								mini();
								break;
							case "iron":
								iron();
								break;
							case "shoe":
								shoe();
								break;
							case "pencil":
								pencil();
								break;
							case "gift":
								gift();
								break;
							case "kidcards":
								kidcards();
								break;
							case "identiTAGS":
								identiTAGS();
								break;
							case "identiBANDS":
								identiBANDS();
								break;
							case "ziptags":
								ziptags();
								break;
							case "zipdedo":
								zipdedo();
								break;
							case "giftvoucher":
								giftvoucher();
								break;
							case "shared":
								sharedpack();
								break;
							case "allergy":
								allergyPack();
								break;
							case "coloured-ironons":
								coloured_ironons();
								break;
							case "shoedots":
								shoedots();
								break;
							case "worldpack":
								colour_my_world_pack();
								break;
							case "addresslabels":
								address_labels();
								break;
							case "customlabel":
								custom_label();
								break;
							case "newbabypack":
								newbabypack();
								break;
							case "booklabels":
								book_labels();
								break;
							case "maxipack":
								maxi_pack();
								break;
						   case "thingamejig_name_bracelet":
								thingamejig_name_bracelet();
								break;
						   case "thingamejig_collar":
								thingamejig_collar();
								break;
						   case "thingamejig_boybandz":
								thingamejig_boybandz();
								break;
						   case "thingamejig_gadget":
								thingamejig_gadget();
								break;
							case "bin_labels":
								bin_labels();
								break;
							case "magpie_eyes":
								magpie_eyes();
								break;
							
						}
						?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</body>
</html>
