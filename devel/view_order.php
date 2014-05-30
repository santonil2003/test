<?
session_start();
include("useractions.php");
include("vieworderlist.php");

if(!isset($_COOKIE["currency"])){
	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);
	exit;
}

if (isset($_GET["change_post"]))
{
	unset($_SESSION["post_option"]);
}

/*
// if cancel express post clicked
if (isset($_GET["unsetexpress"]))
{
	unset($_SESSION["express_post"]);
	unset($_GET["unsetexpress"]);
}*/

linkme();
$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);

$secure=true;

$id = checkOrderId(false);

if($id){
	$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	if(mysql_num_rows($result)>0){
		while($qdata = mysql_fetch_array($result)){
			$totalprice += $qdata["price"];
		}
	}
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - View Order</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="Label,labels,labelling,personalised,labels,name,identikid,identi,kid,sticker,stickers,vinyl,iron,iron-on,tag,shoes,pencil,pack,fabric,bag,child,kidcards,kid,cards,clothing,lost,property,school">
<meta name="description" content="Personalised name labels that really work.  Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more.  Design your own labels online, with your choice of fun fonts and pictures.  All products are high quality, attractive and easy to use.
"><script language="JavaScript" type="text/JavaScript">
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
//-->
</script>
<link href="../css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="../images/bg_pattern.gif" onLoad="MM_preloadImages('../images/button_remove_item_mo.gif','../images/button_back_mo.gif','../images/button_more_info_small_mo.gif','../images/button_check_out_mo.gif','../images/but_express_over.gif','../images/but_submit_over.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="740" valign="top"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="181" valign="top" background="../images/bg_left_column.gif"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="../images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="../images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="../images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td>
              </tr>
            </table></td>
          <td width="418" valign="top" bgcolor="#6FFF6F"> 
            <table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F">
              <tr valign="top"> 
                <td width="60" background="../images/bg_blue_heading.gif"><img src="../images/spacer_trans.gif" width="60" height="10"></td>
                <td width="304" bgcolor="5d7eb9"><img src="../images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td>
                <td width="54" background="../images/bg_blue_heading.gif"><img src="../images/spacer_trans.gif" width="54" height="10"></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="418" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="6FFF6F"><div align="right"><img src="../images/heading_view_order.gif" alt="View Order" width="167" height="45"></div></td>
                      <td bgcolor="6FFF6F"><img src="../images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top" bgcolor="#66FF66"> 
                <td colspan="3" bgcolor="#6FFF6F"> 
                  <table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr> 
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="393" valign="top" bgcolor="#FFFFFF"> 
                        <table width="393" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td colspan="3">&nbsp;</td>
                          </tr>
						  <? if($_GET['error']=="nopostage"){?>
						  <tr>
						  	<td colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr> 
									  <td width="6%" rowspan="6" valign="top" class="maintext"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
									  <td width="94%" valign="top" class="maintext" align="center"><strong><font color="#FF0000">Please select a postage option below to continue</font></strong></td>
									</tr>
									<tr> 
									  <td width="6%" rowspan="6" valign="top" class="maintext"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
									  <td width="94%" valign="top" class="maintext"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
									</tr>
									<tr> 
									  <td width="6%" rowspan="6" valign="top" class="maintext"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
									  <td width="94%" valign="top" class="maintext"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
									</tr>
								</table>
							</td>
						  </tr>
						  <? } 
						   if($cur['minimumOrder']>$totalprice){?>
						  <tr>
						  	<td colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr> 
									  <td width="6%" rowspan="6" valign="top" class="maintext"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
									  <td width="94%" valign="top" class="maintext"><strong>The minimum order that can be placed is for <? echo $cur['symbol'].$cur['minimumOrder']; ?></strong></td>
									</tr>
								</table>
							</td>
						  </tr>
						  <? } 
						  // reset
						  $totalprice=0;?>
                          <tr> 
                            <td colspan="3">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <? viewOrder($id, "user"); ?>
                          	</table></td>
                          </tr>
                          <tr> 
                            <td colspan="3">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                                <? 
							 if($totalprice>=50 && $_COOKIE["currency"]==1 && false){ ?>
                                <? ?>
                                <tr> 
                                  <td>&nbsp;</td>
                                  <td width="36%"><a href="../competition.php"><img src="../images/competition.gif" alt="" width="175" height="235" border="0"></a></td>
                                  <td width="2%"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  <td colspan="3" valign="top"><strong>Congratulations!</strong><br> 
                                    <br>
                                    Your order is $50 or more so you qualify for 
                                    our Win a Laptop competition You will be automatically 
                                    entered once this order is completed. The 
                                    winner will be contacted and announced on 
                                    the website on 12 March 2005</td>
                                </tr>
                                <tr> 
                                  <td height="10" colspan="6"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="5%" rowspan="3"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
                                        <td width="95%"><img src="../images/spacer_trans.gif" width="10" height="20"></td>
                                      </tr>
                                      <tr> 
                                        <td><div align="center"><img src="../images/seperator_grey_line.gif" width="100%" height="1"></div></td>
                                      </tr>
                                      <tr> 
                                        <td><img src="../images/spacer_trans.gif" width="10" height="20"></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <? }
$getFreeGift = false; // removed at identikids request 28.01.2005

							if($totalprice>=$cur['freeGift']  && $getFreeGift){ ?>
                                <tr> 
                                  <td>&nbsp;</td>
                                  <td width="36%"><img src="../images/image_gift_box.gif" width="140" height="149"></td>
                                  <td width="2%"><img src="../images/spacer_trans.gif" width="20" height="10"></td>
                                  <td colspan="3" valign="top"><strong>FREE GIFT<br>
                                    <br>
                                    Congratulations!</strong> Your order is over 
                                    <? echo $cur['symbol'].$cur['freeGift'];?> 
                                    which means you qualify for a <strong>free 
                                    gift package!</strong></td>
                                </tr>
                                <tr> 
                                  <td height="10" colspan="6"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="5%" rowspan="3"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
                                        <td width="95%"><img src="../images/spacer_trans.gif" width="10" height="20"></td>
                                      </tr>
                                      <tr> 
                                        <td><div align="center"><img src="../images/seperator_grey_line.gif" width="100%" height="1"></div></td>
                                      </tr>
                                      <tr> 
                                        <td><img src="../images/spacer_trans.gif" width="10" height="20"></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <? } 
							 
							if($id!=false && $itemnums!=0){ ?>
                                <tr> 
                                  <td width="6%"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
                                  <td colspan="3"><strong>Order Subtotal 
                                    (<? echo $cur['symbol'];?>) :</strong></td>
                                  <td width="3%"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                                  <td width="18%"> <div align="right"><strong><? echo $cur['symbol'].toDollarsAndCents($totalprice);?><img src="../images/spacer_trans.gif" width="10" height="10"></strong></div></td>
                                </tr>
                                <tr> 
                                  <td colspan="6"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <?
								if($_COOKIE['currency']!=1)
								{
									$oseas=1;
								}
								
								if($oseas==1){
									$postage = $cur['postage'];
								}else{
									$postage = 0;
								}
								 ?>
                                <tr> 
                                  <td><img src="../images/spacer_trans.gif" width="25" height="10"></td>
                                  <td colspan="3"><strong>Postage &amp; Handling</strong><strong> 
                                    (<? echo $cur['symbol'];?>) :</strong></td>
                                  <td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                                  <td><div align="right"><strong><?
								  	if(isset($_SESSION["post_option"])&& $_SESSION["post_option"]!='Normal'){
											$sql = "SELECT expresspost FROM currencies WHERE id = 1";
											$result = mysql_query($sql)or die ("SQL ERROR");
											$row = mysql_fetch_assoc($result);
											$postage = $row["expresspost"]; 
									 	echo $cur['symbol'].toDollarsAndCents($postage)."<img src='images/spacer_trans.gif' width='10' height='10'></strong></div>";
									}
									else {
									    echo $cur['symbol'].toDollarsAndCents($cur['postage'])."<img src='images/spacer_trans.gif' width='10' height='10'></strong></div>";
									}
									?>
									</td>
                                </tr>
                                <tr> 
                                  <td colspan="6"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
								<tr> 
                                  <td colspan="6"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                
								<!-- express post option for Australia-->
							<? if($_COOKIE['currency']==1) {?>
								
							<!-- postage options -->	
								<tr> 
                                  <td><img src="../images/spacer_trans.gif" width="25" height="10"></td>
                                  <td colspan="5" bgcolor="FFD600" class="maintext">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
                                      <tr>
                                        <td valign="top"><strong> 
                                          <?PHP if (!isset($_SESSION["post_option"]) || $_GET["change_post"]=="change")
												  {	
												  	echo "Please select preferred postage option:";
												  }
												  else
												  {	
													echo "<font color='EF008C'>Postage option chosen: </font><font color='5D7EBC'>".$_SESSION["post_option"]."</font>";
													if($_SESSION["post_option"]!='Normal')
													{
														echo "<img src='./images/small_truck.gif'>";
													}
												  }
												  ?>
                                          </strong> </td>
                                      </tr>
                                      <tr> 
                                        <td valign="middle" align="right"> 
                                          <?PHP if (!isset($_SESSION["post_option"]) || $_GET["change_post"]=="change")
											  { // Display postage options
											  	echo" 
											<form method='post' name='selectpostage' action='select_postage.php'><select name='postage'>
                                            	<option value='Normal'>Normal - Dispatched 
                                            	within 5 working days Free delivery</option>
                                            	<option value='Australian Express'>Australian 
                                            	express - Dispatched within 
                                            	48 business business hours 9-5 Mon-Fri $7.50 fee</option>
                                            	<option value='Overseas Express'>Overseas 
                                            	Express envelope - 7-10 days from 
                                            	Australia $7.50 AUD</option>
                                          	</select><br><br>";
											?>										
											<a href="products_home.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image24','','images/button_buymore_mo.gif',1)"><img src="images/button_buymore.gif" alt="Buy/View more products" name="Image24" width="86" height="22" border="0"></a>&nbsp;&nbsp;
											<a href="javascript: document.forms['selectpostage'].submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image54','','../images/but_submit_over.gif',1)"><img src="../images/but_submit.gif" name="Image54" width="86" height="22" border="0"></a></form>
											<?	}
												else 
												{
													//echo "<strong>Postage option chosen: </strong>".$_SESSION["post_option"];
													echo "<a href='view_order.php?change_post=change'>Change postage option</a>";
												}
												?>
                                        </td>
                                      </tr>
                                    </table>
                                    
                                  </td>
                                </tr>
								<!-- postage options end-->
								<?PHP }?>
                                <tr> 
                                  <td colspan="6"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                                </tr>
                                <tr> 
                                  <td valign="middle"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
                                  <td height="30" colspan="3" valign="middle" background="../images/bg_grey.gif" bgcolor="#CCCCCC"> 
                                    <div align="right"><strong>TOTAL :</strong></div></td>
                                  <td height="30" background="../images/bg_grey.gif" bgcolor="#CCCCCC"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                                  <td height="30" background="../images/bg_grey.gif" bgcolor="#CCCCCC"> 
                                    <div align="right"><strong><?
									 echo $cur['symbol'].toDollarsAndCents($totalprice+$postage)?><img src="../images/spacer_trans.gif" width="10" height="10"></strong></div></td>
                                </tr>
                                <? }?>
                              </table></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td colspan="3"><!--&& (!isset($_SESSION["express_post"]) || $_SESSION["express_post"]==''))-->
							<? if($_COOKIE['currency']==1) {?>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="6%" rowspan="6" valign="top" class="maintext"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="94%" valign="top" class="maintext"><p>Notes:<br>
                                    </p>
                                    </td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext"><p>Postage 
                                      &amp; Handling is free within Australia.<br>
                                      All regular orders will be dispatched within 
                                      5 business days from date of payment received. 
                                      Business days M-F<br>
                                      <br>
                                      Overseas orders dispatched via Overseas 
                                      express envelope within 5 business days. 
                                      Transit time around 2 weeks<br>
                                    </p>
                                  </td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext"><!--For overseas 
                                    orders the P&amp;H is <? //echo $cur['postage'];?>--></td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext"><br>
                                    Express orders dispatched within 48 business 
                                    hours 9-5 Mon-Fri from NSW by Startrack express 
                                    service<br>
                                    (in transit 1-2 days with courier) from date 
                                    of payment received. Allow 3-4 days for delivery<br> <br>
                                    <br>
                                  </td>
                                </tr>
                                <tr>
                                  <td valign="top" class="maintext">Any order 
                                    not paid within 10 days will be destroyed. 
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
						  <? }else {?>
						  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="6%" rowspan="6" valign="top" class="maintext"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
                                  <td width="94%" valign="top" class="maintext">Notes:</td>
                                </tr>
                                <tr> 
                                  <td valign="top" class="maintext">Postage &amp; 
                                    Handling is <? echo $cur['symbol'].$cur['postage'];?></td>
                                </tr>
							</table>
						  <? }?>
                          <tr> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="../images/spacer_trans.gif" width="15" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>

                    <tr valign="top"> 
                      <td bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                          <tr> <!-- https://echidnaweb.com.au/~identiki/-->
                            <td width="44%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','../images/button_back_mo.gif',1)"><img src="../images/button_back.gif" alt="Back" name="back" width="94" height="22" border="0"></a></td>
                            <td width="4%"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
							<? if($id && $itemnums!=0 && $cur['minimumOrder']<$totalprice){?>
                            <td width="52%">
							<form name="toorderform" method="post" action="order_form_ps.php">
							<input type="hidden" name="orderid" value="<? echo $id;?>">
							<input type="hidden" name="postageamount" value="<? echo $postage;?>">
							</form>
							<a href="javascript: document.forms['toorderform'].submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image36','','../images/button_check_out_mo.gif',1)"><img src="../images/button_check_out.gif" alt="Check Out" name="Image36" width="94" height="22" border="0"></a></td>
							<? }?>
                          </tr>
                        </table></td>
						
                    </tr>
					
					  <? if($cur['minimumOrder']>$totalprice){?>
					  <tr>
						<td colspan="3">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr valign="top" bgcolor="#FFFFFF"> 
								  <td><img src="../images/spacer_trans.gif" width="1" height="10"></td>
								</tr>
								<tr> 
								  <td width="6%" rowspan="6" valign="top" class="maintext"><img src="../images/spacer_trans.gif" width="25" height="10"></td>
								  <td width="94%" valign="top" class="maintext"><strong>The minumum order that can be placed is for <? echo $cur['symbol'].$cur['minimumOrder']; ?></strong></td>
								</tr>
							</table>
						</td>
					  </tr>
					  <? } ?>
                    <tr> 
                      <td colspan="3" valign="top"><img src="../images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr bgcolor="#6FFF6F"> 
                      <td colspan="3" valign="top"><br> </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
          <td valign="top" bgcolor="FF9900"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="../images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
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
                        <?php
						include "orders.php"; ?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </td>
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
