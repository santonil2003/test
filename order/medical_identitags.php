<?php 


$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = mysql_fetch_assoc($result);


$query = "SELECT * FROM prices_identitags WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY multiplier";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$k=0;
while($qdata = mysql_fetch_array($result)){
	$k++;
	$prices[$k] = $qdata['price'];
}

$mysql = "SELECT * FROM prices_reverse_text WHERE prod_id = 14";
$resulte = mysql_query($mysql) or die ("sql error");
$rowe = mysql_fetch_assoc($resulte) or die ("sql error");
$reverseprice = $rowe["reverse_text_price"];

?>
<script language="JavaScript">

var picturesAr = new Array(
					   "none",
					   "M1"					 
);

$(document).ready(
  function(){
    setup();
  });



function chkForm(theForm) {
    
		if (theForm.text1.value != '' && $.inArray(theForm.text1.value.toUpperCase(), picturesAr) == -1 ) {
			alert('Tag 1: "'+theForm.text1.value+'" is an invalid selection');
			theForm.firstLine1.focus;
		}
		else if (theForm.text2.value != '' && $.inArray(theForm.text2.value.toUpperCase(), picturesAr) == -1 ) {
			alert('Tag 2: "'+theForm.text2.value+'" is an invalid selection');
			theForm.secondLine1.focus;
		}
		else if (theForm.text3.value != '' && $.inArray(theForm.text3.value.toUpperCase(), picturesAr) == -1 ) {
			alert('Tag 3: "'+theForm.text3.value+'" is an invalid selection');
			theForm.thirdLine1.focus;
		}
		else if (theForm.text4.value != '' && $.inArray(theForm.text4.value.toUpperCase(), picturesAr) == -1 ) {
			alert('Tag 4: "'+theForm.text4.value+'" is an invalid selection');
			theForm.fourthLine1.focus;
		}
		else{
			submitform();
			//alert("ok");
		}
		
}

function setup()
{
  toggleText(1, false);
  
  toggleLabel(2, false);
  toggleReverse(2, false);
   
  toggleLabel(3, false);
  toggleReverse(3, false);
  
  toggleLabel(4, false);
  toggleReverse(4, false);


}

function toggleLabel(num, state) 
{
  if(state==true) {
   eval("document.form1.text"+num+".disabled=false;");
   //eval("document.form1.text"+num+".value = 'M1';");
   toggleReverse(num, state) 
  }
  else { 
    eval("document.form1.text"+num+".disabled=true;");
    //eval("document.form1.text"+num+".value = '';");
  }

}

function toggleText(num, state)
{
	  if(state==true) {
	    if(eval("document.form1.reverse_"+num+".checked") == true) {
	      eval("document.form1.firstLine"+num+".disabled=false;");
	      eval("document.form1.secondLine"+num+".disabled=false;");
      }
	  } else {
	    eval("document.form1.firstLine"+num+".disabled=true;");
	    eval("document.form1.secondLine"+num+".disabled=true;");
	    eval("document.form1.firstLine"+num+".value='';");
	    eval("document.form1.secondLine"+num+".value='';");
	  }
}

function toggleReverse(num, state) 
{
  if(state==true) {
     eval("document.form1.reverse_"+num+".disabled=false;");
  }
  else { 
    eval("document.form1.reverse_"+num+".disabled=true;");
    reverseSelected(num, state)
  }

}

function reverseSelected(num, state) {
  if(state==true){
    eval("document.form1.reverse"+num+".value=1;"); 
    eval("document.form1.reverse"+num+".checked=true;"); 
  } else {
    eval("document.form1.reverse"+num+".value=0;"); 
    eval("document.form1.reverse"+num+".checked=false;"); 
  } 
  toggleText(num, state);
}s


function submitform()
{
  document.form1.submit();
}


</script>
<style type="text/css">
<!--
.style3 {
	font-size: 12px;
	color: #EF65A8;
	font-weight: bold;
}
-->
</style>
<table width="84%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                          <tr bgcolor="#FFFFFF"> 
                            <td width="10" rowspan="5" valign="top"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                            <td width="244" valign="top" class="smalltext"><table width="178" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="10" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                                  <td width="168" class="smalltext"><div align="left"><font size="3" color="#FF0000"><b><?php echo $_GET['error']; ?></b></font></div></td>
                                </tr>
                              </table></td>
                            <td width="10" valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                            <td width="87" valign="top" class="smalltext">&nbsp;</td>
                            <td width="67" rowspan="5" valign="top" class="smalltext"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top" bgcolor="#FFFFFF"> 
                            <td colspan="3"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                          </tr>
                          <tr valign="top"> 
                            <td colspan="3" bgcolor="#FFFFFF" align="center" >
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td valign="top" align="center" > 
                                    <table width="400" border="0" cellspacing="2" cellpadding="2">
                                      <form name="form1" action="addtoorder.php" method="post">
                                      <tr> 
                                        <td width="90%" colspan="2" align="center"><img src="images/products/img_medical_identitags_tag.gif" ></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2">
                                          <p align="center">
                                          <span class="style3"><font face="Comic Sans MS">**extra <?=$cur['symbol'].$reverseprice?> charge for every IdentiTag with text </font>
                                          </span>
                                          </p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="center" ><font size="2" face="Comic Sans MS">Enter 
                                          a picture code in the boxes below:</font></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2" align="center"><font face="Comic Sans MS">
                                            <input name="type" type="hidden" value="14">
                                            <input name="symbol" type="hidden" value="<?=$cur['symbol']?>">
                                            <input name="reversePrice" type="hidden" value="<?=$reverseprice;?>">
                                            <input name="price1" type="hidden" value="<?=$prices[1]?>">
                                            <input name="price2" type="hidden" value="<?=$prices[2]?>">
                                            <input name="price3" type="hidden" value="<?=$prices[3]?>">
                                            <input name="price4" type="hidden" value="<?=$prices[4]?>">
                                            <input name="reverse1" type="hidden" value="0">
                                            <input name="reverse2" type="hidden" value="0">
                                            <input name="reverse3" type="hidden" value="0">
                                            <input name="reverse4" type="hidden" value="0">
                                            
                                            <font face="Comic Sans MS">1 Tag&nbsp;&nbsp;</font> 
                                            <input name="text1" type="checkbox" id="text1" value="M1" onclick="toggleLabel(2,true)">
											           <font size="2" font face="Comic Sans MS"><strong> 
                                            for <?=$cur['symbol'].$prices[1];?></strong></font> 
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td>
                                          <font  size="2"  face="Comic Sans MS"><strong>Line 1:</strong></font>
														<input name="firstLine1" type="text" id="firstLine1" size="20">
                                          <br>
                                          <font size="2" face="Comic Sans MS"><strong>Line 2:</strong></font>
                                          <input name="secondLine1" type="text" id="secondLine1" size="20" >
                                        </td>
                                        <td>
                                          <input name="reverse_1" type="checkbox" onclick="reverseSelected(1, this.checked)" value="checkbox"> <strong><font size="2">Text**</font></strong></font><br>
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2" align="center"><font face="Comic Sans MS">
                                        2 Tags&nbsp;</font> <input name="text2" type="checkbox" id="text2" value="M1" onclick="toggleLabel(3,true)">
                                          <font size="2" font face="Comic Sans MS"><strong> 
                                          for <?=$cur['symbol'].$prices[2];?></strong></font> 
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td>
                                          <font  size="2"  face="Comic Sans MS"><strong>Line 1:</strong></font>
														<input name="firstLine2" type="text" id="firstLine2" size="20">
                                          <br>
                                          <font size="2" face="Comic Sans MS"><strong>Line 2:</strong></font>
                                          <input name="secondLine2" type="text" id="secondLine2" size="20">
                                        </td>
                                        <td>
                                          <input name="reverse_2" type="checkbox" onclick="reverseSelected(2, this.checked)" value="checkbox"> <strong><font size="2">Text**</font></strong></font><br>
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2" align="center" ><font face="Comic Sans MS">3
                                          Tags&nbsp;</font> <input name="text3" type="checkbox" id="text3" value="M1" onclick="toggleLabel(4,true)"> 
                                          <font size="2" font face="Comic Sans MS"><strong> 
                                          for <?=$cur['symbol'].$prices[3];?></strong></font></td>
                                      </tr>
												  <tr> 
                                        <td>
                                          <font  size="2"  face="Comic Sans MS"><strong>Line 1:</strong></font>
														<input name="firstLine3" type="text" id="firstLine3" size="20" >
                                          <br>
                                          <font size="2" face="Comic Sans MS"><strong>Line 2:</strong></font>
                                          <input name="secondLine3" type="text" id="secondLine3" size="20">
                                        </td>
                                        <td>
                                          <input name="reverse_3" type="checkbox" onclick="reverseSelected(3, this.checked)" value="checkbox"> <strong><font size="2">Text**</font></strong></font><br>
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2" align="center"><font face="Comic Sans MS">4
                                          Tags&nbsp;</font> <input name="text4" type="checkbox" id="text4" value="M1"> 
                                          <font size="2" font face="Comic Sans MS"><strong> 
                                          for <?=$cur['symbol'].$prices[4];?></strong></font> 
                                        </td>
                                     </tr>
                                     <tr> 
                                        <td>
                                          <font  size="2"  face="Comic Sans MS"><strong>Line 1:</strong></font>
														<input name="firstLine4" type="text" id="firstLine4" size="20">
                                          <br>
                                          <font size="2" face="Comic Sans MS"><strong>Line 2:</strong></font>
                                          <input name="secondLine4" type="text" id="secondLine4" size="20">
                                        </td>
                                        <td>
                                          <input name="reverse_4" type="checkbox" onclick="reverseSelected(4, this.checked)" value="checkbox"> <strong><font size="2">Text**</font></strong></font><br>
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2">
                                          <img src="images/gen/spacer.gif" width="10" height="15">
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td colspan="2" ><div align="center"><a href="javascript: history.go(-1);" ><img src="images/nav/n_back.gif" name="back" width="58" height="22" border="0"></a> 
                                            &nbsp;&nbsp;<a href="javascript: chkForm(document.form1)" ><img src="images/nav/n_continue_x.gif" name="Image28" width="80" height="22" border="0"></a> 
                                          </div></table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td colspan="5" valign="top"><img src="images/gen/spacer.gif" width="10" height="10"></td>
                          </tr>
                        </table>