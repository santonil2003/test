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
<link href="css/style.css" rel="stylesheet" type="text/css">
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0" marginheight="0" marginwidth="0" background="images/bg/b_home.jpg">
<div align="center"><?PHP include("header".$header_num."_top.php"); ?>
</div>
<table border="0" cellspacing="0" cellpadding="0" width="726" align="center">
	<tr>		
	    <td> 
    		<table border="0" cellspacing="0" cellpadding="0" width="720" align="center">
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
                        					
															<img src="images/heads/h_enquiry_form.gif" alt="" width="362" height="57" border="0"><br>
															<img src="images/gen/spacer.gif" width="1" height="5" alt=""><br>	
								<p><strong>identiKid</strong> can create custom built labels to suit your needs.</p>
								<p>Please fill in the form below being as specific as possible, and we'll get back to you with a quote within 2 - 4 working days.</p>
								<p>Leave fields blank if they are not relevant.</p>							
								<form id="enquiry_form">
									<p><label for="name">Name</label>
										<input type="text" name="name" /></p>
									<p><label for="email">Email</label>
										<input type="text" name="email" /></p>
									<p><label for="phone">Phone</label>
										<input type="text" name="phone" /></p>
									<p><label for="country">Country</label>
										<input type="text" name="country" value="Australia" /></p>
									<p><label for="label_shape">Shape of Label<br /><span>i.e: Rectangle, Rounded Rectangle, Circle, Star etc.</span></label>
										<input type="text" name="label_shape" /></p>
									<p><label for="size">Approximate Size</label>
										<input type="text" name="size" /></p>
									<p><label for="material_type">Type of Material<br /><span>i.e: Vinyl, Cloth, Magnetic etc.</span></label>
										<input type="text" name="material_type" /></p>
									<p><label for="colours">Colours</label>
										<input type="text" name="colours" /></p>
									<p><label for="font">Font</label>
										<input type="text" name="font" /></p>
									<p><label for="quantity">Quantity Needed</label>
										<input type="text" name="quantity" /></p>
									<p><label class="textarea" for="comments">Additional Comments / Special Requirements</label>
										<textarea rows="6" cols="40" wrap="hard" name="comments"></textarea></p>
									<p><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('enquire','','images/nav/n_enquire_1_x.gif',1)" onClick="submitForm();"><img src="images/nav/n_enquire_1_o.gif" alt="Enquire" name="enquire" id="enquire" width="113" height="42" border="0"></a>
										<a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('reset','','images/nav/n_reset_1_x.gif',1)" onClick="resetForm();"><img src="images/nav/n_reset_1_o.gif" alt="Reset Form" name="reset" id="reset" width="111" height="42" border="0"></a></p>
								</form>
								<p><br>
								<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
			                        <tr> 
            			                <td align="right"><br><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/nav/n_back_1_x.gif',1)"><img src="images/nav/n_back_1_o.gif" alt="Go back to the previous page" name="back" id="back" width="111" height="42" border="0"></a></td>
	          			            </tr>
		                        </table>
														<!-- end content-->
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
