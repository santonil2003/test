<script language="JavaScript" type="text/JavaScript">
<!--

var usernameCleared = false;
var fromemailCleared = false;
var toCleared = false;

function clearField(input) {
  
  switch(input.name) {
    case "username": if(usernameCleared==false) { input.value = ''; usernameCleared=true; break; }
    case "fromemail": if(fromemailCleared==false) { input.value = ''; fromemailCleared=true; break; }
    case "to": if(toCleared==false) { input.value = ''; toCleared=true; break; }
  }
  
}

function submitForm(){
	var emailVal=document.forms[0].to.value;
	var emailValFrom=document.forms[0].fromemail.value;
	var emailUserName = document.forms[0].username.value;
	if(document.forms[0].username.value=="" || document.forms[0].username.value=="Enter Your Name"){
		alert('Please enter your name');
	}else if(emailVal == ""){
		alert('Please enter a friends email address');
	}else if(emailVal.indexOf('@')==-1 || emailVal.indexOf('@')==emailVal.length-1 || emailVal.indexOf('.')==-1 || emailVal.indexOf('.')==emailVal.length-1){
		alert('Please enter a valid email address for your friend');
	}else if(emailValFrom.indexOf('@')==-1 || emailValFrom.indexOf('@')==emailValFrom.length-1 || emailValFrom.indexOf('.')==-1 || emailValFrom.indexOf('.')==emailValFrom.length-1){
		alert('Please enter a valid email address for yourself');
	}else{
     //document.forms[0].submit();
     $.ajax({
         type: "POST",
         url: "send_friend_action.php",
         data: "username="+document.forms[0].username.value+"&fromemail="+document.forms[0].fromemail.value+"&to="+document.forms[0].to.value,
         success: function(msg){
           if(msg=="true") {
             $("#sendDiv").fadeOut("fast", 
               function() {
                 $("#sendDiv").html("Thankyou "+emailUserName+",<br><br>We have forwarded our website address to "+emailVal+"<br><br>Have a great day!");
                 $("#sendDiv").fadeIn("fast");
               }
             );
               
           }
           else{
             sentOK = false;
             alert("Unable to send email");
           }
         }
       });
	}
}
//-->
</script>

  <div id="sendDiv" >
		<form name="form1" method="post" action="send_friend_action.php">
		
          <table border="0" cellspacing="0" cellpadding="0" width="890">

				<tr>
					<td align="left" >		
					If you have enjoyed our website and you think that one of your friends would also enjoy it, why not let them know about it?
					<p>All you need to do is write your name in the name text box, enter your friends email address in the email text box and then click on send.
					<p>
						<table width="500" border="0" cellspacing="0" cellpadding="5">
                     <tr> 
                       <td width="60%" align="right"><strong>Your Name:</strong></td>
                       <td width="40%"><input name="username" type="text" class="smalltext" id="name" value="Enter Your Name" size="25" onclick="clearField(this);" ></td>
							</tr>

                     <tr>
                       <td align="right"><strong>Your Email Address:</strong></td>
                       <td><input name="fromemail" type="text" class="smalltext" id="email" value="Enter Your Email Address" size="30" onclick="clearField(this);"></td>
							</tr>
							<tr> 
                       <td align="right"><strong>Friend's Email Address:</strong></td>
                       <td><input name="to" type="text" class="smalltext" id="email" value="Enter Friend's Email Address" size="30" onclick="clearField(this);"></td>
							</tr>
							<tr> 
							  <td>&nbsp;</td>
	                    <td>
	                       <a href="javascript: submitForm();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image20','','images/nav/n_send_x.gif',1)"><img src="images/nav/n_send_o.gif" alt="Send" name="Image20" id="Image20" width="56" height="22" border="0"></a>
	                   </td>
    	              </tr>
						</table>
				</td>
		  </tr>
		</table>
			</form>
			</div>