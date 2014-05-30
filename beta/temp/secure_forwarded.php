<? include("header.php"); ?>

<form name="toSecure" action="<?=$_LINKS['secure']?>" method="post"> 
	<input type="hidden" name="invoiceNumber" value="<? echo $id+1000;?>"> 
	<input type="hidden" name="paymentAmount" value="<? echo $_AUTotal;?>"> 
	<input type="hidden" name="custid" value="<?=$customer?>">
	<!input type="hidden" name="ContactEmail" value="<? echo $_POST["emailadd"];?>"> 
	<!input type="hidden" name="ContactName" value="<? echo $_POST["firstname"]." ".$_POST["surname"];?>"> 
	<input type="hidden" name="section" value="getcc">

</form> 

												<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">	

													<tr>
														<td><img src="images/spacer_trans.gif" width="1" height="1"></td> 
														<td colspan="3" class="maintext">
<h1><span class="headings">Secure Transactions</span></h1>

<p><strong>You have been redirected to the secure server.</strong></p>
<p>If a window did not pop up requesting your Credit Card details your browser may not be allowing it to.</p>
<p>Go <a href="javascript:history.back();" class="type1">Back</a> and try holding down the left control button when clicking on Continue.</p>
<p>If a window is still not popping up you may need to consult the browsers Help manual or try another method of payment.</p>

<a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','../images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back" name="back" border="0"></a>

														</td> 
													</tr>
													<tr>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
													</tr>
												</table>
				
<?php include "footer.php" ?> 
