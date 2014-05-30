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
														<img src="images/heads/h_contact_us.gif" width="362" height="57" alt=""><br>
														<img src="images/gen/spacer.gif" width="1" height="5" alt=""><br>								
															<table width="90%" border="0" cellspacing="0" cellpadding="0">
							                                	<tr> 
							                                  		<td width="165" valign="top"> <div class="maintext"><strong> 
							        	                            NSW OFFICE</strong></div></td>
							            		                    <td width="18" rowspan="4" valign="top"><img src="images/gen/spacer.gif" width="10" height="10"></td>
							                    		            <td width="141" valign="top"> <div class="maintext"><strong> 
							                            	        WA OFFICE</strong></div></td>
							                                	</tr>
								                                <tr> 
							    		                            <td valign="top"><strong><img src="images/gen/spacer.gif" width="10" height="10"></strong></td>
							            		                    <td valign="top"><strong><img src="images/gen/spacer.gif" width="10" height="10"></strong></td>
							                    		        </tr>
							                            		<tr> 
							                                  		<td valign="top" class="smalltext">PO Box 8775</td>
									                                <td valign="top" class="smalltext"> PO Box 10 
							        		                        </td>
							                	                </tr>
							                    	            <tr> 
							                        		        <td valign="top" class="smalltext"> WAGGA WAGGA 
							                                		NSW 2650</td>
									                                <td valign="top" class="smalltext"> Scarborough 
							        		                        WA 6922</td>
							                		            </tr>
							                                	<tr> 
									                                <td valign="top" class="smalltext">Australia</td>
							        		                        <td valign="top">&nbsp;</td>
							                		                <td valign="top" class="smalltext">Australia</td>
							                        		    </tr>
						                              		</table>
															<br><br>
															<table border="0" cellspacing="0" cellpadding="0" width="90%">
											                    <tr> 
						                    				        <td> <div align="center"><img src="images/pic_phone_transp_bg.gif" alt="Phone" width="30" height="20"></div></td>
										                            <td>&nbsp;</td>
						                				            <td>
																		<table width="100%" border="0" cellspacing="0" cellpadding="0">
											                                <tr> 
						        						                        <td colspan="2" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"><strong>Phone</strong>&nbsp;</td>
						                                						<td width="85%" class="smalltext"> 
											                                    <? if($_COOKIE["currency"]==1){ ?>
						                    					                1300 133 949 &nbsp;
											                                    <? }else{?>
						                    						            +61 2 6971 0969 
												                                <? }?>
						                        						        </td>
											                                </tr>
						                    					        </table>
																	</td>
										                        </tr>
						                				        <tr> 
										                            <td>&nbsp;</td>
						                				            <td>&nbsp;</td>
										                        </tr>
						                				        <tr> 
										                            <td> <div align="center"><img src="images/pic_fax_transp_bg.gif" alt="Fax" width="30" height="28"></div></td>
						                				            <td>&nbsp;</td>
										                            <td>
																		<table width="100%" border="0" cellspacing="0" cellpadding="0">
											                                <tr> 
						                    						            <td colspan="2" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"><strong>Fax</strong> &nbsp;
												                                </td>	
						                        						        <td width="85%" class="smalltext"> 
											                                    <? if($_COOKIE["currency"]==1){ ?>
						                    					                1300 551 578 &nbsp;
											                                    <? }else{?>
						                    					                +61 2 6971 0492 
											                                    <? }?>
						                    						            </td>
											                                </tr>
						                    					        </table>
																	</td>
										                        </tr>
						                				        <tr> 
										                            <td>&nbsp;</td>
						                				            <td>&nbsp;</td>
										                        </tr>
						                				        <tr> 
										                            <td valign="top"> <div align="center"><img src="images/pic_email_transp_bg.gif" alt="Email" width="32" height="28"></div></td>
						                				            <td>&nbsp;</td>
										                            <td>
																		<table width="100%" border="0" cellspacing="0" cellpadding="0">
											                                <tr> 
						                    						            <td width="16%" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"><strong>Email</strong>&nbsp;</td>
												                                <td width="84%" class="smalltext"><a href="mailto:info@identikid.com.au" class="type1">info@identikid.com.au</a></td>
						                        					        </tr>
											                                <tr> 
						                    						            <td>&nbsp;</td>
												                                <td class="smalltext"><a href="mailto:orders@identikid.com.au" class="type1">orders@identikid.com.au</a></td>
						                        					        </tr>
												                            <tr> 
						                        						        <td>&nbsp;</td>
												                                <td class="smalltext"><a href="mailto:sales@identikid.com.au" class="type1">sales@identikid.com.au</a></td>
											                                </tr>
						                    					        </table>
																	</td>
										                        </tr>
						                				        <tr> 
										                            <td colspan="3"><img src="images/gen/spacer.gif" width="15" height="15"></td>
						                				        </tr>
										                        <tr> 
						                				            <td colspan="3"><img src="images/seperator_black_line.gif" width="100%" height="1"></td>
										                        </tr>
						                				        <tr> 
										                            <td valign="top"> <div align="center"><img src="images/gen/spacer.gif" width="10" height="15"><br>
						                				            <img src="images/pic_brochure.gif" alt="Brochure" width="30" height="50"></div></td>
										                            <td>&nbsp;</td>
						                				            <td>
																		<table width="100%" border="0" cellspacing="0" cellpadding="0">
																			<tr> 
												                                <td width="26%" class="smalltext">&nbsp;</td>
						                        						        <td width="74%" class="smalltext">&nbsp;</td>
											                                </tr>
						                    					            <tr class="smalltext"> 
																				<td colspan="2"> 
																				<p><span class="maintext"><strong><img src="images/gen/spacer.gif" width="10" height="10">Would 
											                                    you like a brochure?</strong></span><br>
						                    						            <br>
											                                    </p></td>
																			</tr>
											                                <tr valign="top" class="smalltext"> 
																				<td><strong><img src="images/gen/spacer.gif" width="10" height="10">Option 
												                                1:</strong></td>
						                        					            <td><a href="pdf/order form.pdf" target="_blank" class="type1">Click 
												                                here</a> for printable brochure.</td>
						                        					        </tr>
											                                <tr valign="top" class="smalltext"> 
																				<td><strong><img src="images/gen/spacer.gif" width="10" height="10">Option 
													                            2:</strong></td>
						                            							<td><a href="brochureform.php" class="type1">Click 
											                                    here</a> to have a brochure mailed to you.</td>
						                    					            </tr>
											                            </table>
																	</td>
										                        </tr>
						                				        <tr> 
						                            				<td colspan="3">&nbsp;</td>
										                        </tr>
						                				        <tr> 
						                            				<td colspan="3"><img src="images/seperator_black_line.gif" width="100%" height="1"></td>
										                        </tr>
						                				        <tr> 
										                            <td colspan="3"><img src="images/gen/spacer.gif" width="10" height="15"></td>
						                				        </tr>
						                          				<tr> 
						                            				<td colspan="3"><img src="images/gen/spacer.gif" width="10" height="15"></td>
						                          				</tr>
						                          				<tr> 
						                            				<td>&nbsp;</td>
										                            <td>&nbsp;</td>
						                				            <td>
																		<table width="100%" border="0" cellspacing="0" cellpadding="0">
											                                <tr valign="top"> 
						                    						            <td width="7%"><strong><img src="images/gen/spacer.gif" width="10" height="10"></strong></td>
						                                  						<td width="92%" class="smalltext">Website Design 
											                                    By </td>
						                    					            </tr>
											                                <tr valign="top"> 
						                    						            <td colspan="2"><img src="images/gen/spacer.gif" width="10" height="10"></td>
						                                					</tr>
						                                					<tr valign="top"> 
						                                  						<td>&nbsp;</td>
						                                  						<td class="smalltext"><a href="http://www.echidnaweb.com.au" target="_blank" class="type1">Echidna 
						                                    					Web Design</a></td>
						                                					</tr>
											                                <tr valign="top"> 
						                    						            <td colspan="2"><img src="images/gen/spacer.gif" width="10" height="10"></td>
											                                </tr>
						                    					            <tr valign="top"> 
												                                <td>&nbsp;</td>
						                        						        <td class="smalltext"><a href="http://www.echidnaweb.com.au" target="_blank"><img src="images/logo_echidna_long.gif" alt="Visit Echidna Web Design" width="187" height="27" border="0"></a></td>
											                                </tr>
						                    					        </table>
										                             <p>&nbsp;</p>
						                				              <p></p>
																	</td>
																</tr>
									                        </table>
															<table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
										                        <tr> 
						                				            <td width="44%">&nbsp;</td>
										                            <td width="4%"><img src="images/gen/spacer.gif" width="10" height="10"></td>
						                				            <td width="52%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/nav/n_back_x.gif',1)"><img src="images/nav/n_back_o.gif" alt="Go back to previous page" name="back" id="back" width="115" height="35" border="0"></a></td>
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