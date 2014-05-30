<?
session_start();

if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

include("useractions.php");
define('PRODUCT_ID',19);

linkme();

//$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=4 AND a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";
$query = "	SELECT * 
			FROM prices a, currencies b, product c 
			WHERE a.productId = c.id 
			AND a.productId=".PRODUCT_ID." 
			AND a.currencyInt=".$_COOKIE["currency"]." 
			AND a.currencyInt=b.id";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$price = mysql_fetch_assoc($result);
$title = $price['productName'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Products - <?=$title?></title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="childrens shoe labels, sneaker label, running shoes">

<meta name="description" content="Our special range of glossy, adhesive shoe labels for school children. Sticks to all surfaces and the name never rubs off.">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
//-->
</script>
<link href="css/identi kid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                      <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td width="15"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="212" bgcolor="#FFFFFF" class="headings"> 
                        <h1><span class="headings"><?=$title?></span></h1></td>
                      <td width="18"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="138" bgcolor="#FFFFFF" class="maintext"> 
                        <div align="right"><strong><img src="images/spacer_trans.gif" width="10" height="19"><FONT size=2><FONT face=Arial>60 for $22</FONT></FONT></strong></div></td>
                      <td width="35"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="8" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td valign="top"> <img src="images/spacer_trans.gif" width="10" height="10"><span class="maintext">Choose one background colour and black or white text</span></td>
                            <td width="10" rowspan="8" valign="top" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="70%"><div align="center"><img src="images/PAGE_PRODUCT_COLOURED_IRONONS.gif" alt="Shoe Dots" width="373" height="214"></div></td>
                                </tr>
                              </table>
                              <div align="center"></div></td>
                          </tr>
                          <tr valign="top"> 
                            <td><img src="images/spacer_trans.gif" width="30" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td><img src="images/spacer_trans.gif" width="30" height="20"></td>
                          </tr>
                          <tr valign="top"> 
                            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td class="maintext"><strong><img src="images/spacer_trans.gif" width="10" height="10"></strong></td>
                                  <td class="maintext"><ul>
                                    <li> 12.5-15 mm X 50-55mm (custom sized)</li>
                                    <li>Choose one background colour and black or white text</li>
                                    <li>Rounded corners with white backing for light clothing</li>
                                    <li>Soft and smooth for sensitive skin</li>
                                    <li>Revolutionary material actually becomes part<br>
                                      of the fabric its ironed onto!</li>
                                    <li><SPAN class=453471508-18082005>Permanent transfers</SPAN></li>
                                    <li><SPAN class=453471508-18082005>Can be used in industrial washers and dryers. </SPAN></li>
                                    <li><SPAN class=453471508-18082005>Good for nursing homes.</SPAN><br>
                                    </li>
                                    </ul></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr valign="top"> 
                            <td><img src="images/spacer_trans.gif" width="30" height="15"></td>
                          </tr>
                          <tr valign="top"> 
                            <td bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="44%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back to previous page" name="back" width="94" height="22" border="0"></a></td>
                                  <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="52%"><a href="order_coloured_ironons.php"><img src="images/button_add_order.gif" alt="Add to Order" name="add_order" width="94" height="22" border="0"></a></td>
                                </tr>
                              </table>
							                                <br>                                   
                              <br>
                              <hr width="100%" size=1>
								
                                    <p> <span class="headings">Other identiKid products </span>
                                    <?PHP
									require_once("./products_include.php");
									?></p></td>
                          </tr>
                          <tr> 
                            <td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr bgcolor="#66FF66"> 
                            <td colspan="3" valign="top">&nbsp;</td>
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
                      <td valign="top"><?php include "navigation.php"; ?></td>
                    </tr>
                    <tr> 
                      <td> 
                        <?php include "orders.php" ?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" colspan="3" valign="top"> 
            <?php include "footer.php" ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
