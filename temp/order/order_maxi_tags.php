<?

/*
session_start();
header("Cache-control: private");

if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

//debug_showvar($_POST);
//exit;

linkme();
*/


$result = product_details(34, $_COOKIE['currency'], $product);
$price_formatted = (int)$product['unitQuant'] . " for " . $product['symbol'].$product['price'];
$quantDesc = (int)$product['unitQuant']. " ".$product['productName']." for " . $product['symbol'].$product['price'];

$_SESSION['maxi_pack']['quantdesc'] = $quantDesc;
$_SESSION['maxi_pack1_name'] = $_POST['kidsName'];
$_SESSION['maxi_pack1_phone'] = $_POST['kidsPhone'];
$_SESSION['maxi_pack1_pic'] = $_POST['pic'];
$_SESSION['maxi_pack_split'] =  $_POST['split'];
$_SESSION['maxi_pack1_background_colour'] = $_POST['background_colour'];
$_SESSION['maxi_pack1_font_colour'] = $_POST['font_colour'];
$_SESSION['maxi_pack1_split'] = $_POST['split'];
$_SESSION['maxi_pack3_vsemiPermanent'] = ((int)$_POST['text6']==2?0:1);
$_SESSION['maxi_pack3_background_colour'] = $_POST['text4'];

//print_r($_POST);
//print_r($_SESSION);

?>
<script language="JavaScript">
	
	function checkForm(f){
		//alert (f.name);
		if(f.maxi_pack_identitag_pic.value == "0"){
			alert ("Please choose an IdentiTag code.");
			return false;
		}
		if(f.maxi_pack_identiband_pic.value == "0"){
			alert ("Please choose an IdentiBand code.");
			return false;
		}
		if(f.maxi_pack_ziptag_pic.value == "0"){
			alert ("Please choose a ZipTag code.");
			return false;
		}
		return true;
	}
</script>

 <form name="form1" action="addtoorder.php" method="post" onSubmit="return checkForm(this)">
	<input type="hidden" name="type" value="34"> 
 
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
								<select name="maxi_pack_identitag_pic">
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
 								<select name="maxi_pack_identiband_pic">
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
 								<select name="maxi_pack_ziptag_pic">
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
                          
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
  </form>

