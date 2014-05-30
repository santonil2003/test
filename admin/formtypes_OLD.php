<?
include_once "../common_db.php";
linkme();

/*
if (!isset($_COOKIE["currency"]))
{
	$_COOKIE["currency"] = 1;
}
*/

// check for currency
if(!isset($_COOKIE['currency'])){
	// default to AU dollars
	setcookie("currency", 1, time()+3600);
}

function getValues(){
	
	echo "<script language=\"javascript\">
		optionAr = new Array();
		";
	$optionAr = array();
	
	$query = "SELECT * FROM prices a, currencies b, product c WHERE a.productId=c.id AND a.currencyInt=".$_COOKIE["currency"]." AND a.currencyInt=b.id";

	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	while($qdata = mysql_fetch_array($result)){
		echo "optionAr[".$qdata["productId"]."] = new Array();
		";
		$optionAr[$qdata["productId"]] = array();
		if($qdata["productId"]==6){
			$query = "SELECT * FROM prices_bagtags WHERE currencyInt=".$_COOKIE["currency"]." ORDER BY multiplier";
			
			$subresult = mysql_query($query);
			if(!$subresult) error_message(sql_error());
			
			$i=0;
			while($subqdata = mysql_fetch_array($subresult)){
				echo "optionAr[".$qdata["productId"]."][".$i."] = new Array();
				optionAr[".$qdata["productId"]."][".$i."][0] = ".$subqdata["price"].";
				optionAr[".$qdata["productId"]."][".$i."][1] = '".(($i+1)*$qdata["unitQuant"])." ".$qdata["productName"]." 1 for ".$qdata["symbol"].$subqdata["price"]."';
				";
				$i++;
			}
		}else if($qdata["productId"]==12){
				echo "optionAr[".$qdata["productId"]."][0] = new Array();
				optionAr[".$qdata["productId"]."][0][0] = ".$qdata["price"].";
				optionAr[".$qdata["productId"]."][0][1] = '".$qdata["unitQuant"]." ".$qdata["productName"]." for ".$qdata["symbol"].((int)$qdata["unitQuant"]*$qdata["price"])."'; 
				";
				$optionAr[$qdata["productId"]][$i] = array();
				$optionAr[$qdata["productId"]][$i][0] = ($i+1)*$qdata["price"];
				$optionAr[$qdata["productId"]][$i][1] = (($i+1)*$qdata["unitQuant"])." ".$qdata["productName"]." 3 for ".$qdata["symbol"].(($i+1)*$qdata["price"]);			
		}else if($qdata["productId"]==14){
		}else if($qdata["productId"]==33){
			for($i=0; $i<3; $i++){
				$optionAr[$qdata["productId"]][$i] = array();
				$optionAr[$qdata["productId"]][$i][0] = $i;
				$optionAr[$qdata["productId"]][$i][1] = (($i+1)*$qdata["unitQuant"])." ".$qdata["productName"]." for ".$qdata["symbol"].(($i+1)*$qdata["price"]);
			}
		}else{
			if($qdata["productId"]==10 || $qdata["productId"]==11){
				$to=1;
			}else{
				$to=3;
			}
			for($i=0; $i<$to; $i++){
				echo "optionAr[".$qdata["productId"]."][".$i."] = new Array();
				optionAr[".$qdata["productId"]."][".$i."][0] = ".(($i+1)*$qdata["price"]).";
				optionAr[".$qdata["productId"]."][".$i."][1] = '".(($i+1)*$qdata["unitQuant"])." ".$qdata["productName"]." 2 for ".$qdata["symbol"].(($i+1)*$qdata["price"])."';
				";
				$optionAr[$qdata["productId"]][$i] = array();
				$optionAr[$qdata["productId"]][$i][0] = ($i+1)*$qdata["price"];
				$optionAr[$qdata["productId"]][$i][1] = (($i+1)*$qdata["unitQuant"])." ".$qdata["productName"]." 3 for ".$qdata["symbol"].(($i+1)*$qdata["price"]);
			}
		}
	}
	echo "</script>";
	return $optionAr;
}

function allergyPack(){
	$optionAr=getValues();?>
	<script language="javascript">
		detailAr = new Array();
		// Allergy Alert Packs
		detailAr[18] = new Array();
		detailAr[18][0] = new Array();
		detailAr[18][0][0] = 1;
		detailAr[18][0][1] = "Vinyl Labels";
		detailAr[18][1] = new Array();
		detailAr[18][1][0] = 3;
		detailAr[18][1][1] = "Mini Labels";
		
		function allNull(optionGroup){
			while (optionGroup.options.length>0){
				deleteIndex=optionGroup.options.length-1;
				optionGroup.options[deleteIndex]=null;
			}
		}
		
		function changeDropDown(){
			allNull(document.forms[0].quantity);
			type = document.forms[0].type.value;
			text5 = document.forms[0].text5.value;


			
			if(text5==3){
				// disable phone.
				document.forms[0].text2.disabled=true;
				document.forms[0].nophone.checked=true;
				document.forms[0].nophone.disabled=true;
				document.forms[0].split.disabled=false;

				// disable fonts.
				if(document.forms[0].font[1].checked || document.forms[0].font[4].checked  || document.forms[0].font[5].checked)
				{
					alert("The font has been changed to the default font as the font that was selected cannot be used for Mini Labels.");
					document.forms[0].font[0].checked=true;
				}
				document.forms[0].font[1].disabled=true;
				document.forms[0].font[4].disabled=true;
				document.forms[0].font[5].disabled=true;
			}
			else {
				document.forms[0].text2.disabled=false;
				document.forms[0].nophone.checked=false;
				document.forms[0].nophone.disabled=false
				document.forms[0].split.disabled=true;

				document.forms[0].font[1].disabled=false;
				document.forms[0].font[4].disabled=false;
				document.forms[0].font[5].disabled=false;

			}
			

			for(i=0; i<optionAr[type].length; i++){
				document.forms[0].quantity.options[i] = new Option(optionAr[type][i][1],optionAr[type][i][0]+';'+optionAr[type][i][1]);
			}
		}
		
	</script>
	<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-size: 18px}
.style3 {color: #FF66CC}
.style4 {
	color: #FF66CC;
	font: bold 18px;
}
-->
    </style>
	
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><strong>Allergy Alert</strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
			Label Type:&nbsp;<input type=hidden name=type value=18>
			<select name="text5" onChange="changeDropDown();">
				<option value="1">Vinyl Labels</option>
				<option value="3">Mini Labels</option>
			</select>
			</td>
		</tr>
		<tr>
			<td><? addFont(1); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addAllergyPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addName(true, true); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPhone(false); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><?// addColoursBoysGirls(); ?>
			<input type="radio" name="pack1_colours" value="1"> 
              &nbsp;Tomato Red&nbsp;&nbsp; <input type="radio" name="pack1_colours" value="2"> 
              &nbsp;Sky Blue <br> <input type="radio" name="pack1_colours" value="3" checked> 
              &nbsp;Sunny Yellow&nbsp;&nbsp; <input type="radio" name="pack1_colours" value="4"> 
              &nbsp;Zesty Orange <br> <input type="radio" name="pack1_colours" value="5"> 
              &nbsp;Kiwi Lime&nbsp;&nbsp; <input type="radio" name="pack1_colours" value="6"> 
              &nbsp;Lavendar <br> <input type="radio" name="pack1_colours" value="7" checked> 
              &nbsp;Hot Pink&nbsp;&nbsp; <input type="radio" name="pack1_colours" value="8"> 
              &nbsp;White <br> <input type="radio" name="pack1_colours" value="9">
              Rainbow A&nbsp;&nbsp; <input type="radio" name="pack1_colours" value="10">
        Rainbow B<br>
        <br>
        <strong>Font Colour:</strong><br> <input type="radio" name="fontcol" value="1">
        &nbsp;Black&nbsp;&nbsp;
        <input type="radio" name="fontcol" value="2" checked>
        &nbsp;White </td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
			Quantity:&nbsp;
			<select name="quantity">
				<? for($i=0; $i<count($optionAr[18]); $i++){
					echo "<option value=\"".$optionAr[18][$i][0].";".$optionAr[18][$i][1]."\">".$optionAr[18][$i][1]."</option>";
				} ?>
			</select>
			</td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?


}


function sharedPack(){
	$optionAr=getValues();

	?>
	<script>
	function changeDropDown(){
		var pack1=document.additem.pack1[document.additem.pack1.selectedIndex].value;
		if(pack1==1)
		{ // vinyl
			for (i=0; i<10; i++)
			{
				document.additem.pack1_colours[i].disabled=false;
			}
			document.additem.pack1_fontcol[0].disabled=false;
			document.additem.pack1_fontcol[1].disabled=false;
			document.additem.pack1_text2.disabled=false;
			document.additem.pack1_nophone.checked=false;
			document.additem.pack1_nophone.disabled=false;
			document.additem.ironon[0].diasabled = true;	
			document.additem.ironon[1].diasabled = true;
		}
		else if(pack1==2)
		{	// iron-ons
			for (i=0; i<10; i++)
			{
				document.additem.pack1_colours[i].disabled=true;
			}
			//document.additem.pack1_colours[8].disabled=true;
			//document.additem.pack1_colours[9].disabled=true;
			//document.additem.pack1_fontcol[0].disabled=true;
			//document.additem.pack1_fontcol[1].disabled=true;
			document.additem.pack1_text2.disabled=false;
			document.additem.pack1_nophone.checked=false;
			document.additem.pack1_nophone.disabled=false;
			document.additem.ironon[0].disabled = false;	
			document.additem.ironon[1].disabled = false;
		}
		else if(pack1==3)
		{	// mini's
			for (i=0; i<10; i++)
			{
				document.additem.pack1_colours[i].disabled=false;
			}
			document.additem.pack1_fontcol[0].disabled=false;
			document.additem.pack1_fontcol[1].disabled=false;
			document.additem.pack1_text2.disabled=true;
			document.additem.pack1_nophone.checked=true;
			document.additem.pack1_nophone.disabled=true;
			document.additem.ironon[0].disabled = true;	
			document.additem.ironon[1].disabled = true;
		}

	}
	function changepack2DropDown(){
		var pack2=document.additem.pack2[document.additem.pack2.selectedIndex].value;
		if(pack2==1)
		{ // vinyl
			for (i=0; i<10; i++)
			{
				document.additem.pack2_colours[i].disabled=false;
			}
			document.additem.pack2_nophone.checked=false;
			document.additem.pack2_nophone.disabled=false;
			document.additem.pack2_text2.disabled=false;
			document.additem.pack2_fontcol[0].disabled=false;
			document.additem.pack2_fontcol[1].disabled=false;
			document.additem.ironon2[0].disabled = true;	
			document.additem.ironon2[1].disabled = true;
		}
		else if(pack2==2)
		{	// iron-ons
			for (i=0; i<10; i++)
			{
				document.additem.pack2_colours[i].disabled=true;
			}
			//document.additem.pack2_colours[8].disabled=true;
			//document.additem.pack2_colours[9].disabled=true;
			//document.additem.pack2_fontcol[0].disabled=true;
			//document.additem.pack2_fontcol[1].disabled=true;
			document.additem.pack2_nophone.checked=false;
			document.additem.pack2_nophone.disabled=false;
			document.additem.pack2_text2.disabled=false;
			document.additem.ironon2[0].disabled = false;	
			document.additem.ironon2[1].disabled = false;
		}
		else if(pack2==3)
		{	// mini's
			for (i=0; i<10; i++)
			{
				document.additem.pack2_colours[i].disabled=false;
			}
			document.additem.pack2_fontcol[0].disabled=false;
			document.additem.pack2_fontcol[1].disabled=false;
			document.additem.pack2_nophone.checked=true;
			document.additem.pack2_nophone.disabled=true;
			document.additem.pack2_text2.disabled=true;
			document.additem.ironon2[0].disabled = true;	
			document.additem.ironon2[1].disabled = true;

		}

	}
	
		function changeIcolours(x) {
			if(x==1){
				for (i=0; i<10; i++)
				{
					document.additem.pack1_colours[i].disabled=true;
				}
			}else{
				for (i=0; i<8; i++)
				{
					document.additem.pack1_colours[i].disabled=false;
				}
			
			}
		}
		function changepacktwoColours(x) {
			if(x==1){
				for (i=0; i<10; i++)
				{
					document.additem.pack2_colours[i].disabled=true;
				}
			}else{
				for (i=0; i<8; i++)
				{
					document.additem.pack2_colours[i].disabled=false;
				}
			
			}
		}
	</script>
	
<table cellpadding="0" cellspacing="0" border="0">
  <form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
    <input type=hidden name=type value="17">
    <? validateFormSharedPack();?>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext"><strong>Shared Pack</strong></td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext"><h1>Pack 1</h1></td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext"> Pack Type:&nbsp; <select name="pack1" onChange="changeDropDown();">
          <option value="1">30 Vinyl Labels</option>
          <option value="2">30 Iron Ons</option>
          <option value="3">30 Mini Vinyl Labels</option>
        </select> </td>
    </tr>
    <tr> 
      <td> 
        <? addFontShared("pack1_"); ?>
      </td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td> 
        <? addPicture("pack1_"); ?>
      </td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td> 
        <? addName(true, true, "pack1_"); ?>
      </td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td> 
        <? addPhone(false, "pack1_"); ?>
      </td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td><table cellpadding="0" cellspacing="0" border="0">
          <tr> 
            <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
          </tr>
          <tr> 
            <td><hr noshade></td>
          </tr>
          <tr> 
            <td class="admintext">Vinyl, Mini Vinyl, Iron-On Colours: <br> 
              <input name="pack1_colours" type="radio" value="1" checked="checked"> 
              &nbsp;Tomato Red&nbsp;&nbsp; <input type="radio" name="pack1_colours" value="2"> 
              &nbsp;Sky Blue <br> <input type="radio" name="pack1_colours" value="3"> 
              &nbsp;Sunny Yellow&nbsp;&nbsp; <input type="radio" name="pack1_colours" value="4"> 
              &nbsp;Zesty Orange <br> <input type="radio" name="pack1_colours" value="5"> 
              &nbsp;Kiwi Lime&nbsp;&nbsp; <input type="radio" name="pack1_colours" value="6"> 
              &nbsp;Lavendar <br> <input type="radio" name="pack1_colours" value="7"> 
              &nbsp;Hot Pink&nbsp;&nbsp; <input type="radio" name="pack1_colours" value="8"> 
              &nbsp;White <br> <input type="radio" name="pack1_colours" value="9">
              Rainbow A&nbsp;&nbsp; <input type="radio" name="pack1_colours" value="10">
            Rainbow B</td>
          </tr>
          <tr> 
            <td><hr noshade></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td class="admintext">Font Colour:<br> <input name="pack1_fontcol" type="radio" value="1" checked> 
        &nbsp;Black&nbsp;&nbsp; <input type="radio" name="pack1_fontcol" value="2"> 
        &nbsp;White </td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext"><strong>Iron-Ons:</strong><br> <input name="ironon" type="radio" value="1" checked disabled onclick="changeIcolours(1)">
        Semi-permanent&nbsp;&nbsp; <input name="ironon" type="radio" value="2" disabled onclick="changeIcolours(2)">
        Coloured</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext"><h1>Pack 2</h1></td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext"> Pack Type:&nbsp; <select name="pack2" onChange="changepack2DropDown();">
          <option value="1">30 Vinyl Labels</option>
          <option value="2">30 Iron Ons</option>
          <option value="3">30 Mini Vinyl Labels</option>
        </select> </td>
    </tr>
    <tr> 
      <td> 
        <? addFontShared("pack2_"); ?>
      </td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td> 
        <? addPicture("pack2_"); ?>
      </td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td> 
        <? addName(true, true, "pack2_"); ?>
      </td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td> 
        <? addPhone(false, "pack2_"); ?>
      </td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td><table cellpadding="0" cellspacing="0" border="0">
          <tr> 
            <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
          </tr>
          <tr> 
            <td><hr noshade></td>
          </tr>
          <tr> 
            <td class="admintext">Vinyl, Mini Vinyl, Iron-On Colours: <br> 
              <input name="pack2_colours" type="radio" value="1" checked="checked"> 
              &nbsp;Tomato Red&nbsp;&nbsp; <input type="radio" name="pack2_colours" value="2"> 
              &nbsp;Sky Blue <br> <input type="radio" name="pack2_colours" value="3"> 
              &nbsp;Sunny Yellow&nbsp;&nbsp; <input type="radio" name="pack2_colours" value="4"> 
              &nbsp;Zesty Orange <br> <input type="radio" name="pack2_colours" value="5"> 
              &nbsp;Kiwi Lime&nbsp;&nbsp; <input type="radio" name="pack2_colours" value="6"> 
              &nbsp;Lavendar <br> <input type="radio" name="pack2_colours" value="7"> 
              &nbsp;Hot Pink&nbsp;&nbsp; <input type="radio" name="pack2_colours" value="8"> 
              &nbsp;White <br> <input type="radio" name="pack2_colours" value="9">
              Rainbow A&nbsp;&nbsp; <input type="radio" name="pack2_colours" value="10">
            Rainbow B</td>
          </tr>
          <tr> 
            <td><hr noshade></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext">Font Colour:<br> <input name="pack2_fontcol" type="radio" value="1" checked> 
        &nbsp;Black&nbsp;&nbsp; <input type="radio" name="pack2_fontcol" value="2"> 
        &nbsp;White </td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
    </tr>
	    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext"><strong>Iron-Ons:</strong><br> 
        <input name="ironon2" type="radio" value="1" checked disabled onclick="changepacktwoColours(1)">
        Semi-permanent&nbsp;&nbsp; <input name="ironon2" type="radio" value="2" disabled onclick="changepacktwoColours(2)">
        Coloured</td>
    </tr>
    <tr> 
      <td> 
        <? submitButton();?>
      </td>
    </tr>
    <tr> 
      <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
  </form>
</table>
	<?
}

function vinyl(){
	$optionAr=getValues();?>
	<script language="javascript">
		/*
		optionAr = new Array();
		// vinyl lables
		optionAr[1] = new Array();
		optionAr[1][0] = new Array();
		optionAr[1][0][0] = 22;
		optionAr[1][0][1] = "60 Vinyl Lables for $22";
		optionAr[1][1] = new Array();
		optionAr[1][1][0] = 44;
		optionAr[1][1][1] = "120 Vinyl Lables for $44";
		optionAr[1][2] = new Array();
		optionAr[1][2][0] = 66;
		optionAr[1][2][1] = "180 Vinyl Lables for $66";
		
		// bag tags
		optionAr[6] = new Array();
		optionAr[6][0] = new Array();
		optionAr[6][0][0] = 8;
		optionAr[6][0][1] = "2 tags for $8";
		optionAr[6][1] = new Array();
		optionAr[6][1][0] = 10;
		optionAr[6][1][1] = "4 tags for $10";
		
		// starter pack
		optionAr[10] = new Array();
		optionAr[10][0] = new Array();
		optionAr[10][0][0] = 55;
		optionAr[10][0][1] = "1 Starter Pack for $55";
		
		// mixed pack
		optionAr[11] = new Array();
		optionAr[11][0] = new Array();
		optionAr[11][0][0] = 27;
		optionAr[11][0][1] = "1 Mixed Pack for $27";
		
		// birthday pack
		optionAr[12] = new Array();
		optionAr[12][0] = new Array();
		optionAr[12][0][0] = 31;
		optionAr[12][0][1] = "1 Birthday Pack for $31";
		
		*/
		detailAr = new Array();
		// starter pack
		detailAr[10] = new Array();
		detailAr[10][0] = new Array();
		detailAr[10][0][0] = 1;
		detailAr[10][0][1] = "30 Mini Labels";
		detailAr[10][1] = new Array();
		detailAr[10][1][0] = 2;
		detailAr[10][1][1] = "60 Pencil Labels";
		
		// mixed pack
		detailAr[11] = new Array();
		detailAr[11][0] = new Array();
		detailAr[11][0][0] = 0;
		detailAr[11][0][1] = "30 Vinyl Labels & 30 Iron-On";
		detailAr[11][1] = new Array();
		detailAr[11][1][0] = 1;
		detailAr[11][1][1] = "60 Vinyl";
		detailAr[11][2] = new Array();
		detailAr[11][2][0] = 2;
		detailAr[11][2][1] = "60 Iron-on";

		// new Baby Pack
		detailAr[16] = new Array();
		detailAr[16][0] = new Array();
		detailAr[16][0][0] = 0;
		detailAr[16][0][1] = "40 Mini, 20 Iron-On, 1 identiTag, 1 envelope, 1 Kidcard";

		
		
		function allNull(optionGroup){
			while (optionGroup.options.length>0){
				deleteIndex=optionGroup.options.length-1;
				optionGroup.options[deleteIndex]=null;
			}
		}
		
		function changeDropDown(){
			allNull(document.forms[0].quantity);
			type = document.forms[0].type.value;
			
			if (type == 1 || type == 6 || type == 10 || type == 11 || type == 12){
				 for (var i=0; i<document.forms[0].elements.length; i++) {
   					 if (document.forms[0].elements[i].name == 'colours') {
      					document.forms[0].elements[i].disabled = true;
         			}
					 if (document.forms[0].elements[i].name == 'vcolours') {
      					document.forms[0].elements[i].disabled = false;
         			}
   					 if (document.forms[0].elements[i].name == 'fontcol') {
      					document.forms[0].elements[i].disabled = false;
         			}
  		  		 }
			}else{
		 		 for (var i=0; i<document.forms[0].elements.length; i++) {
   					 if (document.forms[0].elements[i].name == 'colours') {
      					document.forms[0].elements[i].disabled = false;
    				}
   					 if (document.forms[0].elements[i].name == 'vcolours') {
      					document.forms[0].elements[i].disabled = true;
         			}
   					 if (document.forms[0].elements[i].name == 'fontcol') {
      					document.forms[0].elements[i].disabled = true;
         			}
  		  		 }
			}
			
			
			if (type == 10 || type==16 || type == 12){
				document.forms[0].text3.disabled=false;
				//document.forms[0].text4.disabled=false;
			}else{
				document.forms[0].text3.disabled=true;
				//document.forms[0].text4.disabled=true;
			}
		
			if(type!=11 && type!=10 && type!=12){
				// disable phone.
				document.forms[0].ironon[0].disabled=true;
				document.forms[0].ironon[1].disabled=true;
				for (var i=0; i<document.forms[0].elements.length; i++)
				{
					if (document.forms[0].elements[i].name == 'icolours') {
      					document.forms[0].elements[i].disabled = true;
         			}
					if (document.forms[0].elements[i].name == 'ifcolour') {
      					document.forms[0].elements[i].disabled = true;
         			}
				}
			}
			else {
				document.forms[0].ironon[0].disabled=false;
				document.forms[0].ironon[1].disabled=false;
				for (var i=0; i<document.forms[0].elements.length; i++)
				{
					if (document.forms[0].elements[i].name == 'icolours') {
      					document.forms[0].elements[i].disabled = true;
         			}
					if (document.forms[0].elements[i].name == 'ifcolour') {
      					document.forms[0].elements[i].disabled = true;
         			}
				}
			}

			

			if(type==12){
				document.forms[0].text5.disabled=false;
			}
			else {
				document.forms[0].text5.disabled=true;
			}
			

			if(type!=10 && type!=11 && type!=16){
				document.forms[0].typedetail.disabled=true;
			}else{
				document.forms[0].typedetail.disabled=false;
				for(i=0; i<detailAr[type].length; i++){
					document.forms[0].typedetail.options[i] = new Option(detailAr[type][i][1],detailAr[type][i][0]);
				}
			}
			for(i=0; i<optionAr[type].length; i++){
				document.forms[0].quantity.options[i] = new Option(optionAr[type][i][1],optionAr[type][i][0]+';'+optionAr[type][i][1]);
			}
		}
		
		function changeIcolours(x) {
			if(x==1){
				for (var i=0; i<document.forms[0].elements.length; i++)
				{
					if (document.forms[0].elements[i].name == 'icolours') {
      					document.forms[0].elements[i].disabled = true;
         			}
					if (document.forms[0].elements[i].name == 'ifcolour') {
      					document.forms[0].elements[i].disabled = true;
         			}
				}
			}else{
				for (var i=0; i<document.forms[0].elements.length; i++)
				{
					if (document.forms[0].elements[i].name == 'icolours') {
      					document.forms[0].elements[i].disabled = false;
         			}
					if (document.forms[0].elements[i].name == 'ifcolour') {
      					document.forms[0].elements[i].disabled = false;
         			}
				}
			
			}
		}
		
	</script>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			
      <td class="admintext"><strong>Vinyl/Bagtag/Mixed/Birthday/Starter</strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
			Label Type:&nbsp;
			<select name="type" onChange="changeDropDown();">
          <option value="1">Vinyl Label</option>
          <option value="6">Bag Tag</option>
          <option value="11">Mixed Pack</option>
          <option value="12">Birthday Pack</option>
          <option value="10">Starter Pack</option>
        </select>			</td>
		</tr>
		<tr>
			<td><? addFont(1); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addName(true, true); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPhone(false); ?></td>
		</tr>
		<!--<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? //addColoursBoysGirls(); ?>
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
					<tr>
						<td class="admintext">Colours: <input type="radio" name="<?=$packNum;?>colours" value="1" disabled>&nbsp;Rainbow A&nbsp;&nbsp;<input type="radio" name="<?=$packNum;?>colours" value="2" checked disabled>&nbsp;Rainbow B</td>
					</tr>
				</table>
			</td>
		</tr>-->
		<tr>
				<td>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><hr noshade></td>
		</tr>
		<tr>
			<td class="admintext">Colours:
				<br> <input type="radio" name="vcolours" value="1">&nbsp;Tomato Red&nbsp;&nbsp;<input type="radio" name="vcolours" value="2" checked>&nbsp;Sky Blue
				<br><input type="radio" name="vcolours" value="3" checked>&nbsp;Sunny Yellow&nbsp;&nbsp;<input type="radio" name="vcolours" value="4" checked>&nbsp;Zesty Orange
				<br><input type="radio" name="vcolours" value="5" checked>&nbsp;Kiwi Lime&nbsp;&nbsp;<input type="radio" name="vcolours" value="6" checked>&nbsp;Lavendar
				<br><input type="radio" name="vcolours" value="7" checked>&nbsp;Hot Pink&nbsp;&nbsp;<input type="radio" name="vcolours" value="8" checked>&nbsp;White
				<br><input type="radio" name="vcolours" value="9" checked>
              Rainbow A&nbsp;&nbsp; 
              <input type="radio" name="vcolours" value="10" checked>
              Rainbow B</td>
		</tr>
		<tr>
			<td><hr noshade></td>
		</tr>
	</table>				</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><strong>Font Colour:</strong><br>
				<input type="radio" name="fontcol" value="1">&nbsp;Black&nbsp;&nbsp;<input type="radio" name="fontcol" value="2" checked>&nbsp;White			</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>			
		<tr>
			<td class="admintext">
			<strong>Pack Type:</strong>&nbsp;
			<select name="typedetail" disabled>
				<option value=""></option>
			</select></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>			
		<tr>
			<td class="admintext">
			<strong>Iron-Ons:</strong><br>
			<input name="ironon" type="radio" value="1" checked disabled onclick="changeIcolours(1)">Semi-permanent&nbsp;&nbsp;<input name="ironon" type="radio" value="2" disabled  onclick="changeIcolours(2)">Coloured			</td>
		</tr>
		<tr>
		  <td class="admintext"><strong><br />
	      Iron-On Colour:<br />
		    <input type="radio" name="icolours" value="1" disabled/>
		      &nbsp;Tomato Red&nbsp;&nbsp;
		      <input type="radio" name="icolours" value="2" checked="checked"  disabled/>
		      &nbsp;Sky Blue <br />
		      <input type="radio" name="icolours" value="3" checked="checked" disabled />
		      &nbsp;Sunny Yellow&nbsp;&nbsp;
		      <input type="radio" name="icolours" value="4" checked="checked" disabled/>
		      &nbsp;Zesty Orange <br />
		      <input type="radio" name="icolours" value="5" checked="checked" disabled />
		      &nbsp;Kiwi Lime&nbsp;&nbsp;
		      <input type="radio" name="icolours" value="6" checked="checked" disabled />
		      &nbsp;Lavendar <br />
		      <input type="radio" name="icolours" value="7" checked="checked" disabled />
		      &nbsp;Hot Pink&nbsp;&nbsp;
		      <input type="radio" name="icolours" value="8" checked="checked" disabled />
	      &nbsp;White </strong></td>
		  </tr>
		<tr>
		  <td class="admintext"><br />
		    <strong>Iron-On Font Colour: <br />
		    <input type="radio" name="ifcolour" value="1" disabled/>
		    &nbsp;Black&nbsp;&nbsp;
		    <input type="radio" name="ifcolour" value="2" checked="checked" disabled/>
		    &nbsp;White </strong></td>
		  </tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
			Quantity:&nbsp;
			<select name="quantity">
				<? for($i=0; $i<count($optionAr[1]); $i++){
					echo "<option value=\"".$optionAr[1][$i][0].";".$optionAr[1][$i][1]."\">".$optionAr[1][$i][1]."</option>";
				} ?>
			</select>			</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><? AddIdentiTagSelectionLists();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><? AddGiftCardSelectionLists();?></td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
}

function newbabypack(){
	$optionAr=getValues();?>
	<script language="javascript">
	</script>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0">
			<input name="type" type="hidden" value="16">
			<input name="quantity" type="hidden" value="1 New Baby Pack">
			</td>
		</tr>
		<tr>
			<td><? addFont(1); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addName(true, true); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
					<tr>
						<td class="admintext">Colours: <input type="radio" name="colours" value="11">&nbsp;Baby Blue&nbsp;&nbsp;<input type="radio" name="colours" value="12" checked>&nbsp;Baby Pink</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
				<td>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><hr noshade></td>
		</tr>
	</table>	
				
				</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>			
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			
      <td class="admintextattentionALT">Identitag: 
<select name="text3">
					<option value="" selected>[None]</option>
					<option value="A">Sun</option>
					<option value="S">Shark</option>
					<option value="C">Frangipani</option>
					<option value="T">Train</option>
					<option value="H">Butterfly</option>
					<option value="U">Ballerina</option>
					<option value="M">Dinosaur</option>
					<option value="V">Motorbike</option>
					<option value="N">Fairy</option>
					<option value="W">Horse</option>
					<option value="Q">Mermaid</option>
					<option value="X">Skull</option>
					<option value="R">Truck</option>
					<option value="Y">Surfer</option>
					<option value="C1">Frog</option>
					<option value="D1">Surfer Girl</option>
					<option value="Z">Pirate</option>
					<option value="P">Plane</option>
					<option value="E">Loveheart</option>
					<option value="J">Car</option>
					<option value="F1">Rocket</option>
					<option value="I">UFO</option>
					<option value="E1">Bee</option>
					<option value="A1">Cow</option>
					<option value="G1">Bear</option>
					<option value="H1">Pig</option>
					<option value="I1">Cat</option>
					<option value="J1">Spider</option>
					<option value="I">UFO</option>
					<option value="J">Car</option>
					<option value="F1">Rocket</option>
					<option value="E1">Bee</option>
					<option value="U2">Purple Ballerina</option>
					<option value="K1">Dog</option>
					<option value="L1">Little Girl</option>
					<option value="M1">Medi ALert</option>
					<option value="N1">Star</option>
					
	    </select></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			
      <td class="admintextattention"> Gift Card:
                <select name="text5">
				<option value="" selected>[None]</option>
				<option value="6">Flower</option>
				<option value="1">Sun</option>
				<option value="16">Mermaid</option>
				<option value="4">Heart</option>
				<option value="13">Fairy</option>
				<option value="7">Butterfly</option>
				<option value="20">Ballerina</option>
				<option value="15">Aeroplane</option>
				<option value="11">Star</option>
				<option value="19">Train</option>
				<option value="18">Shark</option>
				<option value="9">Car</option>
				<option value="17">Truck</option>
		  <option value="12">Dinosaur</option></select></td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
}

function identiTAGS(){
	$optionAr=getValues();
	
	$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];

	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	while($qdata = mysql_fetch_array($result)){
		$symbol = $qdata["symbol"];
	}
	
	?>
	<script language="javascript">
	iTagList=new Array();
	
	function ClearIdentiTagSelection(){
		for (i = 1; i < 5; i++){
			document.forms['additem']['IdentiTag' + i].value = "none";
			document.forms['additem']['Tag' + i].src = "../images/spacer_trans.gif";
		}
		EmptyIdentiTagListArray();
	}
	
	function EmptyIdentiTagListArray(){
		while (iTagList.length > 0){
			iTagList.pop();
		}
	}
	
	function FillIdentiTagListArray(){
		for (i = 1; i < 5; i++){
			if (document.forms['additem']['IdentiTag' + i].value != "none"){
				iTagList.push(document.forms['additem']['IdentiTag' + i].value);
			}
		}
	}
	
	<!-- Updates the IdentiTag image above each selection box based on the IdentiTag selected -->
	function UpdateIdentiTagImage(SelectionNumber){
		var SelectionValue = document.forms['additem']['IdentiTag' + SelectionNumber].value;
		var ImageSource = "";
		switch (SelectionValue){
			case "A":
				ImageSource = "../images/pc1.gif";
				break;
			case "S":
				ImageSource = "../images/pc18.gif";
				break;
			case "C":
				ImageSource = "../images/pc28.gif";
				break;
			case "T":
				ImageSource = "../images/pc19.gif";
				break;
			case "H":
				ImageSource = "../images/pc7.gif";
				break;
			case "U":
				ImageSource = "../images/pc20.gif";
				break;
			case "M":
				ImageSource = "../images/pc12.gif";
				break;
			case "V":
				ImageSource = "../images/pc21.gif";
				break;
			case "N":
				ImageSource = "../images/pc13.gif";
				break;
			case "W":
				ImageSource = "../images/pc22.gif";
				break;
			case "Q":
				ImageSource = "../images/pc16.gif";
				break;
			case "X":
				ImageSource = "../images/pc23.gif";
				break;
			case "R":
				ImageSource = "../images/pc17.gif";
				break;
			case "Y":
				ImageSource = "../images/pc24.gif";
				break;
			case "C1":
				ImageSource = "../images/pc29.gif";
				break;
			case "D1":
				ImageSource = "../images/pc30.gif";
				break;
			case "Z":
				ImageSource = "../images/pc25.gif";
				break;
			case "P":
				ImageSource = "../images/pc15.gif";
				break;
			case "E":
				ImageSource = "../images/pc4.gif";
				break;
			case "A1":
				ImageSource = "../images/pc26.gif";
				break;
			case "G1":
				ImageSource = "../images/pc33.gif";
				break;
			case "H1":
				ImageSource = "../images/pc34.gif";
				break;
			case "I1":
				ImageSource = "../images/pc35.gif";
				break;
			case "J1":
				ImageSource = "../images/pc32.gif";
				break;
			case "I":
				ImageSource = "../images/identitags/I.gif";
				break;
			case "J":
				ImageSource = "../images/identitags/J.gif";
				break;
			case "F1":
				ImageSource = "../images/identitags/F1.gif";
				break;
			case "E1":
				ImageSource = "../images/identitags/E1.gif";
				break;
			case "U2":
				ImageSource = "../images/identitags/U2.gif";
				break;
		}
		document.forms['additem']['Tag' + SelectionNumber].src = ImageSource;
		EmptyIdentiTagListArray();
		FillIdentiTagListArray();
	}
	
	function changeITagList(num){
		if(document.forms['additem']['pic'+num].checked==false){
			for(i=0; i<iTagList.length; i++){
				if(num==iTagList[i]){
					iTagList.splice(i,1);
				}
			}
		}else{
			if(iTagList.length==4){
				document.forms['additem']['pic'+iTagList[0]].checked=false;
				iTagList.splice(0,1);
			}
			iTagList.push(num);
		}
	}
	</script>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<input type="hidden" name="type" value="14">
		<input type="hidden" name="symbol" value="<? echo $symbol;?>">
		<input type="hidden" name="cardsVal" value="">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><strong>identiTAGS</strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPictureItags(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
}

function identiBANDS(){
	include("../useractions.php");
	$optionAr=getValues();
	
	$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];

	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	while($qdata = mysql_fetch_array($result)){
		$symbol = $qdata["symbol"];
	}
	
$query = "	SELECT * 
			FROM prices a, currencies b, product c 
			WHERE a.productId IN (30,31,32) 
			AND a.productId=c.id 
			AND a.currencyInt=".$_COOKIE["currency"]." 
			AND a.currencyInt=b.id";
$result = db_query($query);
if(!$result) error_message(sql_error());
$price1 = db_fetch_array($result);
$price2 = db_fetch_array($result);
$price3 = db_fetch_array($result);

$result = product_details(30, $_COOKIE['currency'], $product);
$price_formatted = (int)$product['unitQuant'] . "  for " . $product['symbol'].sprintf("%01.2f", $product['price']);

$result2 = product_details(31, $_COOKIE['currency'], $product);
$price_formatted2 = (int)$product['unitQuant'] . "  for " . $product['symbol'].sprintf("%01.2f", $product['price']);

$result3 = product_details(32, $_COOKIE['currency'], $product);
$price_formatted3 = (int)$product['unitQuant'] . "  for " . $product['symbol'].sprintf("%01.2f", $product['price']);

	?>
	<script language="javascript" src="../javascript.js"></script>
	<script language="JavaScript" src="../myAHAHlib.js"></script>
	<script>
		function adjustForm() {
			var quantity = document.form1.quantity.value;
			
			for (var i=1; i<quantity; i++)
			{	
				document.getElementById("design"+i).disabled=false;
				document.getElementById("bdesign"+i).style.display='';
				document.getElementById("banddesign"+i).style.display='';
			}
			for (var i=4; i>=quantity; i--)
			{	
				document.getElementById("design"+i).disabled=true;
				document.getElementById("bdesign"+i).style.display='none';
				document.getElementById("banddesign"+i).style.display='none';
			}
		}
		
		function submitform()
		{
			document.form1.submit();
		}
	</script>

	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><strong>identiBANDS</strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<form name="form1" action="addphoneorder_additem.php" method="post"><input name="type" type="hidden" value="30">
		  <tr valign="top">
			<td colspan="3" bgcolor="#FFFFFF">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				
			<tr>
				  <td><table width="100%" border="0" cellpadding="3">            
				   <tr>
					<td width="150">
					  <span class="style2">Select your quantity :</span></td>
				  <td>
				   <span class="admintext">
					<select name="quantity" id="quantity" onChange="adjustForm(),callAHAH('../identiband_response.php?id=blah', 'displaydiv', 'Please wait - page updating ...')">
					  <option value="1" SELECTED>1 Lot (10 Bands 1 design)</option>
					  <option value="2">2 Lots (20 Bands 2 designs)</option>
					  <option value="5">5 Lots (50 Bands 5 designs)</option>
					</select>
				  </span></td>
				  </tr>
				  </table>
				  </td>
				</tr>
				<tr>
				  <td height="10"><img src="images/spacer_trans.gif" width="1" height="10"></td>
				</tr>
				<tr>
				  <td><table width="100%" border="0" cellpadding="2">
						<tr>
						  <td><span class="style2">Select a design</span></td>
						  <td><div id="displaydiv" class="style3"></div></td>
						<tr> 
						  <?php
$quantity = 1;		

for ($i=0; $i<=4; $i++)
{ 
$design = "design".$i; 
?>
						<tr> 
						  <td colspan="2">
							<div align="left" id="<?= 'b'.$design; ?>"><span class="style1">Design<? echo $i + 1; ?>:</span> <br />
							  <select name="<?= $design ?>" onChange="callAHAH('../identiband_response.php?id=blah', 'displaydiv', 'Please wait - page updating ...')" id="<?= $design ?>" <? if ($i >= $quantity) echo "DISABLED" ?>>
								<option value="U" SELECTED>U - Pink Ballerina</option>
								<option value="Y">Y - Surfer Guy</option>
								<option value="R">R - Truck</option>
								<option value="A1">A1 - Cow</option>
								<option value="D1">D1 - Surfer Girl</option>
								<option value="Q">Q - Mermaid</option>
								<option value="F1">F1 - Rocket</option>
								<option value="N">N - Fairy</option>
								<option value="H">H - Butterfly</option>
								<option value="Z">Z - Pirate</option>
								<option value="G1">G1 - Bear</option>
								<option value="F">F - Nurse (Medical)</option>
							  </select>
							</div>
							<div id="<?= 'band'.$design ?>"></div>
						  </td>
						</tr>
						<? } ?>
					  </table></td>
				</tr>
			  </table></td>
		  </tr>
			<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0" onLoad="javascript: adjustForm(); callAHAH('../identiband_response.php?id=blah', 'displaydiv', 'Please wait - page updating ...');"></td>
		</tr>
		</form>
	</table>
	<?
}

function iron(){
	$optionAr=getValues();?>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<input type="hidden" name="type" value="2">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><strong>Iron-on labels</strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addFont(2); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addName(true, true); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPhone(false); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">Colours: Black &amp; White</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
			Quantity:&nbsp;
			<select name="quantity">
				<? for($i=0; $i<count($optionAr[2]); $i++){
					echo "<option value=\"".$optionAr[2][$i][0].";".$optionAr[2][$i][1]."\">".$optionAr[2][$i][1]."</option>";
				} ?>
			</select>
			</td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
}

function mini(){
	$optionAr=getValues();?>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<input type="hidden" name="type" value="3">
		<? validateForm();?>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" class="admintext"><strong>Mini labels</strong></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2"><? addFont(3); ?></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2"><? addPicture(); ?></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext" align="left">
			<table cellpadding=0 cellspacing=0 border=0>
				<tr>
					<td align="left" width="100" class="admintext">Name:</td>
					<td class="admintext" align="left"><input type="text" name="text1" value=""></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" class="admintext" align="left"><?
		background_colour_select('colour', true);
		
		?></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" class="admintext" align="left"><?
		font_colour_select();
		
		?></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"  align="left" colspan="2">
			<table width="100%" border="0" cellpadding=0 cellspacing=0>
				<tr>
					<td align="left" width="100" class="admintext">Quantity:&nbsp;&nbsp;</td>
					<td class="admintext" align="left">
						<select name="quantity">
						<?
						for($i=0; $i<count($optionAr[3]); $i++)
						{
							echo "<option value=\"".$optionAr[3][$i][0].";".$optionAr[3][$i][1]."\">".$optionAr[3][$i][1]."</option>";
						} ?>
					</select>
					</td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="2"><? submitButton();?></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
}



function ziptags(){
	// get prices
	$query = "SELECT price FROM prices WHERE productID BETWEEN 22 AND 23 AND currencyInt=".$_COOKIE["currency"];
	$result = mysql_query($query);
	$numrows = mysql_num_rows($result);
	if(!$result) error_message(sql_error());
	$k = 1;	
	while($qdata = mysql_fetch_array($result)){
		$theprice = $qdata["price"];
		settype($theprice,"string");
		$price[$k]=$theprice;
		$k++;
	}

	$optionAr=getValues();
		$query = "SELECT * FROM currencies a, product b WHERE b.id BETWEEN 22 AND 23 AND a.id=".$_COOKIE["currency"];
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if(!$result) error_message(sql_error());
		$k = 1;	
		while($qdata = mysql_fetch_array($result)){
			$optionAr[$k] = $qdata["unitQuant"]." for ".$qdata["symbol"].$price[$k];
			$k++;
		}	
	
	
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<input type="hidden" name="type" value="22">
		<? validateForm();?>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" class="admintext"><strong>Zip Tags</strong></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2"><? addZiptagPicture(); ?></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext" align="left">
			<table cellpadding=0 cellspacing=0 border=0>
				<tr>
					<td align="left" width="100" class="admintext">Reverse text - Line 1</td>
					<td class="admintext" align="left"><input type="text" name="text1" value=""></td>
				</tr>
				<tr>
					<td align="left" width="100" class="admintext">Reverse text - Line 2</td>
					<td class="admintext" align="left"><input type="text" name="text2" value=""></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"  align="left" colspan="2">
			<table width="100%" border="0" cellpadding=0 cellspacing=0>
				<tr>
					<td align="left" width="100" class="admintext">Quantity:&nbsp;&nbsp;</td>
					<td class="admintext" align="left">
						<select name="quantity">
						<? echo "<option value=\"".$optionAr[1]."\">".$optionAr[1]."</option>";
						   echo "<option value=\"".$optionAr[2]."\">".$optionAr[2]."</option>";  ?>
              			</select>
					</td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td colspan="2"><? submitButton();?></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
}


function zipdedo()
{
	// get prices
	$query = "SELECT price FROM prices WHERE productID BETWEEN 28 AND 29 AND currencyInt=".$_COOKIE["currency"];
	$result = mysql_query($query);
	$numrows = mysql_num_rows($result);
	if(!$result) error_message(sql_error());
	$k = 1;	
	while($qdata = mysql_fetch_array($result)){
		$theprice = $qdata["price"];
		settype($theprice,"string");
		$price[$k]=$theprice;
		$k++;
	}

	$optionAr=getValues();
		$query = "SELECT * FROM currencies a, product b WHERE b.id BETWEEN 28 AND 29 AND a.id=".$_COOKIE["currency"];
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if(!$result) error_message(sql_error());
		$k = 1;	
		while($qdata = mysql_fetch_array($result)){
			$optionAr[$k] = $qdata["unitQuant"]." for ".$qdata["symbol"].$price[$k];
			$k++;
		}

	?>
	<script type="text/javascript">
	
	function validate_zipdedo(f)
	{
		if(document.forms[0].text1.value==""){
			alert('You must enter a name');
			return false;
		}else if(document.forms[0].text2.value=="" && document.forms[0].nophone && document.forms[0].nophone.checked==false){
			alert('You must enter a phone number, or select no phone');
			return false;
		}
		if(document.forms[0].quantdesc[0].selected)
		{
			document.forms[0].type.value = '28';
			document.forms[0].price.value = document.forms[0].price1.value;
		}
		else
		{
			document.forms[0].type.value = '29';
			document.forms[0].price.value = document.forms[0].price2.value;
		}
		
		return true;
	}
	
	</script>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validate_zipdedo(this);">
		<input type="hidden" name="type" value="">
		<input type="hidden" name="price1" value="<?= $price[1] ?>">
		<input type="hidden" name="price2" value="<?= $price[2] ?>">
		<input type="hidden" name="price" value="">
		<input type="hidden" name="font" value="3">
		<input type="hidden" name="picon" value="1">
		<input type="hidden" name="background_colour" value="8">
		<input type="hidden" name="font_colour" value="1">
		
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><h2 align="center"><strong>ZipDeDo Dots</strong></h1></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addName(true, true); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPhone(false); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
				<tr>
					<td align="left" width="100" class="admintext">Quantity:&nbsp;&nbsp;</td>
					<td class="admintext" align="left">
						<select name="quantdesc">
						<? echo "<option value=\"".$optionAr[1]."\">".$optionAr[1]."</option>";
						   echo "<option value=\"".$optionAr[2]."\">".$optionAr[2]."</option>";  ?>
              			</select>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
	
	
}

function shoe(){
	$optionAr=getValues();?>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<input type="hidden" name="type" value="4">
		<input type="hidden" name="font" value="3">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><strong>Shoe labels</strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">Font: 4</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addName(true, true); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPhone(false); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">Colours: Black &amp; White</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
			Quantity:&nbsp;
			<select name="quantity">
				<? for($i=0; $i<count($optionAr[4]); $i++){
					echo "<option value=\"".$optionAr[4][$i][0].";".$optionAr[4][$i][1]."\">".$optionAr[4][$i][1]."</option>";
				} ?>
			</select>
			</td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
}


function pencil(){
	$optionAr=getValues();?>
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<input type="hidden" name="type" value="5">
		<input type="hidden" name="font" value="3">
		<input type="hidden" name="pic" value="NULL">
		<? validateForm();?>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" class="admintext"><strong>Pencil labels</strong></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td  align="left" class="admintext">Font:</td>
			<td  align="left" class="admintext">4</td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td width="100" class="admintext" align="left">Name:</td>
			<td class="admintext" align="left"><input type="text" name="text1" value=""></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" class="admintext" align="left"><?
		background_colour_select('colour', true);
		
		?></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" class="admintext" align="left"><?
		font_colour_select();
		
		?></td>
		</tr>
		
		
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext" align="left">Quantity</td>
			<td align="left">
			<select name="quantity">
				<? for($i=0; $i<count($optionAr[5]); $i++){
					echo "<option value=\"".$optionAr[5][$i][0].";".$optionAr[5][$i][1]."\">".$optionAr[5][$i][1]."</option>";
				} ?>
			</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align="left"><? submitButton();?></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
}


function diylabel($type){
	$optionAr=getValues();?>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<input type="hidden" name="type" value="<? echo $type;?>">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><strong>DIY <? if($type==9){?>Large<? }else{?>Small<? }?></strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addFont(9); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addDiyText(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addColoursDef(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
			Quantity:&nbsp;
			<select name="quantity">
				<? for($i=0; $i<count($optionAr[$type]); $i++){
					echo "<option value=\"".$optionAr[$type][$i][0].";".$optionAr[$type][$i][1]."\">".$optionAr[$type][$i][1]."</option>";
				} ?>
			</select>
			</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	<?
}



function gift(){
	$optionAr=getValues();?>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post">
		<input type="hidden" name="type" value="13">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><strong>Gift Boxes</strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
			Quantity:&nbsp;
			<select name="quantity">
				<? for($i=0; $i<count($optionAr[13]); $i++){
					echo "<option value=\"".$optionAr[13][$i][0].";".$optionAr[13][$i][1]."\">".$optionAr[13][$i][1]."</option>";
				} ?>
			</select>
			</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
	</table>
<?
}




function kidcards(){
	$optionAr=getValues();?>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post">
		<input type="hidden" name="type" value="7">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><strong>KIDCARDS</strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addColoursBoysGirlsBoth(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
			Quantity:&nbsp;
			<select name="quantity">
				<? for($i=0; $i<count($optionAr[7]); $i++){
					echo "<option value=\"".$optionAr[7][$i][0].";".$optionAr[7][$i][1]."\">".$optionAr[7][$i][1]."</option>";
				} ?>
			</select>
			</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
	</table>
<?
}

function giftvoucher(){
	$optionAr=getValues();
	
	$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];

	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	while($qdata = mysql_fetch_array($result)){
		$symbol = $qdata["symbol"];
	}
	
	?>
	<script language="javascript">
		function AddVoucher(){
			//var new_item = document.createElement("OPTION");
			//new_item.text = document.forms.additem.item_name.value;
			//new_item.value = document.forms.additem.item_name.value;
			//document.forms.additem.orders.options.add(new_item);
			
			var OptionKey = "";
			var OptionValue = "";
			var LoopCounter = 0;
			
			if (document.forms.additem.VoucherStyle.value == ""){
				window.alert("Please select the Style of the voucher you require before proceeding.");
				document.forms.additem.VoucherStyle.focus();
			}else if ((document.forms.additem.VoucherQuantity.value == "") || (document.forms.additem.VoucherQuantity.value < 1)){
				window.alert("Please specify the number of vouchers you require before proceeding.");
				document.forms.additem.VoucherQuantity.focus();
			}else if ((document.forms.additem.VoucherValue.value == "") || (document.forms.additem.VoucherValue.value < 1)){
				window.alert("Please specify the value of the voucher before proceeding.");
				document.forms.additem.VoucherValue.focus();
			}else{
				if (document.forms.additem.VoucherValue.value.substr(0,1) == "$"){
					document.forms.additem.VoucherValue.value = document.forms.additem.VoucherValue.value.substr(1, document.forms.additem.VoucherValue.value.length);
				}
				
				document.forms.additem.VoucherValue.value = Math.round(document.forms.additem.VoucherValue.value);
				//if (document.forms.additem.VoucherQuantity.value > 1){
				//	str_voucher = "Vouchers";
				//}else{
				//	str_voucher = "Voucher";
				//}
				
				switch (document.forms.additem.VoucherStyle.value){
					case "baby":
						//OptionValue = document.forms.additem.VoucherQuantity.value + " x Baby " + str_voucher + " ($35 ea.)";
						document.forms.additem.QuantityList.options[document.forms.additem.QuantityList.options.length] = new Option(document.forms.additem.VoucherQuantity.value, "", false, false);
						document.forms.additem.StyleList.options[document.forms.additem.StyleList.options.length] = new Option(document.forms.additem.VoucherStyle.options[document.forms.additem.VoucherStyle.selectedIndex].text, "", false, false);
						document.forms.additem.ValueList.options[document.forms.additem.ValueList.options.length] = new Option("35", "", false, false);
						break;
					case "girl":
						//OptionValue = document.forms.additem.VoucherQuantity.value + " x Girl " + str_voucher + " ($" + document.forms.additem.VoucherValue.value + " ea.)";
						document.forms.additem.QuantityList.options[document.forms.additem.QuantityList.options.length] = new Option(document.forms.additem.VoucherQuantity.value, "", false, false);
						document.forms.additem.StyleList.options[document.forms.additem.StyleList.options.length] = new Option(document.forms.additem.VoucherStyle.options[document.forms.additem.VoucherStyle.selectedIndex].text, "", false, false);
						document.forms.additem.ValueList.options[document.forms.additem.ValueList.options.length] = new Option(document.forms.additem.VoucherValue.value, "", false, false);
						break;
					case "boy":
						//OptionValue = document.forms.additem.VoucherQuantity.value + " x Boy " + str_voucher + " ($" + document.forms.additem.VoucherValue.value + " ea.)";
						document.forms.additem.QuantityList.options[document.forms.additem.QuantityList.options.length] = new Option(document.forms.additem.VoucherQuantity.value, "", false, false);
						document.forms.additem.StyleList.options[document.forms.additem.StyleList.options.length] = new Option(document.forms.additem.VoucherStyle.options[document.forms.additem.VoucherStyle.selectedIndex].text, "", false, false);
						document.forms.additem.ValueList.options[document.forms.additem.ValueList.options.length] = new Option(document.forms.additem.VoucherValue.value, "", false, false);
						break;
				}
		
				//for (LoopCounter = 0; LoopCounter < document.forms.additem.orders.options.length; LoopCounter++){
					//window.alert(document.forms.additem.orders.options[LoopCounter].value);
					//window.alert(document.forms.additem.orders.options[LoopCounter].text);
					//if (document.forms.additem.orders.options[LoopCounter].value == ""){
						
					//}
				//}
				
				//OptionKey = OptionValue;
				
				//document.forms.additem.orders.options[document.forms.additem.orders.options.length] = new Option(OptionValue, OptionKey, false, false);
			
				ResizeList();
			}
		}
		
		function RemoveVoucher(){
			if ((document.forms.additem.QuantityList.length < 1) && (document.forms.additem.StyleList.length < 1) && (document.forms.additem.ValueList.length < 1)){
				window.alert("There do not seem to be any vouchers to remove at the moment.");
			}else if  ((document.forms.additem.QuantityList.selectedIndex < 0) && (document.forms.additem.StyleList.selectedIndex < 0) && (document.forms.additem.ValueList.selectedIndex < 0)){
				window.alert("Please ensure that at least one voucher is selected before you proceed.");
			}else{
				while ((document.forms.additem.QuantityList.selectedIndex >= 0) && (document.forms.additem.StyleList.selectedIndex >= 0) && (document.forms.additem.ValueList.selectedIndex >= 0)){
					document.forms.additem.QuantityList.options[document.forms.additem.QuantityList.selectedIndex] = null;
					document.forms.additem.StyleList.options[document.forms.additem.StyleList.selectedIndex] = null;
					document.forms.additem.ValueList.options[document.forms.additem.ValueList.selectedIndex] = null;
				}
				ResizeList();
			}
		}
		
		function UpdateForm(){
			document.forms.additem.VoucherQuantity.value = "";
			document.forms.additem.VoucherValue.value = "";
			document.forms.additem.VoucherValue.disabled = false;
			if (document.forms.additem.VoucherStyle.value == "baby"){
				document.forms.additem.VoucherValue.value = "35";
				document.forms.additem.VoucherValue.disabled = true;
			}
		}
		
		function ResizeList(){
			if ((document.forms.additem.QuantityList.options.length > 1) && (document.forms.additem.StyleList.options.length > 1) && (document.forms.additem.ValueList.options.length > 1)){
				document.forms.additem.QuantityList.size = document.forms.additem.QuantityList.options.length;
				document.forms.additem.StyleList.size = document.forms.additem.StyleList.options.length;
				document.forms.additem.ValueList.size = document.forms.additem.ValueList.options.length;
			}
		}
		
		function UpdateLists(SelectedList){
			if ((document.forms.additem.QuantityList.options.length > 0) && (document.forms.additem.StyleList.options.length > 0) && (document.forms.additem.ValueList.options.length > 0)){
				switch (SelectedList){
					case "Quantity":
						document.forms.additem.StyleList.selectedIndex = document.forms.additem.QuantityList.selectedIndex;
						document.forms.additem.ValueList.selectedIndex = document.forms.additem.QuantityList.selectedIndex;
						break;
					case "Style":
						document.forms.additem.QuantityList.selectedIndex = document.forms.additem.StyleList.selectedIndex;
						document.forms.additem.ValueList.selectedIndex = document.forms.additem.StyleList.selectedIndex;
						break;
					case "Value":
						document.forms.additem.QuantityList.selectedIndex = document.forms.additem.ValueList.selectedIndex;
						document.forms.additem.StyleList.selectedIndex = document.forms.additem.ValueList.selectedIndex;
						break;
				}
			}
		}
	</script>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
		<input type="hidden" name="type" value="15">
		<input type="hidden" name="symbol" value="<? echo $symbol;?>">
		<input type="hidden" name="cardsVal" value="">
		<input type="hidden" name="VoucherOrders" value="">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><strong>Gift Voucher</strong></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addgiftvoucher(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
}

function coloured_ironons()
{
	$type = 19;
	$optionAr=getValues();
	?>
	<script type="text/javascript">
	function change_background_colour(f)
	{
		
		// white font colour has the ID of 2
		if(f.font_colour[f.font_colour.selectedIndex].value == 2)
		{
			// white background has the ID of 8!
			if(f.colour[f.colour.selectedIndex].value == 8)
			{
				f.font_colour.selectedIndex = 0;
				alert("You have selected a background colour of white with a Font colour of white also\n\nThe Font colour has been changed to Black!");
				
			}
		}
			
		
	}
	
	function validate_coloured_ironons(f)
	{
		if(document.forms[0].text1.value==""){
			alert('You must enter a name');
			return false;
		}else if(document.forms[0].text2.value=="" && document.forms[0].nophone && document.forms[0].nophone.checked==false){
			alert('You must enter a phone number, or select no phone');
			return false;
		}
		return true;
	}
	
	</script>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validate_coloured_ironons(this);">
		<input type="hidden" name="type" value="<?= (int)$type; ?>">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><h2 align="center"><strong>Coloured Iron-on labels</strong></h1></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addFont($type); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addName(true, true); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPhone(false); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><?
		background_colour_select();
		
		?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><?
		font_colour_select();
		
		?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
					<tr>
						<td class="admintext" width="100">Quantity:&nbsp;&nbsp;</td>
						<td class="admintext" align="left"><select name="quantity">
							<? for($i=0; $i<count($optionAr[2]); $i++){
								echo "<option value=\"".$optionAr[$type][$i][0].";".$optionAr[$type][$i][1]."\">".$optionAr[$type][$i][1]."</option>";
							} ?>
						</select></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
	
	
}


function shoedots()
{
	$type = 20;
	$optionAr=getValues();
	?>
	<script type="text/javascript">
	function change_background_colour(f)
	{
		
		// white font colour has the ID of 2
		if(f.font_colour[f.font_colour.selectedIndex].value == 2)
		{
			// white background has the ID of 8!
			if(f.colour[f.colour.selectedIndex].value == 8)
			{
				f.font_colour.selectedIndex = 0;
				alert("You have selected a background colour of white with a Font colour of white also\n\nThe Font colour has been changed to Black!");
				
			}
		}
			
		
	}
	
	function validate_shoedots(f)
	{
		if(document.forms[0].text1.value==""){
			alert('You must enter a name');
			return false;
		}else if(document.forms[0].text2.value=="" && document.forms[0].nophone && document.forms[0].nophone.checked==false){
			alert('You must enter a phone number, or select no phone');
			return false;
		}
		return true;
	}
	
	</script>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validate_shoedots(this);">
		<input type="hidden" name="type" value="<?= (int)$type; ?>">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><h2 align="center"><strong>Shoe Dots</strong></h1></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addFont($type); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addName(true, true); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPhone(false); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><?
		background_colour_select();
		
		?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><?
		font_colour_select();
		
		?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
					<tr>
						<td class="admintext" width="100">Quantity:&nbsp;&nbsp;</td>
						<td class="admintext" align="left"><select name="quantity">
							<? for($i=0; $i<count($optionAr[2]); $i++){
								echo "<option value=\"".$optionAr[$type][$i][0].";".$optionAr[$type][$i][1]."\">".$optionAr[$type][$i][1]."</option>";
							} ?>
						</select></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
	
	
}


function colour_my_world_pack()
{
	$type = 21;
	$optionAr=getValues();
	?>
	<script type="text/javascript">
	function change_background_colour(f)
	{
		
		// white font colour has the ID of 2
		if(f.font_colour[f.font_colour.selectedIndex].value == 2)
		{
			// white background has the ID of 8!
			if(f.colour[f.colour.selectedIndex].value == 8)
			{
				f.font_colour.selectedIndex = 0;
				alert("You have selected a background colour of white with a Font colour of white also\n\nThe Font colour has been changed to Black!");
				
			}
		}
			
		
	}
	
	function validate_shoedots(f)
	{
		if(document.forms[0].text1.value==""){
			alert('You must enter a name');
			return false;
		}else if(document.forms[0].text2.value=="" && document.forms[0].nophone && document.forms[0].nophone.checked==false){
			alert('You must enter a phone number, or select no phone');
			return false;
		}
		return true;
	}
	
	</script>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validate_shoedots(this);">
		<input type="hidden" name="type" value="<?= (int)$type; ?>">
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><h2 align="center"><strong>Colour My World Pack</strong></h1></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addFont($type); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addName(true, true); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPhone(false); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		
		<tr>
			<td class="admintext"><b>Vinyl, Mini's & shoe dots background colour</b>
				<br> <input type="radio" name="colours" value="1">&nbsp;Tomato Red&nbsp;&nbsp;<input type="radio" name="colours" value="2" checked>&nbsp;Sky Blue
				<br><input type="radio" name="colours" value="3" checked>&nbsp;Sunny Yellow&nbsp;&nbsp;<input type="radio" name="colours" value="4" checked>&nbsp;Zesty Orange
				<br><input type="radio" name="colours" value="5" checked>&nbsp;Kiwi Lime&nbsp;&nbsp;<input type="radio" name="colours" value="6" checked>&nbsp;Lavendar
				<br><input type="radio" name="colours" value="7" checked>&nbsp;Hot Pink&nbsp;&nbsp;<input type="radio" name="colours" value="8" checked>&nbsp;White
				<br><input type="radio" name="colours" value="9" checked>
              Rainbow A&nbsp;&nbsp; 
              <input type="radio" name="colours" value="10" checked>
              Rainbow B</td>
		</tr>
		
		
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><b>Print Colour</b><br /><?
			
		font_colour_select('data_font_colour_id');
		
		?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><b>Iron-on's Background Colour</b>
				<?
				background_colour_select('data_colour_id');
		
		?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><? add_identitag('data_identitag_id');?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
				</tr>
				<tr>
					<td class="admintext" width="100">Pencil or Mini's:&nbsp;&nbsp;</td>
					<td class="admintext" align="left"><select name="pencil_or_mini">
						<option value="5">Pencil Labels</option>
						<option value="3">Mini Labels</option>
						</select></td>
				</tr>
			</table>
			
			
			
		  </td>
		</tr>
		
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
					<tr>
						<td class="admintext" width="100">Quantity:&nbsp;&nbsp;</td>
						<td class="admintext" align="left"><select name="quantity">
							<? for($i=0; $i<count($optionAr[2]); $i++){
								echo "<option value=\"".$optionAr[$type][$i][0].";".$optionAr[$type][$i][1]."\">".$optionAr[$type][$i][1]."</option>";
							} ?>
						</select></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
	
	
}

function book_labels()
{
	$type = 33;
	$optionAr=getValues();
	?>
	<script type="text/javascript">
	function change_background_colour(f)
	{
		
		// white font colour has the ID of 2
		if(f.font_colour[f.font_colour.selectedIndex].value == 2)
		{
			// white background has the ID of 8!
			if(f.colour[f.colour.selectedIndex].value == 8)
			{
				f.font_colour.selectedIndex = 0;
				alert("You have selected a background colour of white with a Font colour of white also\n\nThe Font colour has been changed to Black!");
				
			}
		}
			
		
	}
	
	function validate_book_labels(f)
	{
		if(document.forms[0].text1.value==""){
			alert('You must enter a name');
			return false;
		}
		return true;
	}
	
	</script>
	<table cellpadding="0" cellspacing="0" border="0">
		<form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validate_book_labels(this);">
		<input type="hidden" name="type" value="<?= (int)$type; ?>">
		<?
		$sql = "SELECT *
					FROM currencies
					WHERE  id=".$_COOKIE["currency"];
		$result = db_query($sql);
		$record = db_fetch_array($result);
		?>
		<input type="hidden" name="symbol" value="<?= $record['symbol'] ?>">		
		<? validateForm();?>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext"><h2 align="center"><strong>Book Labels</strong></h1></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? //addFont($type); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addPicture(); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? addName(true, false); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><? //addPhone(false); ?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		
		<tr>
			<td class="admintext"><b>Background colours: </b>
				<input type="radio" name="colours" value="9" checked>Set A&nbsp;&nbsp; 
                <input type="radio" name="colours" value="10" >Set B
			</td>
		</tr>
		
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
					</tr>
					<tr>
						<td class="admintext" width="100">Quantity:&nbsp;&nbsp;</td>
						<td class="admintext" align="left"><select name="quantity">
							<? for($i=0; $i<count($optionAr[2]); $i++){
								echo "<option value=\"".$optionAr[$type][$i][0]."\">".$optionAr[$type][$i][1]."</option>";
							} ?>
						</select></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><? submitButton();?></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		</form>
	</table>
	<?
	
	
}

function maxi_pack()
{
	$type = 34;
	
	?>
	<script language="JavaScript">
		function change_background_colour(){
			return true;
		}
	</script>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
    <? validateForm();?>
    <input type="hidden" name="type" value="34">
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td colspan="2" class="admintext"><h2>Maxi Pack</h2></td>
    </tr>
    <tr>
      <td height="5" colspan="2" class="admintext">&nbsp;</td>
    </tr>
    <tr>
      <td height="5" colspan="2" class="admintext">
	  		<table border="0" cellpadding="0" cellspacing="0">
				<tr><td colspan="2"><h3>1. Vinyl</h3></td></tr>
				<tr><td align="left">Name:</td><td align="left"><input type="text" name="maxi_pack1_name">&nbsp;<input type="checkbox" name="maxi_pack1_split">Split</td></tr>
				<tr><td align="left">Phone:</td><td align="left"><input type="text" name="maxi_pack1_phone"></td></tr>
				<tr><td>Picture:</td><td><? addPicture("maxi_pack1_")?></td></tr>
				<tr><td colspan="2"><? font_colour_select("maxi_pack1_font_colour")?></td></tr>
				<tr><td colspan="2"><? background_colour_select("maxi_pack1_background_colour",true,false)?></td></tr>
			</table>
    </tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
     <tr>
      <td height="5" colspan="2" class="admintext">
	  		<table border="0" cellpadding="0" cellspacing="0">
				<tr><td colspan="2"><h3>2. Mini's</h3></td></tr>
				<tr><td>Picture:</td><td class="admintext">Same as Vinyl</td></tr>
				<tr><td>Font Colour:</td><td class="admintext">Same as Vinyl</td></tr>
				<tr><td>Background Colour:</td><td class="admintext">Same as Vinyl</td></tr>
			</table>
    </tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
    <tr>
      <td height="5" colspan="2" class="admintext">
	  		<table border="0" cellpadding="0" cellspacing="0">
				<tr><td colspan="2"><h3>3. ZipDeDo Dots</h3></td></tr>
				<!--
				<tr><td>Picture:</td><td><? addPicture("maxi_pack2_")?></td></tr>
				<tr><td colspan="2"><? font_colour_select("maxi_pack2_font_colour")?></td></tr>
				<tr><td colspan="2"><? background_colour_select("maxi_pack2_background_colour",false,false)?></td></tr>
				-->
				<tr><td>Picture:</td><td class="admintext">Same as Vinyl<input type="hidden" name="maxi_pack2_pic" value="99"></td></tr>
				<tr><td>Font Colour:</td><td class="admintext">Black<input type="hidden" name="maxi_pack2_font_colour" value="1"></td></tr>
				<tr><td>Background Colour:</td><td class="admintext">White<!--<input type="hidden" name="maxi_pack2_background_colour" value="8">--></td></tr>
			</table>
    </tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
     <tr>
      <td height="5" colspan="2" class="admintext">
	  		<table border="0" cellpadding="0" cellspacing="0">
				<tr><td colspan="2"><h3>4. Shoe Dots</h3></td></tr>
				<tr><td>Picture:</td><td class="admintext">Same as Vinyl</td></tr>
				<tr><td>Font Colour:</td><td class="admintext">Black</td></tr>
				<tr><td colspan="2"><? background_colour_select("maxi_pack2_background_colour",false,false)?></td></tr>
			</table>
    </tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
	<tr>
      <td height="5" colspan="2" class="admintext">
	  		<table border="0" cellpadding="0" cellspacing="0">
				<tr><td colspan="2"><h3>5. Iron Ons</h3></td></tr>
				<!--
				<tr><td>Picture:</td><td><? addPicture("maxi_pack3_")?></td></tr>
				<tr><td colspan="2"><? font_colour_select("maxi_pack3_font_colour")?></td></tr>
				-->
				<tr><td>Picture:</td><td class="admintext">Same as Vinyl<input type="hidden" name="maxi_pack3_pic" value="99"></td></tr>
				<tr><td>Font Colour:</td><td class="admintext">Black<input type="hidden" name="maxi_pack3_font_colour" value="1"></td></tr>
				<tr><td colspan="2"><? background_colour_select("maxi_pack3_background_colour",true,false)?></td></tr>
			</table>
    </tr>
    <tr>
      <td height="5" colspan="2"  class="admintext">Semi-permanent:&nbsp;<input type="checkbox" name="maxi_pack3_vsemiPermanent"></td>
    </tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
     <tr>
      <td height="5" colspan="2" class="admintext">
	  		<table border="0" cellpadding="0" cellspacing="0">
				<tr><td colspan="2"><h3>6. IdentiTag</h3></td></tr>
				<tr><td colspan="2"><? addIdentitagPicture("maxi_pack_identitag_")?></td></tr>
			</table>
    </tr>
     <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
     <tr>
      <td height="5" colspan="2" class="admintext">
	  		<table border="0" cellpadding="0" cellspacing="0">
				<tr><td colspan="2"><h3>7. IdentiBand</h3></td></tr>
				<tr><td colspan="2"><? addIdentibandPicture("maxi_pack_identiband_")?></td></tr>
			</table>
    </tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
    <tr><td height="5" colspan="2" class="admintext">&nbsp;</td></tr>
     <tr>
      <td height="5" colspan="2" class="admintext">
	  		<table border="0" cellpadding="0" cellspacing="0">
				<tr><td colspan="2"><h3>8. Zip Tag</h3></td></tr>
				<tr><td colspan="2"><? addZiptagPicture("maxi_pack_ziptag_")?></td></tr>
			</table>
    </tr>
    <tr>
      <td height="5" colspan="2" class="admintext">&nbsp;</td>
    </tr>
  <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td colspan="2">
        <? submitButton();?>
      </td>
    </tr>
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
  </form>
</table>
	<?
	
	
}

function address_labels(){
	// get prices
	$query = "SELECT price FROM prices WHERE productID BETWEEN 24 AND 26 AND currencyInt=".$_COOKIE["currency"];
	$result = mysql_query($query);
	$numrows = mysql_num_rows($result);
	if(!$result) error_message(sql_error());
	$k = 1;	
	while($qdata = mysql_fetch_array($result)){
		$theprice = $qdata["price"];
		settype($theprice,"string");
		$price[$k]=$theprice;
		$k++;
	}

	$optionAr=getValues();
		$query = "SELECT * FROM currencies a, product b WHERE b.id BETWEEN 24 AND 26 AND a.id=".$_COOKIE["currency"];
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if(!$result) error_message(sql_error());
		$k = 1;	
		while($qdata = mysql_fetch_array($result)){
			$optionAr[$k] = $qdata["unitQuant"]." for ".$qdata["symbol"].$price[$k];
			$k++;
		}	
	
	
	?>
	
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <form name="additem" action="addphoneorder_additem.php" method="post" onSubmit="return validateForm();">
    <input type="hidden" name="type" value="24">
    <? validateForm();?>
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td colspan="2" class="admintext"><strong>Address Label</strong></td>
    </tr>
    <tr>
      <td height="5" colspan="2" class="admintext"></td>
    </tr>
    <tr>
      <td colspan="2" class="admintext"><img src="../images/address_labels_sample.gif" width="200" height="89"></td>
    </tr>
    <tr>
      <td height="5" colspan="2" class="admintext"></td>
    </tr>
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td colspan="2">
        <? addPicture(); ?>
      </td>
    </tr>
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext" align="left"> <table width="560" border=0 cellpadding=0 cellspacing=3>
<tr> 
            <td colspan="2" align="left" class="admintext"><strong>Name</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input type="text" name="text1" value=""> </td>
          </tr>
          <tr> 
            <td colspan="2" align="left" class="admintext"><strong>Address Line 
              1</strong>&nbsp;&nbsp;&nbsp; 
<input type="text" name="text2" value=""> </td>
          </tr>
          <tr> 
            <td colspan="2" align="left" class="admintext"><strong>Address Line 
              2</strong> &nbsp;&nbsp; 
<input type="text" name="text3" value=""> </td>
          </tr>
          <tr> 
            <td colspan="2" align="left" class="admintext"><strong>Address Line 
              3</strong> &nbsp;&nbsp; 
<input type="text" name="text4" value=""> 
            </td>
          </tr>
          <tr valign="middle"> 
            <td width="70" align="left" class="admintext">&nbsp;</td>
            <td align="left" class="admintext">&nbsp;</td>
          </tr>
          <tr valign="middle"> 
            <td colspan="2" align="left" class="admintext"><strong>Colour:</strong></td>
          </tr>
          <tr valign="middle"> 
            <td colspan="2" align="left" class="admintext"> <input name="colourchoice" type="radio" value="hot pink" checked> 
              <img src="images/addresslabel_colours/1.gif" width="32" height="31"> 
              &nbsp; <input type="radio" name="colourchoice" value="lavender"> 
              <img src="images/addresslabel_colours/2.gif" width="32" height="31"> 
              &nbsp; <input type="radio" name="colourchoice" value="navy blue"> 
              <img src="images/addresslabel_colours/3.gif" width="32" height="31">&nbsp; 
              &nbsp; <input type="radio" name="colourchoice" value="kiwi lime"> 
              <img src="images/addresslabel_colours/4.gif" width="32" height="31"> 
              &nbsp;&nbsp; <input type="radio" name="colourchoice" value="zesty orange"> 
              <img src="images/addresslabel_colours/5.gif" width="31" height="31">&nbsp;&nbsp; 
              <input type="radio" name="colourchoice" value="sky blue"> <img src="images/addresslabel_colours/6.gif" width="32" height="31"> 
              &nbsp;&nbsp; <input type="radio" name="colourchoice" value="tomato red"> 
              <img src="images/addresslabel_colours/7.gif" width="32" height="31"> 
              &nbsp;&nbsp; <input type="radio" name="colourchoice" value="black"> 
              <img src="images/addresslabel_colours/8.gif" width="32" height="31"></td>
          </tr>
          <tr> 
            <td colspan="2" align="left" class="admintext">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext"  align="left" colspan="2"> <table width="100%" border="0" cellpadding=0 cellspacing=0>
          <tr> 
            <td align="left" width="100" class="admintext"><strong>Quantity:</strong>&nbsp;&nbsp;</td>
            <td class="admintext" align="left"> <select name="quantity">
                <? echo "<option value=\"".$optionAr[1]."\">".$optionAr[1]."</option>";
						   echo "<option value=\"".$optionAr[2]."\">".$optionAr[2]."</option>";  
 						   echo "<option value=\"".$optionAr[3]."\">".$optionAr[3]."</option>";?> 
              </select> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="2">
        <? submitButton();?>
      </td>
    </tr>
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
  </form>
</table>
	<?
}

function custom_label()
{?>
<table width="600" border="0" cellpadding="0" cellspacing="3">
  <tr> 
    <td class="admintext">&nbsp;</td>
    <td colspan="2" class="admintext"><h2><strong>Custom Label</strong></h2></td>
  </tr>
  <form name="additem" action="addphoneorder_additem.php" method="post" enctype="multipart/form-data">
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"><strong>Quantitiy Description 
          (20 Custom Labels):</strong></div></td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"> 
          <input name="quantdesc" type="text" id="quantdesc" size="60">
        </div></td>
    </tr>
    <tr> 
      <td class="admintext"><input name="type" type="hidden" value="27"></td>
      <td height="5" colspan="2" class="admintext"></td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"><strong>Colour:</strong></div></td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"> 
          <input name="colour" type="text" id="colour" size="30">
        </div></td>
    </tr>
    <tr> 
      <td class="admintext"></td>
      <td height="5" colspan="2" class="admintext"></td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"><strong>Size:</strong></div></td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"> 
          <input name="size" type="text" id="size" size="30">
        </div></td>
    </tr>
    <tr> 
      <td class="admintext"></td>
      <td height="5" colspan="2" class="admintext"></td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"><strong>Material:</strong></div></td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"> 
          <input name="material" type="text" id="material" size="30">
        </div></td>
    </tr>
    <!--<tr>
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"><strong>Special Requirements:</strong></div></td>
    </tr>
    <tr>
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"><strong> 
          <textarea name="details" cols="30" rows="5"></textarea>
          </strong></div></td>
    </tr>-->
    <tr> 
      <td class="admintext"></td>
      <td height="5" colspan="2" class="admintext"></td>
    </tr>
    <tr> 
      <td width="20" class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"><strong>Price:</strong></div></td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"> 
          <input name="price" type="text" id="price" size="30">
        </div></td>
    </tr>
    <tr> 
      <td class="admintext"></td>
      <td height="5" colspan="2" class="admintext"></td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"><strong>Delivery Instructions:</strong></div></td>
    </tr>
    <tr> 
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"> 
          <input name="delivery" type="text" id="quantdesc3" size="60">
        </div></td>
    </tr>
	    <tr> 
      <td class="admintext"></td>
      <td height="5" colspan="2" class="admintext"></td>
    </tr>
    <tr>
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left"><strong>Attach file:</strong></div></td>
    </tr>
    <tr>
      <td class="admintext">&nbsp;</td>
      <td colspan="2" class="admintext"><div align="left">
          <input name="document_db_id_1" type="file" id="document_db_id_1">
          &nbsp;</div></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="2">&nbsp; </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="2"> 
        <? submitButton();?>
      </td>
    </tr>
  </form>
</table>

<?PHP
}
// Identi Bands
function identiband(){
	// get prices
	$query = "SELECT price FROM prices WHERE productID BETWEEN 30 AND 32 AND currencyInt=".$_COOKIE["currency"];
	$result = mysql_query($query);
	$numrows = mysql_num_rows($result);
	if(!$result) error_message(sql_error());
	$k = 1;	
	while($qdata = mysql_fetch_array($result)){
		$theprice = $qdata["price"];
		settype($theprice,"string");
		$price[$k]=$theprice;
		$k++;
	}

	$optionAr=getValues();
		$query = "SELECT * FROM currencies a, product b WHERE b.id BETWEEN 30 AND 32 AND a.id=".$_COOKIE["currency"];
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if(!$result) error_message(sql_error());
		$k = 1;	
		while($qdata = mysql_fetch_array($result)){
			$optionAr[$k] = $qdata["unitQuant"]." for ".$qdata["symbol"].$price[$k];
			$k++;
		}	
	
	?>
<script>
	//var myRequest = getXMLHTTPRequest();
	function setupForm() {
		document.additem.design1.disabled=true;
		document.additem.design2.disabled=true;
		document.additem.design3.disabled=true;
		document.additem.design4.disabled=true;
	}
	
	function adjustForm() {
		var quantity = document.additem.quantity.value;
		
		for (var i=1; i<quantity; i++)
		{	
			document.getElementById("design"+i).disabled=false;
		}
		for (var i=4; i>=quantity; i--)
		{	
			document.getElementById("design"+i).disabled=true;
		}
		
	}
</script>	
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <form name="additem" action="addphoneorder_additem.php" method="post">
    <input type="hidden" name="type" value="30">
    <? //validateForm();?>
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td colspan="2" class="admintext"><strong>Identi Bands</strong></td>
    </tr>
    <tr>
      <td height="5" colspan="2" class="admintext"></td>
    </tr>
    <tr>
      <td colspan="2" class="admintext"><div align="center"><img src="images/identi_bands.gif" width="548" height="238" /></div></td>
    </tr>
    <tr>
      <td height="5" colspan="2" class="admintext"></td>
    </tr>
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext" align="left"> <table width="100%" border=0 cellpadding=0 cellspacing=3>
<tr>
  <td width="20" align="left" class="admintext">&nbsp;</td> 
            <td colspan="2" align="left" class="admintext"><strong>Number of Packs:</strong>
              <select name="quantity" id="quantity" onChange="adjustForm()">
              <option value="1" SELECTED>1 Lot (10 Bands 1 design)</option>
              <option value="2">2 Lots (20 Bands 2 designs)</option>
              <option value="5">5 Lots (50 Bands 5 designs)</option>
              </select></td>
          </tr>
          
          
          <tr>
            <td align="left" class="admintext">&nbsp;</td> 
            <td colspan="2" align="left" class="admintext">&nbsp;</td>
          </tr>
          <tr valign="middle">
            <td align="left" class="admintext">&nbsp;</td>
            <td colspan="2" align="left" class="admintext"><table width="100%" border="0" cellpadding="3">
              
		<? for ($i=0; $i<=4; $i++)
			{ 
			$design = "design".$i; 
			?>
              <tr>
                <td width="100"><strong>Design<? echo $i + 1; ?> : </strong></td>
                <td><label>
                  <select name="<?= $design ?>" id="<?= $design ?>">
                    <option value="U" SELECTED>U - Pink Ballerina</option>
                    <option value="Y">Y - Surfer Guy</option>
                    <option value="R">R - Truck</option>
                    <option value="A1">A1 - Cow</option>
                    <option value="D1">D1 - Surfer Girl</option>
                    <option value="Q">Q - Mermaid</option>
                    <option value="F1">F1 - Rocket</option>
                    <option value="N">N - Fairy</option>
                    <option value="H">H - Butterfly</option>
                    <option value="Z">Z - Pirate</option>
                    <option value="G1">G1 - Bear</option>
                    <option value="F">F - Nurse (Medical)</option>
                  </select>
                </label></td>
              </tr>
             <? } ?>
            </table></td>
          </tr>
          
          <tr valign="middle">
            <td align="left" class="admintext">&nbsp;</td> 
            <td colspan="2" align="left" class="admintext">&nbsp;</td>
          </tr>
          <tr valign="middle">
            <td align="left" class="admintext">&nbsp;</td> 
            <td colspan="2" align="left" class="admintext">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" class="admintext">&nbsp;</td> 
            <td colspan="2" align="left" class="admintext">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
    </tr>
    <tr> 
      <td class="admintext"  align="left" colspan="2">&nbsp; </td>
    </tr>
    <tr> 
      <td colspan="2">
        <? submitButton();?>      </td>
    </tr>
    <tr> 
      <td colspan="2"><img src="../images/spacer_trans.gif" height="5" width="1" border="0" onLoad="setupForm()"></td>
    </tr>
  </form>
</table>
	<?
}

?>