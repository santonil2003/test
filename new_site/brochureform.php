<?PHP include("header.php"); ?>
			<table border="0" cellspacing="0" cellpadding="0" width="898">
				<tr>
					<td width="398"><img src="images/bread/h_brochureform.gif" alt="identi Kid Please Mail Me a Brochure" name="contact_us" id="contact_us" width="398" height="39" border="0"></td>		
					<td align="right"><a href="" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('view_order','','images/bread/n_view_order_x.gif',1);"><img src="images/bread/n_view_order_o.gif" alt="identi Kid Products - View My Order" name="view_order" id="view_order" width="151" height="43" border="0"></td>			
				</tr>
			</table>		
			<img src="images/gen/spacer.gif" width="1" height="10" alt=""><br>
			<table border="0" cellspacing="0" cellpadding="0" width="890">
				<tr>
					<td>
					<form name="onlineenquiry" method="post" action="http://www.echidnaweb.com.au/cgi-sys/FormMail-clone.cgi">
						<table width="341" border="0" cellpadding="0" cellspacing="0">
	                        <tr> 
    	                        <td width="117"><strong>Your Name*</strong></td>
								<td width="224" height="30"> <input type="text" name="name" class="formText" maxlength="30" size="30"></td>
							</tr>
                            <tr> 
                                <td height="17" valign="top"><strong>Your Postal Address*</strong></td>
                                <td height="110"> <textarea name="address" class="formText"rows="6" cols="25"></textarea></td>
                            </tr>
                            <tr> 
                                <td class="maintext"><strong>Your Email*</strong></td>
                                <td height="30"> <input type="text" name="email" class="formText"maxlength="30" size="30"></td>
                            </tr>
                            <tr> 
                                <td class="maintext"> <p><strong>Your Phone</strong></p></td>
								<td height="30"> <input type="text" name="phone" class="formText"maxlength="30" size="15"></td>
							</tr>
                            <tr> 
                                <td>&nbsp;</td>
                                <td>
								<p><span class="smallerText">* Required</span></p>
								<p>
                                  	<input name="Submit" type="image" id="Submit" src="images/nav/n_submit.gif" border="0"  onClick="submitForm(); return false;"></a>
                                    <input type="hidden" name="redirect" value="http://www.identikid.com.au/thankyou.php"> 
                                    <input type="hidden" name="recipient" value="info@identikid.com.au,leanne@identikid.com.au"> 
                                    <input type="hidden" name="subject" value="Brochure Request from website"> 
                                    <input type="hidden" name="required" value="name,address,email"> 
                                    <input type="hidden" name="title" value="Thank You"> 
								</td>
							</tr>
						</table>
					</form>
					</td>
				</tr>
   			</table>
<?PHP include("footer.php"); ?>
