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

function dis_select(changestate)
{
    //document.form1.reverse1.disabled = changestate;
	 window.location="order_identitags2.php";
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

$k=0;
while($qdata = mysql_fetch_array($result)){
	$k++;
	$prices[$k] = $cur['symbol'].$qdata['price'];
}

$mysql = "SELECT * FROM prices_reverse_text WHERE prod_id = 14";
$resulte = mysql_query($mysql) or die ("sql error");
$rowe = mysql_fetch_assoc($resulte) or die ("sql error");
$reverseprice = $rowe["reverse_text_price"];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Order - identiTAGS</title>
<script Language="JavaScript" src="/ezytrack.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_continue_mo.gif')">
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
                      <td colspan="4"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td width="13"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="138" bgcolor="#FFFFFF"><h1><span class="headings">identiTAGS</span></h1></td>
                      <td width="12"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="255" bgcolor="#FFFFFF" class="maintext"> <table width="255" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr> 
                            <td align="right"><font size="2" face="Comic Sans MS"><strong>1 
                              for <? echo $prices[1];?>, 2 for <? echo $prices[2];?></strong></font><strong>,<br>
                              <font size="2" face="Comic Sans MS">3 for <? echo $prices[3];?>, 
                              4 for <? echo $prices[4];?></font></strong></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="19"></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="5" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="244" valign="top" class="smalltext"><table width="178" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="10" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="168" class="smalltext"><div align="left">&nbsp;</div></td>
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
                                  <td valign="top"> <table width="350" border="0" cellspacing="2" cellpadding="2"><form name="form1" action="addtoorder.php" method="post">
                                      <td width="10%"> 
                                      <tr> 
                                        <td width="90%" colspan="2"><img src="images/identi_tags_choose.gif" width="350" height="299"></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2"><font face="Comic Sans MS">Include:&nbsp; 
                                          <input name="reverse" type="checkbox" onclick="dis_select(this.checked)" value="checkbox">
                                          <strong><font size="2">Text on reverse 
                                          of tag</font></strong></font></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><font size="2" face="Comic Sans MS">Enter 
                                          a picture code in the boxes below:</font></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2"> <div align="left"><font face="Comic Sans MS"><img src="images/spacer_trans.gif" width="80" height="1">1 
                                            Tag<font color="#FFFFFF">s&nbsp;</font></font> 
<input name="text1" type="text" id="text1" size="5"><input name="type" type="hidden" value="14">
                                            <font size="2" font face="Comic Sans MS"><strong> 
                                            for <? echo $prices[1];?></strong></font> 
                                          </div></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2"><font face="Comic Sans MS"><img src="images/spacer_trans.gif" width="80" height="1">2 
                                          Tags </font> <input name="text2" type="text" id="text2" size="5"> 
                                          <font size="2" font face="Comic Sans MS"><strong> 
                                          for <? echo $prices[2];?></strong></font> 
                                        </td>
                                      <tr> 
                                        <td colspan="2"><font face="Comic Sans MS"><img src="images/spacer_trans.gif" width="80" height="1">3 
                                          Tags</font> <input name="text3" type="text" id="text3" size="5"> 
                                          <font size="2" font face="Comic Sans MS"><strong> 
                                          for <? echo $prices[3];?></strong></font></td>
                                      <tr> 
                                        <td colspan="2"><font face="Comic Sans MS"><img src="images/spacer_trans.gif" width="80" height="1">4 
                                          Tags </font> <input name="text4" type="text" id="text4" size="5"> 
                                          <font size="2" font face="Comic Sans MS"><strong> 
                                          for <? echo $prices[4];?></strong></font> 
                                      <tr> 
                                        <td height="10" colspan="2"> 
                                      <tr> 
                                        <td><div align="center"><a href="products_identitags.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" name="back" width="94" height="22" border="0"></a> 
                                            <a href="javascript: submitform()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image28','','images/button_continue_mo.gif',1)">&nbsp;<img src="images/button_continue.gif" name="Image28" width="94" height="22" border="0"></a> 
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
