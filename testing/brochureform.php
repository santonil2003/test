<!-- < ?
session_start();
if(!isset($_COOKIE["currency"])){
	header("location:index_map.php?returnurl=".$PHP_SELF);
	exit;
}
? > -->
<?PHP 

	$rand_number = rand(1, 4); 
	
	switch($rand_number) {
		case 1 : $header_num = '1'; $color="#FF9900";
		break;
		case 2 : $header_num = '2'; $color="#027ABB";
		break;
		case 3 : $header_num = '3'; $color="#33A02C";
		break;
		case 4 : $header_num = '4'; $color="#00A0C6";
		break;
	}
		 
	
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Identikid</title>
</head>
<script language="JavaScript" type="text/JavaScript">
<!--
function submitForm()
{
	msg="";
	if(document.onlineenquiry.name.value=="")
	{
		msg += "- Please enter your name\n";
	}
	if(document.onlineenquiry.address.value=="")
	{
		msg += "- Please enter your postal address\n";
	}
	if(document.onlineenquiry.email.value=="")
	{
		msg += "- Please enter your email address\n";
	}
	if(msg=="")
	{
		document.onlineenquiry.submit();
	}
	else {
		self.alert("The following errors were found:\n" + msg);
	}
}
//-->
</script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
<meta name="keywords" content="Label,labels,labelling,personalised,labels,name,identikid,identi,kid,sticker,stickers,vinyl,iron,iron-on,tag,shoes,pencil,pack,fabric,bag,child,kidcards,kid,cards,clothing,lost,property,school">
<meta name="description" content="Personalised name labels that really work.  Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more.  Design your own labels online, with your choice of fun fonts and pictures.  All products are high quality, attractive and easy to use.
"></head>
<script language="JavaScript">

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

</script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0" marginheight="0" marginwidth="0" background="images/bg/b_home.jpg">
<div align="center"><?PHP include("header".$header_num."_top.php"); ?>
</div>
<table border="0" cellspacing="0" cellpadding="0" width="726" align="center">
	<tr>		
	    <td> 
    		<table border="0" cellspacing="0" cellpadding="0" width="726" align="center">
        		<tr> 
			        <td width="726" valign="top">
						<table border="0" cellspacing="0" cellpadding="0" width="726" align="center">
            				<tr> 
				                <td background="images/bg/b_left.jpg"><img src="images/gen/spacer.gif" width="3" height="1" alt=""><br></td>
                				<td>
									<table border="0" cellspacing="0" cellpadding="0" width="720" align="center">
					                    <tr> 
                    						<?PHP  include("header".$header_num."_left.php");?>
						                    <td rowspan="5" width="378" bgcolor="#FFFFFF" valign="top"> 
											<img src="images/gen/spacer.gif" width="378" height="7" alt=""><br>
												<table border="0" cellspacing="0" cellpadding="0" width="378">
													<tr>
														<td width="8"><img src="images/gen/spacer.gif" width="8" height="1" alt=""><br></td>
														<td valign="top" width="362">
														<!-- content area -->
														<img src="images/heads/h_brochure_form.gif" width="362" height="57" alt=""><br>
														<img src="images/gen/spacer.gif" width="1" height="5" alt=""><br>	
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr> 
                      <td valign="top" bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="5" colspan="3"><img src="images/spacer_trans.gif" width="10" height="5"></td>
                          </tr>
                          <? if($_COOKIE["currency"]==1){ ?>
                          <tr> 
                            <td width="42" valign="top"> 
<div align="right"><img src="images/pic_brochure.gif" alt="Mail" width="30" height="50"></div></td>
                            <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="375" valign="top"><form name="onlineenquiry" method="post" action="http://www.echidnaweb.com.au/cgi-sys/FormMail-clone.cgi">
<h1><span class="headings">Please mail me a brochure</span></h1>
                                <table width="341" border="0" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="117" class="maintext" > <p><strong>Your 
                                        Name*</strong></p></td>
                                    <td width="224" height="30"> <input type="text" name="name" class="formText" maxlength="30" size="30"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="17" valign="top" class="maintext"> 
                                      <p><strong><br>
                                        Your Postal Address*</strong></p></td>
                                    <td height="110"> <textarea name="address" class="formText"rows="6" cols="25"></textarea> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="maintext"> <p><strong>Your Email*</strong></p></td>
                                    <td height="30"> <input type="text" name="email" class="formText"maxlength="30" size="30"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="maintext"> <p><strong>Your Phone</strong></p></td>
                                    <td height="30"> <input type="text" name="phone" class="formText"maxlength="30" size="15"></td>
                                  </tr>
                                  <tr> 
                                    <td class="maintext">&nbsp;</td>
                                    <td><p><span class="smallerText">* Required</span></p>
                                      <table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td width="44%" valign="top"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Go back to previous page" name="back" width="94" height="22" border="0"></a></td>
                                          <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                          <td width="52%" valign="top"><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('send','','images/button_send_mo.gif',1)"> 
                                            <input name="Submit" type="image" id="Submit" src="images/button_send.gif" width="86" height="22" border="0"  onClick="submitForm(); return false;">
                                            </a> <input type="hidden" name="redirect" value="http://www.identikid.com.au/thankyou.php"> 
                                            <input type="hidden" name="recipient" value="info@identikid.com.au"> 
                                            <input type="hidden" name="subject" value="Brochure Request from website"> 
                                            <input type="hidden" name="required" value="name,address,email"> 
                                            <input type="hidden" name="title" value="Thank You"> 
                                          </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                              </form></td>
                          </tr>
                          <? } ?>
                        </table>
                        
                      </td>
                    </tr>
                    <tr bgcolor="#6FFF6F"> 
                      <td valign="top"><br> </td>
                    </tr>
                  </table>
                										<!-- end content-->
														<br><br>
														</td>
														<td width="8"><img src="images/gen/spacer.gif" width="8" height="1" alt=""><br></td>
													</tr>
												</table>
                    						</td>
						                    <td valign="top" width="29" background="<?PHP  include("header".$header_num."_right.php");?>"><?PHP  include("header".$header_num."_right2.php");?><br></td>
                      						<td rowspan="5" width="184" valign="top" align="right" bgcolor="<?PHP echo $color;?>"> 
						                        <table border="0" cellspacing="0" cellpadding="0" width="160" bgcolor="#F0037F">
                        							<tr> 
							                            <td align="center">
														<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="141" HEIGHT="375" id="navigation_03" ALIGN="">
						                                <PARAM NAME=movie VALUE="flash/navigation.swf">
                        								<PARAM NAME=quality VALUE=high>
						                                <PARAM NAME=bgcolor VALUE=#EE0280>
                        						        <EMBED src="flash/navigation.swf" quality=high bgcolor=#EE0280  WIDTH="141" HEIGHT="375" NAME="navigation_03" ALIGN=""
														TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED> 
							                            </OBJECT> <br> <br> 
														</td>
							                        </tr>
						                        </table>
                        						<img src="images/gen/spacer.gif" width="1" height="19" alt=""><br>	
						                        <!-- Yellow Advertising Area -->
                        						<table border="0" cellspacing="0" cellpadding="0" width="160" bgcolor="#F8E616">
						    	                    <tr> 
                        	    						<td width="1"><img src="images/gen/spacer.gif" width="1" height="250" alt=""></td>
														<td width="159" valign="top">
														<?php
														include "orders.php"; 
														?>
														<td>
							                        </tr>
						                        </table>
											</td>
					                    </tr>
										<?PHP  include("header".$header_num."_left2.php");?>
                  					</table>
								</td>
				                <td background="images/bg/b_right.jpg"><img src="images/gen/spacer.gif" width="3" height="1" alt=""><br></td>
            				</tr>
			            </table>
					</td>
		        </tr>
			</table>					
    	</td>
	</tr>
</table>
<?PHP  include("header".$header_num."_footer.php");?>

</body>
</html>
