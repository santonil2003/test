<?
session_start();
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Send Page To A Friend</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="Label,labels,labelling,personalised,labels,name,identikid,identi,kid,sticker,stickers,vinyl,iron,iron-on,tag,shoes,pencil,pack,fabric,bag,child,kidcards,kid,cards,clothing,lost,property,school">
<meta name="description" content="Personalised name labels that really work.  Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more.  Design your own labels online, with your choice of fun fonts and pictures.  All products are high quality, attractive and easy to use.">
<script language="javascript" src="javascript.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function submitForm(){
	var emailVal=document.forms[0].to.value;
	var emailValFrom=document.forms[0].fromemail.value;
	if(document.forms[0].username.value=="" || document.forms[0].username.value=="Enter Your Name"){
		alert('Please enter your name');
	}else if(emailVal == ""){
		alert('Please enter a friends email address');
	}else if(emailVal.indexOf('@')==-1 || emailVal.indexOf('@')==emailVal.length-1 || emailVal.indexOf('.')==-1 || emailVal.indexOf('.')==emailVal.length-1){
		alert('Please enter a valid email address for your friend');
	}else if(emailValFrom.indexOf('@')==-1 || emailValFrom.indexOf('@')==emailValFrom.length-1 || emailValFrom.indexOf('.')==-1 || emailValFrom.indexOf('.')==emailValFrom.length-1){
		alert('Please enter a valid email address for yourself');
	}else{
		document.forms[0].submit();
	}
}
//-->
</script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_send_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="740" valign="top"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="181" valign="top" background="images/bg_left_column.gif"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td>
              </tr>
            </table></td>
          <td width="418" valign="top" bgcolor="#6FFF6F"> 
            <table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F">
              <tr valign="top"> 
                <td width="60" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="60" height="10"></td>
                <td width="304"><img src="images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td>
                <td width="54" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="54" height="10"></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_send_page.gif" alt="Send Page" width="167" height="45"></div></td>
                      <td bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top" bgcolor="#66FF66"> 
                <td colspan="3" bgcolor="#6FFF6F"> 
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
				  	<? if($thankyou!=true){?>
				  	<form name="form1" method="post" action="send_friend_action.php">
					<? }?>
                    <tr> 
                      <td width="10" rowspan="4" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                      <td width="397" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
						  	<? if($thankyou!=true){?>
                            <td class="maintext"><p>If you have enjoyed our website 
                                and you think that one of your friends would also 
                                enjoy it, why not let them know about it?<br>
                                <br>
                                All you need to do is write your name in the name 
                                text box, enter your friends email address in 
                                the email text box and then click on send. <br>
                              </p>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td>
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td width="43%">Your Name</td>
                                          <td width="2%" rowspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                          <td width="55%"> 
                                            <input name="username" type="text" class="smalltext" id="name" value="Enter Your Name" size="25"></td>
                                        </tr>
                                        <tr> 
                                          <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                          <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        </tr>
                                        <tr> 
                                          <td>Your Email Address</td>
                                          <td> 
                                            <input name="fromemail" type="text" class="smalltext" id="email" value="Enter Your Email Address" size="30"></td>
                                        </tr>
                                        <tr> 
                                          <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                          <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        </tr>
                                        <tr> 
                                          <td>Friends Email Address</td>
                                          <td> 
                                            <input name="to" type="text" class="smalltext" id="email" value="Enter Friends Email Address" size="30"></td>
                                        </tr>
                                        <tr> 
                                          <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                          <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                        </tr>
                                      </table>
                                    </td>
                                </tr>
                              </table></td>
							  <? }else{?>
							  <td class="maintext"><p>
							  Thankyou <? echo $from;?>,<br><br>We have forwarded our website address to <? echo $address;?><br><br>Have a great day!
                              </p></td>
							  <? }?>
                          </tr>
                        </table></td>
                      <td width="10" rowspan="4" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF">
                      <td>&nbsp;</td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
						  <tr>
                            <td width="44%"><? if($thankyou!=true){?><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Go back to previous page" name="back" width="94" height="22" border="0"></a><? }else{ ?>&nbsp;<? }?></td>
                            <td width="4%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="52%">
							<? if($thankyou!=true){?>
								<a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('send','','images/button_send_mo.gif',1)" onClick="submitForm();"><img src="images/button_send.gif" alt="Send" name="send" width="86" height="22" border="0"></a>
							<? }else{ ?>
								<a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Go back to previous page" name="back" width="94" height="22" border="0"></a>
							<? }?></td>
                          </tr>
                        </table></td>
                    </tr>
					</form>
                    <tr> 
                      <td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr bgcolor="#6FFF6F"> 
                      <td colspan="3" valign="top"><br> </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
          <td valign="top" bgcolor="FF9900"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top">
					  <?php include "navigation.php"; ?>
					  </td>
                    </tr>
                    <tr> 
                      <td> 
                        <?php include "orders.php" ?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" colspan="3" valign="top"> 
            <?php include "footer.php" ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
