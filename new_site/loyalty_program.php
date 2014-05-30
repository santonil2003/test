<?PHP include("header.php"); ?>
			<table border="0" cellspacing="0" cellpadding="0" width="898">
				<tr>
					<td width="172"><img src="images/bread/h_loyalty_program_o.gif" alt="identi Kid Loyalty Program" name="loyalty_program" id="loyalty_program" width="239" height="39" border="0"></td>
					<td align="right"><a href="" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('view_order','','images/bread/n_view_order_x.gif',1);"><img src="images/bread/n_view_order_o.gif" alt="identi Kid Products - View My Order" name="view_order" id="view_order" width="151" height="43" border="0"></td>				
				</tr>
			</table>		
			<img src="images/gen/spacer.gif" width="1" height="10" alt=""><br>
			<table border="0" cellspacing="0" cellpadding="0" width="890">
				<tr>
					<td>
					Join our database and go into our monthly draw to win our featured product. Whilst your name remains on our database you go into the monthly draw. So ensure your details are kept up to date so we can contact you when you WIN!
 					<p>Winners are contacted by email. The prize is sent by Australia post once address is confirmed with the winner!
					<p>
					<form name="form2" method="post"  action="submitloyalty.php" onSubmit="return validateForm2();">
				  	<input type=hidden name=form_name value="sample_pack">
						<table width="400" border="0" cellpadding="5" cellspacing="0">
							<tr> 
								<td width="48%">Name</td>
								<td width="52%"><input name="contact" type="text" size="30"></td>
							</tr>
							<tr> 
								<td height="0" colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
							</tr>
							<tr> 
								<td>Email</td>
								<td><input name="emailadd" type="text" class="ordertext" size="30"></td>
							</tr>
							<tr> 
								<td height="0" colspan="2" valign="top"><img src="images/gen/spacer.gif" width="20" height="2"></td>
							</tr>
							<tr> 
								<td>Alternative Email</td>
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
								<td height="0" colspan="2" valign="top"><img src="images/gen/spacer.gif" width="20" height="2"></td>
							</tr>
							<tr> 
								<td>Phone Number</td>
								<td><input name="phonenum" type="text" class="ordertext" id="phone" size="30"></td>
							</tr>
							<tr> 
								<td height="0" colspan="2"><img src="images/gen/spacer.gif" width="20" height="2"></td>
							</tr>
							<tr> 
								<td>Mobile</td>
								<td><input name="phonenum" type="text" class="ordertext" id="phone" size="30"></td>
							</tr>
							<tr> 
								<td>&nbsp;</td>
								<td><input type="image" value="submit" src="images/nav/n_submit.gif" name="Image36" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image36','','images/nav/n_submit.gif',1)"></td>
							</tr>
						</table>
		                </form>				
					</td>
				</tr>
			</table>
			<img src="images/gen/spacer.gif" width="1" height="50" alt=""><br>
<?PHP include("footer.php"); ?>
