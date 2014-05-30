<?
session_start();
header("Cache-control: private");

if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

$_SESSION['maxi_pack3']['phoneVal'] = $_POST['phoneVal'];
$_SESSION['maxi_pack3']['picVal'] = $_POST['picVal'];
$_SESSION['maxi_pack3']['kidsName'] = $_POST['kidsName'];
$_SESSION['maxi_pack3']['kidsPhone'] = $_POST['kidsPhone'];
//$_SESSION['maxi_pack3']['kidsName'] = $_SESSION['maxi_pack1']['kidsName'];
//$_SESSION['maxi_pack3']['kidsPhone'] = $_SESSION['maxi_pack1']['kidsPhone'];
$_SESSION['maxi_pack3']['chosenPic'] = $_POST['pic'];
$_SESSION['maxi_pack3']['background_colour'] = $_POST['background_colour'];
$_SESSION['maxi_pack3']['font_colour'] = $_POST['font_colour'];
$_SESSION['maxi_pack3']['vsemiPermanent'] = $_POST['vsemiPermanent'];

//print_r($_POST);
//print_r($_SESSION);

linkme();

$result = product_details(34, $_COOKIE['currency'], $product);
$price_formatted = (int)$product['unitQuant'] . " for " . $product['symbol'].$product['price'];
$price = ((int)form_param('chosenQuant') + 1) * $product['price'];

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Order - <?= $product['productName']; ?></title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<script src="../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>


<style type="text/css">
.style1 {font-family: "Comic Sans MS"}
.style2 {color: #FF9900}
.style3 {color: #FFFFFF}
</style>
</head>
<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_continue_mo.gif')">

<script language="JavaScript">
	
	function checkForm(f){
		//alert (f.name);
		if(f.identitag.value == "0"){
			alert ("Please choose an IdentiTag code.");
			return false;
		}
		if(f.identiband.value == "0"){
			alert ("Please choose an IdentiBand code.");
			return false;
		}
		if(f.ziptag.value == "0"){
			alert ("Please choose a ZipTag code.");
			return false;
		}
		return true;
	}
</script>

<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
 <form name="form1" action="addtoorder.php" method="post" onSubmit="return checkForm(this)">
	<input type="hidden" name="type" value="34"> 
  <tr>
    <td valign="top">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#5D7EBC">
        <tr> 
          <td width="181" valign="top" background="images/bg_left_column.gif"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td>
              </tr>
            </table></td>
          <td width="418" valign="top" bgcolor="6FFF6F">
<table width="418" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top"> 
                <td width="60" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="60" height="10"></td>
                <td width="304"><img src="images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td>
                <td width="54" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="54" height="10"></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F">
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_our_products.gif" alt="Our Products" width="167" height="45"></div></td>
                      <td bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td colspan="4"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="4">
                      <table width="100%" border=0 bgcolor="#FFFFFF">
                      	<tr>
                      		<td bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      		<td valign="top" bgcolor="#FFFFFF"><h1 class="headings"><?= $product['productName']; ?></h1></td>
                      		<td align="right" bgcolor="#FFFFFF" class="maintext"><strong><?= $price_formatted; ?></strong></td>
                      		<td bgcolor="#FFFFFF" ><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      	</tr>
                      	
                          
                          <tr valign="top"> 
                          	<td width="10" rowspan="8" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td bgcolor="#FFFFFF"><p class="style1">4. Choose an IdentiTag</p>
                                  <p><img src="images/identi_tags_choose.gif" width="340" height="343"></p></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top">
                            <td colspan="3" bgcolor="#5D7EBC"><div align="center" class="style2"><span class="style3"><font face="Comic Sans MS">Choose an IdentiTag code:</font><font face="Comic Sans MS"></font></span><font face="Comic Sans MS">&nbsp;</font>
                                <!--<input name="identitag" type="text" id="identitag" size="5">-->
								<select name="identitag">
									<option value="0">Choose...</option>
						<?	$sql = "SELECT *
											FROM data_identitag
											ORDER BY data_identitag_code ASC ";
								$result = db_query($sql);
								while($record = db_fetch_array($result)){
									?><option value="<?=$record['data_identitag_code']?>"><?=$record['data_identitag_code']?> - <?=$record['data_identitag_name']?></option><?
								}
						
						?>	</select>
                            </div></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><p>&nbsp;</p>
                            <p class="style1">5. Choose an IdentiBand</p>
                            <p class="style1"><img src="images/identibands_options.jpg" width="375" height="267"></p>                            </td>
                          </tr>
                          <tr valign="top">
                            <td colspan="3" bgcolor="#5D7EBC"><div align="center"><span class="style2"><span class="style3"><font face="Comic Sans MS">Choose an IdentiBand code:</font></span><font face="Comic Sans MS">&nbsp;</font>
                                  <!--<input name="identiband" type="text" id="identiband" size="5">-->
 								<select name="identiband">
									<option value="0">Choose...</option>
						<?	$sql = "SELECT *
											FROM data_identiband
											ORDER BY data_identiband_code ASC ";
								$result = db_query($sql);
								while($record = db_fetch_array($result)){
									?><option value="<?=$record['data_identiband_code']?>"><?=$record['data_identiband_code']?> - <?=$record['data_identiband_name']?></option><?
								}
						
						?>	</select>
                           </span></div></td>
                          </tr>
                          <tr valign="top">
                            <td colspan="3" bgcolor="#FFFFFF"><p class="style1">6. Choose a Zip Tag</p>
                            <p align="center"><img src="images/ziptags.gif" width="345" height="400"></p></td>
                          </tr>
                          <tr valign="top">
                            <td colspan="3" bgcolor="#5D7EBC"><div align="center"><span class="style2"><span class="style3"><font face="Comic Sans MS">Choose a Zip Tag code:</font></span><font face="Comic Sans MS">&nbsp;</font>
                               <!-- <input name="ziptag" type="text" id="ziptag" size="5"> -->
 								<select name="ziptag">
									<option value="0">Choose...</option>
						<?	$sql = "SELECT *
											FROM data_ziptag
											ORDER BY data_ziptag_code ASC ";
								$result = db_query($sql);
								while($record = db_fetch_array($result)){
									?><option value="<?=$record['data_ziptag_code']?>"><?=$record['data_ziptag_code']?> - <?=$record['data_ziptag_name']?></option><?
								}
						
						?>	</select>
                           </span></div></td>
                          </tr>
                          <tr valign="top">
                            <td colspan="3" bgcolor="#FFFFFF"><p>&nbsp;</p>
                            <p align="right">
							<a href="javascript:history.go(-1);"><img src="images/button_back.gif" border="0"></a>&nbsp;
							<!--<a href="javascript:document.form1.submit();"><img src="images/button_continue.gif" border="0"></a>-->
							<input type="image" src="images/button_continue.gif" border="0">
							</td>
                          </tr>
                          <tr bgcolor="#66FF66"> 
                            <td colspan="5" valign="top">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="141" valign="top" bgcolor="FF9900"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFE600">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top" bgcolor="#FFE600">
					  
					  <?php include "navigation.php"; ?></td>
                    </tr>
                    <tr> 
                      <td bgcolor="#FFE600"> 
                        <?php include "orders.php" ?>                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" colspan="3" valign="top" bgcolor="#5D7EBC"> 
            <?php include "footer.php" ?>          </td>
        </tr>
      </table></td>
  </tr>
  </form>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
