<?
header("Cache-control: private");
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");

linkme();
?>
<script language="JavaScript">
<!--

function chkForm(theForm) {
		if (theForm.text1.value != '' && (theForm.firstLine1.value=='' || theForm.firstLine2.value=='')) {
			alert('Enter the text you would like on the reverse side');
			theForm.firstLine1.focus;
		}
		else if (theForm.text2.value != '' && (theForm.secondLine1.value=='' || theForm.secondLine2.value=='' || theForm.firstLine1.value=='' || theForm.firstLine2.value=='' || theForm.text1.value == '')) {
			alert('Enter the text you would like on the reverse side');
			theForm.secondLine1.focus;
		}
		else if (theForm.text3.value != '' && (theForm.thirdLine1.value=='' || theForm.thirdLine2.value=='' || theForm.secondLine1.value=='' || theForm.secondLine2.value=='' || theForm.text2.value == '' || theForm.firstLine1.value=='' || theForm.firstLine2.value=='' || theForm.text1.value == '')) {
			alert('Enter the text you would like on the reverse side');
			theForm.thirdLine1.focus;
		}
		else if (theForm.text4.value != '' && (theForm.fourthLine1.value=='' || theForm.fourthLine2.value=='' || theForm.thirdLine1.value=='' || theForm.thirdLine2.value=='' || theForm.text3.value == '' || theForm.secondLine1.value=='' || theForm.secondLine2.value=='' || theForm.text2.value == '' || theForm.firstLine1.value=='' || theForm.firstLine2.value=='' || theForm.text1.value == '')) {
			alert('Enter the text you would like on the reverse side');
			theForm.fourthLine1.focus;
		}
		else{
			submitform();
		}
		
}

function dis_select(changestate)
{
    //document.form1.reverse1.disabled = changestate;
	 window.location="order_identitags.php";
}

function disableAll()
{
	document.form1.text2.disabled=true;
	document.form1.secondLine1.disabled=true;
	document.form1.secondLine2.disabled=true;
	document.form1.text3.disabled=true;
	document.form1.thirdLine1.disabled=true;
	document.form1.thirdLine2.disabled=true;
	document.form1.text4.disabled=true;
	document.form1.fourthLine1.disabled=true;
	document.form1.fourthLine2.disabled=true;

}

function enableMe() 
{
	document.form1.text2.disabled=false;
	document.form1.secondLine1.disabled=false;
	document.form1.secondLine2.disabled=false;
}

function enableMe2() 
{
	document.form1.text3.disabled=false;
	document.form1.thirdLine1.disabled=false;
	document.form1.thirdLine2.disabled=false;
}

function enableMe3() 
{
	document.form1.text4.disabled=false;
	document.form1.fourthLine1.disabled=false;
	document.form1.fourthLine2.disabled=false;
}

function submitform()
{
  document.form1.submit();
}
// -->
</script>
<?php 


$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);


$query = "SELECT * FROM prices_identitags WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY multiplier";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$mysql = "SELECT * FROM prices_reverse_text WHERE prod_id = 14";
$resulte = mysql_query($mysql) or die ("sql error");
$rowe = mysql_fetch_assoc($resulte) or die ("sql error");
$reverseprice = $rowe["reverse_text_price"];

$k=0;
while($qdata = mysql_fetch_array($result)){
	$k++;
	$prices[$k] = $cur['symbol'].$qdata['price'];
}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Order - identiTAGS</title>
<script Language="JavaScript" src="/ezytrack.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style5 {font-size: 16px}
-->
</style>
<style type="text/css">
<!--
.style3 {
	font-size: 12px;
	color: #EF65A8;
	font-weight: bold;
}
-->
</style>
</head>
<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_continue_mo.gif'), disableAll()">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="181" valign="top" background="images/bg_left_column.gif"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="index.php"><img src="images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="index.php"><img src="images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="index.php"><img src="images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td>
              </tr>
            </table></td>
          <td width="418" valign="top" bgcolor="6FFF6F"> <table width="418" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top"> 
                <td width="60" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="60" height="10"></td>
                <td width="304"><img src="images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td>
                <td width="54" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="54" height="10"></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                      <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td width="13"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="105" bgcolor="#FFFFFF"><h1><span class="headings">identiTAGS</span></h1></td>
                      <td width="255" bgcolor="#FFFFFF" class="maintext"> <table width="270" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr> 
                            <td align="right" style="font-family:Comic Sans MS; font-size:12px;"><strong><span class="style5">identiTags with
                              reverse text </span> <br>
                              1 Tag for<strong> <? echo $prices[1];?> + <? echo $cur['symbol'].$reverseprice; ?></strong><br>
                            2 Tags for<strong> <? echo $prices[2];?> + <? echo $cur['symbol'].$reverseprice*2; ?><br>
                            3 Tags  for<strong> <? echo $prices[3];?> + <? echo $cur['symbol'].$reverseprice*3; ?></strong><br>
                            4 Tags  for<strong> <? echo $prices[4];?> + <? echo $cur['symbol'].$reverseprice*4; ?></strong><br>
                            </strong> </strong></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="244" valign="top" class="smalltext"><table width="178" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="10" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="168" class="smalltext"><div align="left"><font size="3" color="#FF0000"><b><?php echo $_GET['error']; ?></b></font></div></td>
                                </tr>
                              </table></td>
                            <td width="10" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="141" valign="top" class="smalltext">&nbsp;</td>
                            <td rowspan="5" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td valign="top"> <table width="390" border="0" cellspacing="2" cellpadding="2"><form name="form1" action="addtoorder.php" method="post" onSubmit="return chkForm(form1)">
                                      <td width="10%"> 
                                      <tr> 
                                        <td width="90%" colspan="2"><img src="images/identi_tags_choose.gif" width="340" height="343"></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2"><font face="Comic Sans MS">Include:&nbsp; 
                                          <input name="reverse" type="checkbox" onclick="dis_select(this.checked)" value="checkbox" checked>
                                          <strong><font size="2">Text on reverse 
                                          of tag</font></strong></font><br>
										  <span class="style3"><font face="Comic Sans MS">**extra $4.00 charge for every IdentiTag with text </font></span></p></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2"><font size="2" face="Comic Sans MS">Enter 
                                          a picture code in the boxes below and 
                                          the text you wish to display on the 
                                          reverse side of the tag:<br>
                                          </font><font face="Comic Sans MS"><span class="style3">Please note: you must fill out tags in order 1,2,3,4</span></font></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2"> <div align="left"><font face="Comic Sans MS">1st 
                                            Tag<font color="#FFFFFF">s&nbsp;</font></font> 
                                            <input name="text1" type="text" id="text1" size="5">
                                            <input name="type" type="hidden" value="14">
                                            <input name="normal" type="hidden" value="no">
                                            <input name="price1" type="hidden" value="<?= $prices[1]?>">
                                            <input name="price2" type="hidden" value="<?= $prices[2]?>">
                                            <input name="price3" type="hidden" value="<?= $prices[3]?>">
                                            <input name="price4" type="hidden" value="<?= $prices[4]?>">
                                        </div></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2"><font size="1" face="Comic Sans MS"><strong><font size="2">Line 
                                          1:</font></strong></font><font face="Comic Sans MS"> 
                                          <font color="#FFFFFF"> 
<input name="firstLine1" type="text" id="firstLine1" size="20">
                                          <br>
                                          </font><font size="2" face="Comic Sans MS"><strong>Line 
                                          2:</strong></font><font face="Comic Sans MS"><font color="#FFFFFF"> 
                                          <input name="firstLine2" type="text" id="firstLine2" size="20" onKeyDown="enableMe()">
                                          </font></font></font></td>
                                      </tr>
                                      <tr> 
                                        <td height="15" colspan="2"></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2"><font face="Comic Sans MS">2nd 
                                          Tag </font> <input name="text2" type="text" id="text2" size="5"></td>
                                      <tr> 
                                        <td colspan="2"><font size="2" face="Comic Sans MS"><strong>Line 
                                          1:</strong></font><font face="Comic Sans MS"> 
                                          <font color="#FFFFFF"> 
                                          <input name="secondLine1" type="text" id="secondLine1" size="20">
                                          </font><font size="2" face="Comic Sans MS"><strong><br>
                                          Line 
                                          2:</strong></font><font face="Comic Sans MS"><font color="#FFFFFF"> 
                                          <input name="secondLine2" type="text" id="secondLine2" size="20" onKeyDown="enableMe2()">
                                          </font></font></font></td>
                                      <tr> 
                                        <td height="15" colspan="2"></td>
                                      </tr>
                                          <td colspan="2"><font face="Comic Sans MS">3rd 
                                          Tag</font> <input name="text3" type="text" id="text3" size="5"></td>
                                      <tr> 
                                        <td colspan="2"><font size="2" face="Comic Sans MS"><strong>Line 
                                          1:</strong></font><font face="Comic Sans MS"> 
                                          <font color="#FFFFFF"> 
                                          <input name="thirdLine1" type="text" id="thirdLine1" size="20">
                                          </font><font size="2" face="Comic Sans MS"><strong><br>
                                          Line 
                                          2:</strong></font><font face="Comic Sans MS"><font color="#FFFFFF"> 
                                          <input name="thirdLine2" type="text" id="thirdLine2" size="20" onKeyDown="enableMe3()">
                                          </font></font></font></td>
                                      <tr> 
                                        <td height="15" colspan="2"></td>
                                      </tr>
                                          <td colspan="2"><font face="Comic Sans MS">4th 
                                          Tag </font> <input name="text4" type="text" id="text4" size="5">
                                          
                                          <tr> 
                                        <td colspan="2"><font size="2" face="Comic Sans MS"><strong>Line 
                                          1:</strong></font><font face="Comic Sans MS"> 
                                          <font color="#FFFFFF"> 
                                          <input name="fourthLine1" type="text" id="fourthLine1" size="20">
                                          <br>
                                          </font><font size="2" face="Comic Sans MS"><strong>Line 
                                          2:</strong></font><font face="Comic Sans MS"><font color="#FFFFFF"> 
<input name="fourthLine2" type="text" id="fourthLine2" size="20">
                                          </font></font></font> 
                                      <tr> 
                                        <td height="10" colspan="2"> 
                                      <tr> 
                                        <td><div align="center"><a href="products_identitags.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" name="back" width="94" height="22" border="0"></a> 
                                            &nbsp;&nbsp;<a href="javascript: chkForm(form1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','images/button_continue_mo.gif',1)"><img src="images/button_continue.gif" name="Image28" width="94" height="22" border="0"></a> 
                                          </div></table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td colspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr bgcolor="#66FF66"> 
                            <td colspan="5" valign="top">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="141" valign="top" bgcolor="FF9900"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top"> 
                        <?php include "navigation.php"; ?>
                      </td>
                    </tr>
                    <tr> 
                      <td> 
                        <?php include "orders.php"; ?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table></form>
            </td>
        </tr>
        <tr> 
          <td height="30" colspan="3" valign="top"> 
            <?php include "footer.php"; ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
