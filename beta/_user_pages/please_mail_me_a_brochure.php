<table border="0" cellspacing="0" cellpadding="0" width="890">
				<tr>

					<td>
<SCRIPT language=JavaScript type=text/JavaScript>

<!--



$(document).ready(function() { 



  $('#form1').ajaxForm({beforeSubmit: validateForm, success: updateForm1 } );  

  

}); 





function validateForm(){

       var emailVal=document.form1.emailadd.value;



       if(document.form1.username.value==""){

		alert('Please enter a name');

		return false;

	}else if(emailVal.indexOf('@')==-1 || emailVal.indexOf('@')==emailVal.length-1 || emailVal.indexOf('.')==-1 ||      emailVal.indexOf('.')==emailVal.length-1){



		alert('Please enter a valid email address');

return false;



	}else if(document.form1.postadd.value==""){

		alert('Please enter a postal address');

		return false;

	}else{

		return true;

	}

}



function updateForm1() {

  //$("#form1Div").css("height", $("#form1Div").height());

  $("#form1Div").fadeOut("fast", 

    function() {

      $("#form1Div").html("<table height='100%' width='100%'><tr><td valign='middle' align='center'><b><p>Thank You</p><p>A Brochure will be mailed to you shortly. </p></b></td></tr></table>");

      $("#form1Div").fadeIn("fast");

    }

  );

}



//-->

</SCRIPT>


					<form name="form1" id="form1" method="post" action="submitBroucherForm.php">
<div id="form1Div" >
						<table width="890" border="0" cellpadding="0" cellspacing="0">
	                        <tr> 
    	                        <td width="300"><strong>Your Name*</strong></td>
								<td height="30"> <input type="text" name="username" class="formText" maxlength="30" size="30"></td>
							</tr>
                            <tr> 
                                <td height="17" valign="top"><strong>Your Postal Address*</strong></td>

                                <td height="110"> <textarea name="postadd" class="formText"rows="6" cols="25"></textarea></td>
                            </tr>
                            <tr> 
                                <td class="maintext"><strong>Your Email*</strong></td>
                                <td height="30"> <input type="text" name="emailadd" class="formText"maxlength="30" size="30"></td>
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
                                  	<input name="Submit" type="image" id="Submit" src="/temp/images/nav/n_submit.gif" border="0" ></a>

								</td>
							</tr>
						</table>
</div>
					</form>
					</td>
				</tr>

   			</table>
