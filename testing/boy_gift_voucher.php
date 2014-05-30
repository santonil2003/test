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
<script language="JavaScript" type="text/JavaScript">
<!--


function submitForm(){
	if(document.forms[0].quantdesc[0].selected==true){
		document.forms[0].price.value=3;
	}else if(document.forms[0].quantdesc[1].selected==true){
		document.forms[0].price.value=6;
	}if(document.forms[0].quantdesc[2].selected==true){
		document.forms[0].price.value=9;
	}
	document.forms[0].submit();
}
//-->
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
														<img src="images/heads/h_our_products.gif" width="362" height="57" alt=""><br>
														<img src="images/heads/sh_special_boy_vouchers.gif" alt="" width="362" height="34" border="0"><br>
														<img src="images/gen/spacer.gif" width="1" height="12" alt=""><br>	
															<table width="362" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">                    											
																<tr>
												                   <td width="255" bgcolor="#FFFFFF" class="maintext"> 
																   <form name="addorder" method="POST" action="addtoorder.php">
																	<input type="hidden" name="type" value="15">
																	<input type="hidden" name="quantdesc" value="<?=$price['unitQuant']." Special Boy voucher for ".$price['symbol'];?>">
																	<script>
																	function checkVoucherValue()
																	{
																
																	if(isNaN(document.addorder.price.value) || document.addorder.price.value<=0)
																	{	
																	self.alert('Please enter a valid number into the Voucher Value');
																	}
																	else {
																	document.addorder.price.value = twoDecimals(document.addorder.price.value);
																	document.addorder.quantdesc.value = document.addorder.quantdesc.value + document.addorder.price.value + " ea";
																	document.addorder.submit();
																	
																		}
																	
																	}

																	function twoDecimals(string){			

																		var bits = string.split(".");									
																		if(bits.length>1){
																		if(bits[1].length==0){
																		string = string + "00";
																	}
																	else if(bits[1].length==1){
																	string = string + "0";
																	}
																	else if(bits[1].length>2){
																	string = bits[0] + "." + bits[1].substr(0,2);
																	}
																	}
																	else {
																	string = string + ".00";
																	}
																	return string;

																	}					
																	</script>
																   </td>                    
																</tr>
															</table>
															<br>
														    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          										<tr bgcolor="#FFFFFF"> 
										                            <td width="176" valign="top" class="smalltext"><div align="left">
																	Please enter voucher value </div></td>
										                            <td width="98" valign="top" class="smalltext"><strong>$</strong><input name="price" type="text" value="0.00" size="10"> 
										                            <img src="images/spacer_trans.gif" width="10" height="10"></td>
										                            <td width="124" valign="top" class="smalltext"><div align="right"><a href="#" onClick="checkVoucherValue();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('add_order','','images/nav/n_add_to_order_1_x.gif',1)"><img src="images/nav/n_add_to_order_1_o.gif" alt="Add to Order" name="add_order" id="add_order" width="158" height="42" border="0"></a></div></td>
										                        </tr>
																</form>
										                        <tr valign="top"> 
										                        <form name="giftbox" action="addtoorder.php" method="post">
										                        	<td colspan="3" bgcolor="#FFFFFF">
	                                    							<img src="images/boy_outside.gif" alt="Special Boy Voucher" width="362" height="266" border="0"> 
																	<p><img src="images/boy_inside.gif" alt="Special Boy Voucher" width="362" height="266" border="0"> 
								                                    </p></td>
																</tr>																												
									                            </form>
															</table>
													        <br><br>
															<hr width="100%" size=1>
															<p><img src="images/heads/h_other_products.gif" width="362" height="57" alt=""><br>
												            <?PHP
																				require_once("./products_include.php");
																				?></p>
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
