<script language="JavaScript" type="text/JavaScript">
<!--

$(document).ready(function() { 

  $('#form1').ajaxForm({beforeSubmit: validateForm, success: updateForm1 } );  
  
  $('#form2').ajaxForm({beforeSubmit: validateForm2, success: updateForm2 } ); 
  
  $('#form3').ajaxForm({beforeSubmit: validateForm3, success: updateForm3 } ); 
  
}); 

function validateForm(){
	if(document.form1.quart_ok.checked==false){
		alert('You must agree that payments are made quarterly');
		return false;
	}else if(document.form1.groupname.value==""){
		alert('Please enter a group name');
		return false;
	}else if(document.form1.contact.value==""){
		alert('Please enter a contact name');
		return false;
	}else if(document.form1.phonenum.value==""){
		alert('Please enter a phone number');
		return false;
	}else if(document.form1.emailadd.value==""){
		alert('Please enter a email address');
		return false;
	}else if(document.form1.cheque_in_name_of.value==""){
		alert('Please enter the cheque recipient');
		return false;
	}else if(document.form1.postadd.value==""){
		alert('Please enter a postal address');
		return false;
	}else if(document.form1.deladd.value==""){
		alert('Please enter a delivery address');
		return false;
	}else{
		return true;
	}
}

function validateForm2(){
	if(document.form2.sample_pack.checked==false){
		alert('You must select the option to send you a fundraiser pack');
		return false;
	}else if(document.form2.name.value==""){
		alert('Please enter a name');
		return false;
	}else if(document.form2.phonenum.value==""){
		alert('Please enter a phone number');
		return false;
	}else if(document.form2.emailadd.value==""){
		alert('Please enter a email address');
		return false;
	}else if(document.form2.postadd.value==""){
		alert('Please enter a postal address');
		return false;
	}else{
		return true;
	}
}

function validateForm3(){
  if(document.form3.groupname.value==""){
		alert('Please enter a group name');
		return false;
	}else if(document.form3.contact.value==""){
		alert('Please enter a contact name');
		return false;
	}else if(document.form3.phonenum.value==""){
		alert('Please enter a phone number');
		return false;
	}else if(document.form3.emailadd.value==""){
		alert('Please enter a email address');
		return false;
	}else if(document.form3.deladd.value==""){
		alert('Please enter a delivery address');
		return false;
	}else if(document.form3.funcode.value==""){
		alert('Please enter your fundraiser code');
		return false;
	}else{
		return true;
	}
}

function updateForm1() {
  //$("#form1Div").css("height", $("#form1Div").height());
  $("#form1Div").fadeOut("fast", 
    function() {
      $("#form1Div").html("<table height='100%' width='100%'><tr><td valign='middle' align='center'><b><p>Thank You</p><p>Your Fundraiser Registration Form has been received. </p></b></td></tr></table>");
      $("#form1Div").fadeIn("fast");
    }
  );
}

function updateForm2() {
  //$("#form2Div").css("height", $("#form2Div").height());
  $("#form2Div").fadeOut("fast", 
    function() {
      $("#form2Div").html("<table height='100%' width='100%'><tr><td valign='middle' align='center'><b><p>Thank You</p><p>You will receive your fundraising kit in the next few days.</p></b></td></tr></table>");
      $("#form2Div").fadeIn("fast");
    }
  );
}

function updateForm3() {
  //$("#form3Div").css("height", $("#form3Div").height());
  $("#form3Div").fadeOut("fast", 
    function() {
      $("#form3Div").html("<table height='100%' width='100%'><tr><td valign='middle' align='center'><b><p>Thank You</p><p>You will receive your fundraising supplies in the next few days.</p></b></td></tr></table>");
      $("#form3Div").fadeIn("fast");
    }
  );
}

function disableAbn(){
	if(document.form1.haveabnnum[0].checked==true){
		document.form1.abnnum.disabled=false;
	}else{
		document.form1.abnnum.disabled=true;
	}
}
//-->
</script>

<table border="0" cellspacing="0" cellpadding="0" width="890">

				<tr>
					<td>
					<?php include("_user_pages/fundraisers_intro.php"); ?>
                    <font color="#CCCCCC">______________________________________________________________________</font>
  					<p><strong>If you'd like a Fundraiser Information, Please complete this section...</strong></p>
  				   <div id="form2Div">
                  <form id="form2" name="form2" method="post"  action="submitfundraising.php" onSubmit="return false;">
				  <input type="hidden" name="form_name" value="sample_pack">
						<table width="400" border="0" cellpadding="5" cellspacing="0">

							<tr> 
		                    	<td colspan="2"><strong>Fundraiser Info</strong></td>
							</tr>
							<tr> 
		                    	<td height="0" colspan="2"><img src="images/gen/spacer.gif" width="20" height="10"></td>
							</tr>
		                    <tr> 
								<td colspan="2"><input type="checkbox" name="sample_pack" value="1"> Yes, please send me the Fundraiser Info.</td>
							</tr>

							<tr> 
								<td height="0" colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
							</tr>
							<tr> 
								<td width="48%">Name</td>
								<td width="52%"><input name="name" type="text" size="30"></td>
							</tr>
							<tr> 
								<td height="0" colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
							</tr>

							<tr> 
								<td>Phone Number</td>
								<td><input name="phonenum" type="text" class="ordertext" id="phone" size="30"></td>
							</tr>
							<tr> 
								<td height="0" colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
							</tr>
							<tr> 
								<td>Email Address</td>

								<td><input name="emailadd" type="text" class="ordertext" size="30"></td>
							</tr>
							<tr> 
								<td height="0" colspan="2" valign="top"><img src="images/gen/spacer.gif" width="20" height="2"></td>
							</tr>
							<tr> 
								<td valign="top">Postal Address<br> <font size="1">(Please include your postcode)</font></td>
								<td><textarea name="postadd" cols="20" rows="5"></textarea></td>

							</tr>
							<tr> 
								<td>&nbsp;</td>
								<td><input type="image" value="submit" src="images/nav/n_submit.gif" name="Image36" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image36','','images/button_send_mo.gif',1)"></td>
							</tr>
						</table>
		                </form>
		             </div>
		                <p><font color="#CCCCCC">______________________________________________________________________</font>
						<p>To commence your identikid fundraiser just fill in the registration form below or call us on 1300 133 949 and ask for our info pack. Its that easy.
						<p>If you are wanting to re-order supplies of just brochures/posters and samples fill details down further.
						<p>

						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                			<tr>
		                    	<td>
		                    	<div id="form1Div" >
								<form id="form1" name="form1" method="post" action="submitfundraising.php" onSubmit="return false;">
								<input type=hidden name=form_name value="fundraiser_registration">
	                    		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    	                        		<tr> 
		        	                        <td><strong>Fundraiser Registration Form</strong></td>
        		                        </tr>

                		                <tr> 
                        		            <td><img src="images/gen/spacer.gif" width="20" height="10"></td>
                                		</tr>
		                                <tr> 
        		    	                    <td>
												<table style="width: 700px;" border="0" cellpadding="5" cellspacing="0">
													<tr> 
														<td style="width:200px;">Name of<br />Fundraiser Group</td>
														<td><input name="groupname" type="text" class="ordertext" size="30" style="width:500px;"></td>
													</tr>

													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td>Contact Person</td>
														<td><input name="contact" type="text" class="ordertext" size="30" style="width:500px;"></td>
													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>

													<tr> 
														<td height="24">Phone Number</td>
														<td><input name="phonenum" type="text" class="ordertext" size="25"></td>
													</tr>
													<tr> 
														<td height="24">Fax Number</td>
														<td><input name="faxnum" type="text" class="ordertext" size="25"></td>
													</tr>
													<tr> 
														<td height="24">Mobile Number</td>
														<td><input name="mobilenum" type="text" class="ordertext" size="25"></td>
													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>

													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td>Email Address</td>

														<td><input name="emailadd" type="text" class="ordertext" size="30" style="width: 500px;"></td>
													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td>Cheque in Name of</td>

														<td><input name="cheque_in_name_of" type="text" class="ordertext" size="30" style="width: 500px;"></td>
													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td valign="top">Postal Address<br><font size="1">(Please include your postcode)</font></td>
														<td><textarea name="postadd" cols="20" rows="5"  style="width: 500px;"></textarea></td>

													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td valign="top">Delivery Address<br><font size="1">(Our courier can not deliver to PO BOX addresses, please provide a full street address)</font></td>
														<td><textarea name="deladd" cols="20" rows="5" style="width: 500px;"></textarea></td>
													</tr>

													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td valign="top">Fundraising Type</td>
														<td><input type="radio" value="labels" name="fundraisingtype" checked>&nbsp;Labels&nbsp;&nbsp;&nbsp;<input type="radio" value="bag" name="fundraisingtype">&nbsp;Bag Fundraiser&nbsp;&nbsp;&nbsp;<input type="radio" value="other" name="fundraisingtype">&nbsp;Other <span style="font-size: 10px;">(Add to Special Info Below)</span></td>
													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>

													</tr>
													<!-- <tr> 
														<td>Do you require a display stand?</td>
														<td>
														<select name="displaystand" class="ordertext" id="displaystand">
														<option value="Yes">Yes</option>
														<option value="No" selected>No</option>
														</select>

														</td>
													</tr> -->
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td>Number of brochures required?</td>
														<td><input name="brochnumbers" type="text" class="ordertext" size="10"></td>
													</tr>

													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td>Do you have an ABN number?</td>
														<td>
														<input name="haveabnnum" type="radio" class="ordertext" value="yes" checked onClick="disableAbn();">
														&nbsp;Yes&nbsp;&nbsp;
														<input name="haveabnnum" type="radio" class="ordertext" value="no" onClick="disableAbn();">

														&nbsp;No&nbsp;&nbsp;
														</td>
													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td>ABN (if applicable)</td>
														<td><input name="abnnum" type="text" class="ordertext" size="25"></td>

													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
														</tr>
													<tr> 
														<td>Registered for GST?</td>
														<td>
														<select name="gst" class="ordertext">
														<option value="Yes">Yes</option>

														<option value="No">No</option>
														</select>
														</td>
													</tr>
													<tr>
														<td colspan="2" valign="middle"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td>Special Requirements</td>

														<td>&nbsp;</td>
													</tr>
													<tr> 
														<td colspan="2"><div align="center"> 
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr> 
																	<td width="99%"> <div align="left"> 
																	<textarea name="requirements" cols="35" rows="5" style="width: 700px;"></textarea>
																	</div></td>
																	<td width="1%">&nbsp;</td>

																</tr>
															</table>
														</div>
														</td>
													</tr>
													<tr> 
														<td colspan="2">&nbsp;</td>
													</tr>
													<tr> 
														<td colspan="2" valign="middle"><input type="checkbox" name="quart_ok">&nbsp;I acknowledge that payments are made quarterly throughout the year and am happy for payment to be made at these times. I understand if I do not achieve a minimum of $20 the fundraiser commission will not sent. I Also understand that identikid only offers ONLINE fundraising as an option for its fundraisers and customers.</td>
													</tr>
                                        		    <tr> 
                                            			<td colspan="2" valign="middle"><img src="images/gen/spacer.gif" width="20" height="2"></td>
		                                            </tr>
        		                                    <tr> 
	            		                                <td colspan="2">
														<input type="image" value="submit" src="images/nav/n_submit.gif" name="Image37" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image37','','images/button_send_mo.gif',1)">
														<p>
														</td>
                                		            </tr>
	                                            </table>

											</td>
										</tr>
									</table>
                                </form>
</div>
								
								<p>
								<p><font color="#CCCCCC">______________________________________________________________________</font>
							<div id="form3Div">
								<form id="form3" name="form3" method="post" action="submitfundraising.php" onSubmit="return false;">
								<input type=hidden name=form_name value="fundraiser_supplies">
	                    		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    	                        		<tr> 
		        	                        <td><strong>Fundraiser Supplies Request/Update your fundraising info</strong></td>

        		                        </tr>
                		                <tr> 
                        		            <td><img src="images/gen/spacer.gif" width="20" height="10"></td>
                                		</tr>
		                                <tr> 
        		    	                    <td>
												<table width="500" border="0" cellpadding="5" cellspacing="0">
													<tr> 
														<td width="49%">Name of Fundraiser Group</td>
														<td width="51%"><input name="groupname" type="text" class="ordertext" size="30"></td>

													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td>Contact Person</td>
														<td><input name="contact" type="text" class="ordertext" size="30"></td>
													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>

													</tr>
													<tr> 
														<td height="24">Phone Number</td>
														<td><input name="phonenum" type="text" class="ordertext" size="25"></td>
													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td>Email Address</td>

														<td><input name="emailadd" type="text" class="ordertext" size="30"></td>
													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td valign="top">Delivery Address<br><font size="1">(Our courier can not deliver to PO BOX addresses, please provide a full street address)</font></td>
														<td><textarea name="deladd" cols="20" rows="5"></textarea></td>

													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td valign="top">Fundraiser Code</td>
														<td><input name="funcode" type="text" class="ordertext" size="30"></td>
													</tr>
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>

													</tr>
													<!-- <tr> 
														<td>Do you require a display stand?</td>
														<td>
														<select name="displaystand" class="ordertext" id="displaystand">
														<option value="Yes">Yes</option>
														<option value="No" selected>No</option>
														</select>

														</td>
													</tr> -->
													<tr> 
														<td colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
													</tr>
													<tr> 
														<td>Number of brochures required?</td>
														<td><input name="brochnumbers" type="text" class="ordertext" size="10"></td>
													</tr>
													<tr> 
														<td>Special Requirements</td>
														<td>&nbsp;</td>
													</tr>
													<tr> 
														<td colspan="2"><div align="center"> 
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr> 
																	<td width="99%"> <div align="left"> 
																	<textarea name="requirements" cols="35" rows="5"></textarea>

																	</div></td>
																	<td width="1%">&nbsp;</td>
																</tr>
															</table>
														</div>
														</td>
													</tr>
													<tr>
                                            			<td colspan="2" valign="middle"><img src="images/gen/spacer.gif" width="20" height="2"></td>

		                                            </tr>
        		                                    <tr> 
	            		                                <td colspan="2">
														<input type="image" value="submit" src="images/nav/n_submit.gif" name="Image37" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image37','','images/button_send_mo.gif',1)">
														</td>
                                		            </tr>
	                                            </table>
											</td>
										</tr>

									</table>
                                </form>	
                                </div>							
								</td>
							</tr>
						</table>	
						
								<p><font color="#CCCCCC">______________________________________________________________________</font>
					<?php include("_user_pages/fundraisers_footer.php"); ?>
						
					</td>
				</tr>
			</table>
