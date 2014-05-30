<?

if(!isset($useractions)){
	$includeabove = true;
	include("../useractions.php");
}

linkme();

session_start();
$user_section_id = 1;
require_once("./security.php");
check_access($user_section_id);

if(!isset($_COOKIE["currency"])){
	// default to AU dollars
	//setcookie("currency", 1, time()+3600);
	setcookie("currency", 1);
	$currency = 1;
}else{
	$currency = $_COOKIE["currency"];
}

//echo "COOKIE=".$_COOKIE['currency'];

function getRealFontNumber($number){
	if($number==1 || $number==6){
		return $number;
	}else if($number==2){
		return 5;
	}else if($number==3){
		return 4;
	}else if($number==4){
		return 3;
	}else if($number==5){
		return 2;
	}
}

$fromadmin=true;
$id = checkOrderId(true, $_GET['neworder']);

$query = "SELECT * FROM currencies";
$result = mysql_query($query);
if(!$result) error_message(sql_error());

$cur = array();
while($qdata = mysql_fetch_array($result)){
	$cur[$qdata["id"]] = array();
	$cur[$qdata["id"]]["currName"]=$qdata["currName"];
	$cur[$qdata["id"]]["symbol"]=$qdata["symbol"];
}

$query = "SELECT * FROM currencies WHERE id=".$currency;
$result = mysql_query($query);
if(!$result) error_message(sql_error());


$thiscur = mysql_fetch_assoc($result);

if($id!=false){
	$query = "SELECT * FROM basket_items bi
		LEFT JOIN data_font_colour dfc ON (dfc.data_font_colour_id=bi.data_font_colour_id)
		LEFT JOIN data_identitag di ON (di.data_identitag_id=bi.data_identitag_id)
		LEFT JOIN data_colour dc ON (dc.data_colour_id=bi.data_colour_id)
		WHERE ordernumber=".$id;
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
}

$codebase = "http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0";
$pluginspace = "http://www.macromedia.com/go/getflashplayer";


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - add phone or fax order</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">

<style>
	input, select {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
	}
</style>

<script language="javascript">
function addItem(type, startrecord, showperpage){
	location.href='addphoneorder_item.php?type='+type+'&startrecord='+startrecord+'&showperpage='+showperpage;
}

function confirmDelete(){
	if(window.confirm('really delete all the current labels and return to admin main page?')){
		location.href='deleteorder.php?id='+document.forms.cancelorsubmit.id.value;
	}
}

function confirmItemDelete(itemId){
	if(window.confirm('Really delete this item?')){
		location.href='addphoneorder_deleteitem.php?itemid='+itemId;
	}
}
</script>

<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td valign="top" align="center">
				<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9">
        <tr> 
          <td bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="1" width="600" border="0"></td>
        </tr>
        <form name="currency" action="addphoneorder_currency.php" method="post">
          <tr> 
            <td valign="top" align="center" class="smalltext"> Currency (changing 
              will lose current order details): 
              <select name="currency">
                <? 
								foreach($cur as $key => $val){?>
                <option value="<? echo $key;?>"<? if($_COOKIE["currency"]==$key){?> selected<? }?>><? echo $val['currName'];?></option>
                <? }?>
              </select> <input type="submit" value="set &gt;"> </td>
          </tr>
        </form>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td align="center"><input type="button" name="" value="New Vinyl/Bagtag/Mixed/Birthday/Starter" onClick="addItem('vinyl', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td align="center"><input type="button" name="" value="New Shared Pack" onClick="addItem('shared', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"> 
            &nbsp; <input type="button" name="" value="New Allergy Alert" onClick="addItem('allergy', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td align="center"><input type="button" name="" value="New DIY Large" onClick="addItem('diylarge', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"> 
            &nbsp; <input type="button" name="" value="New DIY Small" onClick="addItem('diysmall', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"> 
            &nbsp; <input type="button" name="" value="New Iron On" onClick="addItem('iron');"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td align="center"><input type="button" name="Input" value="New Mini Label" onClick="addItem('mini', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"> 
            &nbsp; <input type="button" name="" value="New Shoe Label" onClick="addItem('shoe', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"> 
            &nbsp; <input type="button" name="" value="New Pencil Label" onClick="addItem('pencil', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td align="center"><input type="button" name="" value="Add Gift Boxes" onClick="addItem('gift', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"> 
            &nbsp; <input type="button" name="" value="Add Kidcards" onClick="addItem('kidcards', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"> 
            &nbsp; <input type="button" name="" value="Add Book Labels" onClick="addItem('booklabels', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          	<td align="center">
		  		<input type="button" name="" value="Add identiBANDS" onClick="addItem('identiBANDS', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');">
				&nbsp; <input type="button" name="" value="Add identiTAGS" onClick="addItem('identiTAGS', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');">
			</td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td align="center"><input type="button" name="" value="Add Gift Voucher" onClick="addItem('giftvoucher', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"> 
            &nbsp; <input type="button" name="Input" value="Zip Tags" onClick="addItem('ziptags', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');">
            &nbsp;
            <input type="button" name="" value="Zipdedo Dots" onClick="addItem('zipdedo', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          	<td align="center">
				&nbsp; <input type="button" name="Input" value="Add Address Label" onClick="addItem('addresslabels', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');">
				&nbsp; <input type="button" name="Input2" value="Add New Baby Pack" onClick="addItem('newbabypack', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');">
				&nbsp; <input type="button" name="Input3" value="Add Maxi Pack" onClick="addItem('maxipack', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');">
			</td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
        </tr>
        <tr> 
          <td align="center"><input type="button" name="" value="Add Coloured IronOns" onClick="addItem('coloured-ironons', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"> 
            &nbsp; <input type="button" name="" value="Add Shoe Dots" onClick="addItem('shoedots', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"> 
            &nbsp; <input type="button" name="" value="Add World Pack" onClick="addItem('worldpack', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');"></td>
        </tr>
        <tr>
          <td height="5" align="center"></td>
        </tr>
        <tr> 
          <td align="center"><input name="Custom" type="button" id="Custom" onClick="addItem('customlabel', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');" value="Add Custom Label">&nbsp;
          <!-- <input name="Custom2" type="button" id="Custom2" onClick="addItem('identiband', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');" value="Add Identi Band">-->
		  </td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
        </tr>
        <tr> 
          <td align="center">
            <input name="Thingamejig_Name_Bracelet" type="button" id="Thingamejig_Name_Bracelet" onClick="addItem('thingamejig_name_bracelet', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');" value="Add Thingamejig Name Bracelet">&nbsp;
		      <input name="Thingamejig_Boybandz" type="button" id="Thingamejig_Boybandz" onClick="addItem('thingamejig_boybandz', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');" value="Add Thingamejig Boybandz">&nbsp;
		    </td>
        </tr>
       <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td align="center">
            <input name="Thingamejig_Pet_Collars" type="button" id="Thingamejig_Pet_Collars" onClick="addItem('thingamejig_collar', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');" value="Add Thingamejig Pet Collars">&nbsp;
		      <input name="Thingamejig_Gadget_Straps" type="button" id="Thingameji_Gadget_Straps" onClick="addItem('thingamejig_gadget', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');" value="Add Thingamejig Gadget Straps">&nbsp;
		    </td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
        </tr>
        <tr> 
          <td align="center">
            <input name="Magpie_Eyes" type="button" id="Magpie_Eyes" onClick="addItem('magpie_eyes', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');" value="Add Magpie Eyes">&nbsp;
		     </td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
        </tr>
        <tr> 
          <td align="center">
            <input name="Bin_Labels" type="button" id="Bin_Labels" onClick="addItem('bin_labels', '<? echo $_GET["startrecord"];?>', '<? echo $_GET["showperpage"];?>');" value="Add Bin Labels">&nbsp;
		     </td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <form name="cancelorsubmit" action="" method="post">
          <tr> 
            <td align="center"> <input type="hidden" name="id" value="<? echo $id;?>"> 
              <? if(mysql_num_rows($result)>0){ ?>
              <input type="button" onClick="confirmDelete();" name="" value="< Cancel and Delete Order"> 
              <? }else{?>
              <input type="button" name="" value="< Back" onClick="location.href='deleteorder.php?id='+document.forms.cancelorsubmit.id.value;"> 
              <? }?>
              &nbsp; <input type="button" name="" value="Add customer details >" onClick="location.href='addphoneorder_customerdetails.php'"></td>
          </tr>
        </form>
        <tr> 
          <td align="center"><a style="color: #FFFFFF; text-decoration: none;" href="orders_admin.php">Return to Order List</a></td>
        </tr>
       <tr> 
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td align="center" class="admintext"> <b>Order so far:</b> </td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <?
					$runningtotal=0;
						if(mysql_num_rows($result)>0){
							while($qdata = mysql_fetch_array($result)){
							$runningtotal+=$qdata["price"];
							?>
        <tr> 
          <td class="admintext" align="center"> <strong><?php if ($qdata["type"]!= 30) echo getLabelType($qdata["type"]); ?></strong> 
            <?				// VINYL LABELS
							if($qdata['type']==1 || $qdata['type']==10 || $qdata['type']==11 || $qdata['type']==12){
								// Pack descriptions
								if ($qdata['type']==1) // vinyl
									echo "<BR />".$qdata['quantdesc']."<BR /><BR />";
								elseif ($qdata['type']==11) // mixed pack
									echo "<BR />30 vinyl name labels and 30 iron-ons<BR /><BR />";
								elseif($qdata['type']==12) // birthday pack
									echo "<BR />30 vinyls, 30 iron-ons, 1 Identitag, Gift card Matching Ribbon <BR /><BR />";
								elseif($qdata['type']==10) // starter pack
									echo "<BR />40 vinyls 40 iron-ons 20 shoe labels 1 identiTag 30 mini labels or 60 pencil labels <BR /><BR />";
								
								$width = "300";
								$height = "100";
								//$width*=2;
								//$height*=2;
								$swfstring = "?type=".$qdata["type"]."&colour=".$qdata["colours"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"]."&fontcolour=".$qdata["data_font_colour_id"];
								?>
								<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
								 codebase="<? echo $codebase;?>"
								 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
								 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_vinyl_new.swf<? echo $swfstring;?>">
								 <PARAM NAME=quality VALUE=high>
								 <PARAM NAME=bgcolor VALUE=#FFFFFF>
								 <EMBED src="<? echo $aim;?>../images/display_vinyl_new.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
								 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
								</OBJECT>
								<?php
								// Mixed/Birthday pack details
								if ($qdata['type']==11 || $qdata['type']==12)
								{
									if ($qdata["text3"] == 1){ //61266 semi permanent iron on
										$width = "180";
										$height = "54";
										if($from=="admin"){
											$width*=2;
											$height*=2;
										}
										$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"].
										"&text1=".urlencode($qdata["text1"]).
										"&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"].
										"&picon=".$qdata["picon"]."&split=".$qdata["split"];
										?>
										<br /><br />
										<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
										 codebase="<? echo $codebase;?>"
										 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
										<PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_iron.swf<? echo $swfstring;?>">
										<PARAM NAME=quality VALUE=high>
										<PARAM NAME=bgcolor VALUE=#FFFFFF>
										<EMBED src="<? echo $aim;?>../images/display_iron.swf<? echo $swfstring;?>"
										 quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" 
										 HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
										 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
										</OBJECT>		  
										<?
										if($qdata['type']==12){
												?>Identitag:&nbsp;<img src="<? echo $aim;?>images/identitags/<?=$qdata['text3']?>.gif"  border="0"><?
										}	
									}elseif($qdata["text3"] == 2){ //61266 coloured iron on for mixed packs
									$width = "180";
									$height = "54";
									if($from=="admin"){
										$width*=2;
										$height*=2;
									}
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"].
									"&text1=".urlencode($qdata["text1"]).
									"&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"].
									"&picon=".$qdata["picon"]."&split=".
									$qdata["split"] . "&background_colour=" . $qdata['text4'] . "&font_colour=" . $qdata['text10'];
									?>				
									  <br /><br />
									  <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
										codebase="<? echo $codebase;?>"
										WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
										<PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_coloured_ironon.swf
										<? echo $swfstring;?>">
										<PARAM NAME=quality VALUE=high>
										<PARAM NAME=bgcolor VALUE=#FFFFFF>
										<EMBED src="<? echo $aim;?>../images/display_coloured_ironon.swf<? echo $swfstring;?>"
										 quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>"
										  NAME="display_vinyl" ALIGN=""
										 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									  </OBJECT>
									<?php  
 
								}
								echo "<BR /><BR /><strong>Type of Iron-Ons : </strong>";
								if($qdata['type']==12){
									$semiperm =  "text6";
								} else {
									$semiperm = "text3";
								}
								
								if ((int)$qdata[$semiperm]==2){
										echo "Coloured";
								} else  {
										echo "Semi-permanent";
								}
							}
							// Birthday Packs
							if ($qdata['type']==12)
							{	?>
									<BR /><br /><strong>Identitag : </strong><BR /><img src = 'http://www.identikid.com.au/images/identitags/<?=$qdata['text3']?>.gif'>
									<BR /><BR /><strong>Gift Card : </strong><?=getPicType($qdata['gift'])?>
								<?
							}
							// Starter Packs
							if ($qdata['type']==10)
								{
										if ($qdata["typedetail"] == 1){ //61266 semi permanent iron on
											$width = "180";
											$height = "54";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"].
											"&text1=".urlencode($qdata["text1"]).
											"&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"].
											"&picon=".$qdata["picon"]."&split=".$qdata["split"];
										?>
										<br /><br />
										<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
										 codebase="<? echo $codebase;?>"
										 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
										<PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_iron.swf
										<? echo $swfstring;?>">
										<PARAM NAME=quality VALUE=high>
										<PARAM NAME=bgcolor VALUE=#FFFFFF>
										<EMBED src="<? echo $aim;?>../images/display_iron.swf<? echo $swfstring;?>"
										 quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" 
										 HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
										 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
										</OBJECT>		  
										<?php
										}elseif($qdata["typedetail"] == 2){ //61266 coloured iron on for mixed packs
										$width = "180";
										$height = "54";
										if($from=="admin"){
											$width*=2;
											$height*=2;
										}
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"].
									"&text1=".urlencode($qdata["text1"]).
									"&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"].
									"&picon=".$qdata["picon"]."&split=".
									$qdata["split"] . "&background_colour=" . $qdata['text4'] .
									 "&font_colour=" . $qdata['text10'];
									?>				
									  <br /><br />
									  <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
										codebase="<? echo $codebase;?>"
										WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>"
										 id="display_coloured_iron" ALIGN="">
										<PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_coloured_ironon.swf
										<? echo $swfstring;?>">
										<PARAM NAME=quality VALUE=high>
										<PARAM NAME=bgcolor VALUE=#FFFFFF>
										<EMBED src="<? echo $aim;?>../images/display_coloured_ironon.swf<? echo $swfstring;?>"
										 quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>"
										  NAME="display_vinyl" ALIGN=""
										 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									  </OBJECT>
									<?php  
 
										}
									echo "<BR /><BR /><strong>Type of Iron-Ons : </strong>";
									if ((int)$qdata['typedetail']==2)
											echo "Coloured";
										else 
											echo "Semi-permanent";
									
									
										$thetext = strtoupper($qdata["text3"]); // identitag
										echo "<BR /><BR /><strong>Labels : </strong>";
										if($qdata["gift"]=="1"){ 
											echo "30 Mini Labels";
										} else{
											 echo "60 Pencil Labels";
										}
										echo "<BR /><br /><strong>Identitag : </strong><BR />";
										echo "<img src = 'http://www.identikid.com.au/images/identitags/".$thetext.".gif'>";
									}
								}
								// Iron-ons Semi Permanent
								if ($qdata['type']==2)
								{
									echo "<BR />Iron-ons Semi Permanent<BR />";
									$width = "180";
									$height = "54";
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"].
									"&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"]).
									"&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".
									$qdata["split"];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_iron.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>../images/display_iron.swf<? echo $swfstring;?>"
									  quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" 
									  HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
								// mini vinyls
								}else if($qdata["type"]==3){
									$width = "164";
									$height = "63";
									echo "<BR />Mini Vinyls<BR />";
									
									if( (int)$qdata['data_colour_id']==0)
									{
										// old format, bg = yellow, font = black;
										$background_colour = VINYL_OLD_DEFAULT_BACKGROUND_COLOUR;
										$font_colour = VINYL_OLD_DEFAULT_FONT_COLOUR;
									}
									else 
									{
										$background_colour = $qdata['data_colour_id'];
										$font_colour = $qdata['data_font_colour_id'];
									}
									
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&background_colour=" . (int)$background_colour . "&font_colour=" . $font_colour;
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_mini.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>../images/display_mini.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
									}else if($qdata["type"]==4){
									echo "<BR />".$qdata["quantdesc"]."<BR />";
									$width = "165";
									$height = "54";
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_shoe" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_shoe.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>../images/display_shoe.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_shoe" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
									// Pencil labels
									}else if($qdata["type"]==5){
									echo "<BR />";
									$width = "180";
									$height = "54";
									if( (int)$qdata['data_colour_id']==0)
									{
										// old format, bg = yellow, font = black;
										$background_colour = MINI_OLD_DEFAULT_BACKGROUND_COLOUR;
										$font_colour = MINI_OLD_DEFAULT_FONT_COLOUR;
									}
									else 
									{
										$background_colour = $qdata['data_colour_id'];
										$font_colour = $qdata['data_font_colour_id'];
									}
									
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&background_colour=" . (int)$background_colour . "&font_colour=" . $font_colour;
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_pencil" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_pencil.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>../images/display_pencil.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_shoe" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									
									<?	
								// DIY Labels
								}else if($qdata["type"]==8 || $qdata["type"]==9){
									$width = "195";
									$height = "128";
									if($qdata["type"]==8)
										echo "<BR />DIY Small<BR />Colour:  ".$qdata["colours"]."<BR />";
									else
										echo "<BR />DIY Large<BR />Colour:  ".$qdata["colours"]."<BR />";
									
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&text3=".urlencode($qdata["text3"])."&text4=".urlencode($qdata["text4"])."&text5=".urlencode($qdata["text5"])."&font=".$qdata["font"]."&picon=".$qdata["picon"];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_diy" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_diy.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>../images/display_diy.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_diy" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
								// NEW BABY PACK
								}elseif($qdata['type']==16){
									echo "<BR /><BR />";
									$width = "164";
									$height = "63";
									
									if( (int)$qdata['data_colour_id']==0)
									{
										// old format, bg = yellow, font = black;
										$background_colour = VINYL_OLD_DEFAULT_BACKGROUND_COLOUR;
										//$font_colour = VINYL_OLD_DEFAULT_FONT_COLOUR;
									}
									else 
									{
										$background_colour = $qdata['data_colour_id'];
									}
									$font_colour = $qdata['data_font_colour_id'];
									$bg_colour= $qdata["colours"];
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&colour=" . (int)$bg_colour . "&font_colour=" . $font_colour;
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini_new" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_mini_new.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>../images/display_mini_new.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini_new" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
									if ($qdata["colours"]==11)
										$colors = "Baby Blue";
									else
										$colors = "Baby Pink";
									
									$thetext = strtoupper($qdata["text3"]);
									
									echo '<br /><br /><i><strong>Description : </strong>' . $qdata["quantdesc"] . '</i>';
									echo '<br /><i><strong>Colours : </strong>' . $colors . '</i>';
									echo '<br /><i><strong>Font : </strong>' . getRealFontNumber($qdata["font"]). '</i>';
									echo '<br /><i><strong>Pack Type : </strong>40 Mini Labels, 20 Iron Ons, 1 identiTAG, 1 Gift Box, 1 kidcard</i>';
									echo '<br /><br /><i><strong>Gift Card : </strong>'.getPicType($qdata['text5']);
									echo '<br /><br /><i><strong>Identitag : </strong><br /><img src = "http://www.identikid.com.au/images/identitags/'.$thetext.'.gif">';
												
								// COLOURED IRON-ONS
								}elseif($qdata["type"]==19){
									echo "<BR />";
									$width = "180";
									$height = "54";
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"] . "&background_colour=" . $qdata['data_colour_id'] . "&font_colour=" . $qdata['data_font_colour_id'];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_coloured_ironon.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>../images/display_coloured_ironon.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?	
																	
								// SHARED PACKS					
								}elseif($qdata['type']==17){
									echo "<BR />";				
									//if($qdata['type']==17){
									// pack type;
									list($pack1, $pack2) = split(",", $qdata['text5']);
									$pack=split(",", $qdata['text5']);
									// kidsName
										list($pack1_text1, $pack2_text1) = split(",", $qdata['text1']);
									$pack1_text1 = rawurldecode($pack1_text1);
									$pack2_text1 = rawurldecode($pack2_text1);
									$text1=split(",", $qdata['text1']);
									// phone number
									list($pack1_text2, $pack2_text2) = split(",", $qdata['text2']);
									$pack1_text2 = rawurldecode($pack1_text2);
									$pack2_text2 = rawurldecode($pack2_text2);
									$text2=split(",", $qdata['text2']);
									// pictures
									list($pack1_picon, $pack2_picon) = split(",", $qdata['picon']);
									$picon=split(",", $qdata['picon']);
									list($pack1_pic, $pack2_pic) = split(",", $qdata['pic']);
									$pic=split(",", $qdata['pic']);
									//font
									list($pack1_font, $pack2_font) = split(",", $qdata['font']);
									$font=split(",", $qdata['font']);
									// colours
									list($pack1_colours, $pack2_colours) = split(",", $qdata['colours']);
									$colours=split(",", $qdata['colours']);
									//split
									list($pack1_split, $pack2_split) = split(",", $qdata['split']);
									$split=split(",", $qdata['split']);
									//font colours
									list($pack1_font_col, $pack2_font_col) = split(",", $qdata['text10']);
									$font_col=split(",", $qdata['text10']);
									for($i=0;$i<=1;$i++){

										if($pack[$i]==1){
											// vinyl
											$width = "300";
											$height = "100";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											echo "<BR />30 Vinyls<BR />";
											$swfstring = "?type=7&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&fontcolour={$font_col[$i]}&split={$split[$i]}&colour={$colours[$i]}";
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_vinyl_new.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>../images/display_vinyl.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
											 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
											</OBJECT><br><br>
											<?
										}elseif($pack[$i]==2 || $pack[$i]==19){
											// coloured
											$irontype = explode(',',$qdata['text6']);
											$packcolours[0]=$pack1_colours;
											$packcolours[1]=$pack2_colours;
											
											//for ($i=0; $i<2; $i++)
											//{
												if  ((int)$irontype[$i]==2)
												{
													// coloured iron-ons
													echo "<BR />30 Coloured Iron-ons<BR />";			
													$width = "180";
													$height = "54";
													$swfstring = "?type=".$qdata["type"]."&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&split={$split[$i]}&background_colour=" . $packcolours[$i] . "&font_colour=".$font_col[$i];// . $qdata['data_font_colour_id'];
																	?>
													<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
													 codebase="<? echo $codebase;?>"
													 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
													 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_coloured_ironon.swf<? echo $swfstring;?>">
													 <PARAM NAME=quality VALUE=high>
													 <PARAM NAME=bgcolor VALUE=#FFFFFF>
													 <EMBED src="<? echo $aim;?>../images/display_coloured_ironon.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
													 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
													</OBJECT>
													<?
											
											  	}
											  	else
											  	{
													// semi permanent
													$width = "180";
													$height = "54";
													if($from=="admin"){
														$width*=2;
														$height*=2;
													}
													echo "<BR />30 Semi Permanent Iron-ons<BR />";
													$swfstring = "?type=2&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&split={$split[$i]}";
													?>
													<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
													 codebase="<? echo $codebase;?>"
													 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
													 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_iron.swf<? echo $swfstring;?>">
													 <PARAM NAME=quality VALUE=high>
													 <PARAM NAME=bgcolor VALUE=#FFFFFF>
													 <EMBED src="<? echo $aim;?>../images/display_iron.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
													 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
													</OBJECT><br><br>
											<? 	}
											//}
										}elseif($pack[$i]==3){
											// mini's
											$width = "164";
											$height = "63";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											echo "<BR />30 Mini Vinyls<BR />";
											$swfstring = "?type=2&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&fontcolour={$font_col[$i]}&colour={$colours[$i]}";
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini_new" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_mini_new.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>images/display_mini_new.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini_new" ALIGN=""
											 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
											</OBJECT><br><br>
											<?
										} //end if
									}	// end for

								}elseif((int)$qdata['type'] == 19) //|| (int)$qdata['type'] == 20)
								{
									
									echo '<br />' . $qdata['text1'];
									if(strlen($qdata['text2']) > 0)
									{
										echo '<br />' . $qdata['text2'];
									}
									
								}
								elseif((int)$qdata['type'] == 21)
								{
									// colour my world pack.
									echo '<BR /><BR />40 vinyls 40 coloured iron-ons (Permanent)<BR /> 10 shoe dots<BR /> 1 identiTag<BR /> 30 mini labels or pencil pack<BR /><BR />';

									$width = "300";
									$height = "50";
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"] . "&background_colour=" . ($qdata['colours']) . "&font_colour=" . $qdata['data_font_colour_id'];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_coloured_ironon.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>../images/display_coloured_ironon.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
								$tagsql = "SELECT data_identitag_code FROM data_identitag WHERE data_identitag_id=".$qdata["data_identitag_id"];
						 		 $tagresult = mysql_query($tagsql) or die ($tagsql.mysql_error());
								 $tagrow = mysql_fetch_assoc($tagresult);
								  echo "<BR /><BR /><img src = 'http://www.identikid.com.au/images/identitags/".$tagrow['data_identitag_code'].".gif'>";
								
									$thecol = $qdata['data_colour_id'];	
									$mysql = "SELECT data_colour_name FROM data_colour WHERE data_colour_id = '$thecol'";
									$myresult = mysql_query($mysql) or die (mysql_error());
									while ($myrow = mysql_fetch_assoc($myresult))
									{
										$ironcol = $myrow["data_colour_name"];
									}
									echo "<BR /><BR><strong>IronOn colour : </strong>". $ironcol;
									
									$miniorpen = (int)$qdata['text5']; // Mini vinyl or pen
									$pc = "SELECT productName FROM product WHERE id = '$miniorpen'";
									$pcresult = mysql_query($pc) or die (mysql_error());
									while ($pcrow = mysql_fetch_assoc($pcresult))
									{
										$thechoice = $pcrow["productName"];
									}
									echo "<BR /><BR /><strong>Pack Choice : </strong>".$thechoice."<BR />"; 
								}
									
					
	
								// Allergy Alert
								elseif((int)$qdata['type'] == 18)
								{
								if($qdata["text5"]==1){
											echo "<BR />60 Vinyls<BR />";
											// vinyl
											$width = "300";
											$height = "100";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											$swfstring = "?type=7&pic={$qdata["pic"]}&colour=".$qdata["colours"]."&text1={$qdata["text1"]}&text2={$qdata["text2"]}&font={$qdata["font"]}&picon={$qdata["picon"]}&split={$qdata["split"]}&fontcolour=".$qdata["data_font_colour_id"];
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_allergy_vinyl_new.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>../images/display_allergy_vinyl_new_new.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl_new" ALIGN=""
											 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
											</OBJECT>
											<? } //end if
										
											elseif($qdata["text5"]==3 ){
											// mini's
											echo "<BR />60 Mini Vinyls<BR />";
											$width = "164";
											$height = "63";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											$swfstring = "?type=2&pic={$qdata["pic"]}&colour=".$qdata["colours"]."&text1={$qdata["text1"]}&text2={$qdata["text2"]}&font={$qdata["font"]}&picon={$qdata["picon"]}&fontcolour=".$qdata["data_font_colour_id"];
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini_new" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_allergy_mini_new.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>../images/display_allergy_mini_new.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
											 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
											</OBJECT>
											<?
											} //end if
								
								
								// ZIP TAGS
								}elseif((int)$qdata['type'] == 22 || (int)$qdata['type'] == 23)
								{
									echo "<BR /><BR />";
									echo "<img src = '../images/ziptags/".$qdata['pic'].".gif'>";
									echo "<BR /><BR />";
									if ($qdata["text1"] !='')
									{
										echo "Line 1: ".$qdata["text1"];
										echo "<BR />";
										echo "Line 2: ".$qdata["text2"];
										echo "<BR />";
									}
								}
								
								// ADDRESS LABELS
								elseif((int)$qdata['type'] == 24 || (int)$qdata['type'] == 25 || (int)$qdata['type'] == 26)
								{
										echo "<BR /><BR />";	
										$swfstring = "?type=".$qdata["type"]."&colour=".$qdata["colours"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&text3=".urlencode($qdata["text3"])."&text4=".urlencode($qdata["text4"]);
										?>
            <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
										 codebase="<? echo $codebase;?>"
										 WIDTH="250" HEIGHT="110" id="display_address_labels.swf" ALIGN="">
              <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_address_labels.swf<? echo $swfstring;?>">
              <PARAM NAME=quality VALUE=high>
              <PARAM NAME=bgcolor VALUE=#FFFFFF>
              <EMBED src="<? echo $aim;?>../images/display_address_labels.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_address_labels" ALIGN=""
										 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED> 
            </OBJECT> <?PHP echo "<BR /><BR />";
								/*
								
									echo "<BR /><BR />";
									echo "<table width='160' align='center'>
											<tr>
												<td width='70'>
													<img src = '../images/pc".$qdata['pic'].".gif'>
												</td>
												<td>";
													echo $qdata["text1"];
													echo "<BR />";
													echo $qdata["text2"];
													echo "<BR />";
													echo $qdata["text3"];
													echo "<BR />";
													echo $qdata["text4"];
													echo "<BR />
												</td>
											</tr>
										</table>";
										echo "<br><b>Picture and Font colour = </b><img src = 'images/addresslabel_colours/".$qdata['colours'].".gif'><BR />";*/
								}
								
							// SHOE DOTS and ZIPDEDO DOTS
							elseif((int)$qdata['type'] == 20 || (int)$qdata['type'] == 28 || (int)$qdata['type'] == 29)
							{
								echo "<BR /><BR />";
								$width = "160";
								$height = "160";
								/*if($from=="admin"){
	//								$width*=2;
//									$height*=2;
								}*/
								$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&kidsName=".urlencode($qdata["text1"])."&kidsPhone=".urlencode($qdata["text2"])."&picon=".$qdata["picon"]."&background_colour=" . $qdata['data_colour_id'] . "&font_colour=" . $qdata['data_font_colour_id'];
																?>
								<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
								 codebase="<? echo $codebase;?>"
								 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
								 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_shoe_dots.swf<? echo $swfstring;?>">
								 <PARAM NAME=quality VALUE=high>
								 <PARAM NAME=bgcolor VALUE=#FFFFFF>
								 <EMBED src="<? echo $aim;?>../images/display_shoe_dots.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
								 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
								</OBJECT>
								<?
							
							 }
							elseif ($qdata['type']==30)
							{
								?>
								<br><br><strong>Identi Bands :</strong>
								<br><?=$qdata['quantdesc']?><br>
								<br>
								<?
								for($k=1; $k<=5; $k++){
									if($qdata["text".$k] != "0"){
										$text = $qdata["text".$k];
										?>
										<font color="#FFFFFF"><?=getBandPicType($text)?></font><br>
										<img src = 'http://www.identikid.com.au/images/identibands/<?=$qdata["text".$k]?>.gif' width="160" height="53"><br>
										<br>
										<?
									}
								}
							
							}elseif ((int)$qdata['type'] == 14) {
									for($k=1; $k<5; $k++){
									  echo "<BR />";
									  if($qdata["text".$k]!=""){
										if($k==1 && $qdata["text5"]!="")
										{
											?><br> <i> 
            <?	$temp = substr($qdata["text1"], 0, 2); $finalstring = str_replace(" ", "", $temp);
														echo "<img src = 'http://www.identikid.com.au/images/identitags/".$finalstring.".gif'>";
														// echo ($qdata["type"]==14)? getIdentitagDesc(strtoupper($qdata["text1"])):$qdata["text".$k];
														echo "<BR />".$qdata["text5"]."<BR />".$qdata["text6"];?>
            </i> 
            <?	
										}
										elseif($k==2 && $qdata["text7"]!="")
										{
											?>
            <br> <i> 
            <? 
													// ($qdata["type"]==14)? getIdentitagDesc(strtoupper($qdata["text2"])):$qdata["text".$k];
														echo "<BR />".$qdata["text7"]."<BR />".$qdata["text8"];?>
            </i> 
            <?	
										}
										elseif($k==3 && $qdata["text9"]!="")
										{
											?>
            <br> <i> 
            <? $temp3 = substr($qdata["text3"], 0, 2); $finalstring3 = str_replace(" ", "", $temp3);
														echo "<img src = 'http://www.identikid.com.au/images/identitags/".$finalstring3.".gif'>";
														echo "<BR />".$qdata["text9"]."<BR />".$qdata["text10"];?>
            </i> 
            <?	
										}
										elseif($k==4 && $qdata["text11"]!="")
										{
											?>
            <br> <i> 
            <? $temp4 = substr($qdata["text4"], 0, 2); $finalstring4 = str_replace(" ", "", $temp4);
														echo "<img src = 'http://www.identikid.com.au/images/identitags/".$finalstring4.".gif'>";
														echo "<BR />".$qdata["tex11"]."<BR />".$qdata["text12"];?>
            </i> 
            <?	
										}
										else
										{
											?>
            <br> <i> 
            <? $temp5 = substr($qdata["text".$k], 0, 2); $finalstring5 = str_replace(" ", "", $temp5);
														echo "<img src = 'http://www.identikid.com.au/images/identitags/".$finalstring5.".gif'>";
											//getIdentitagDesc(strtoupper($qdata["text".$k])):$qdata["text".$k];?>
            </i> 
            <?
										}
									  }
									}
									if ($qdata["type"]==15){
										echo '<br><i>' . $qdata["quantdesc"] . '</i>';
									}
									if ($qdata["type"]==16){
										echo '<br><i>' . $qdata["quantdesc"] . '</i>';
									}
								}
							elseif ($qdata["type"]==11 || $qdata["type"]==10 || $qdata["type"]==12){
							}
							
							// Book Labels
							else if($qdata["type"]==33){
									$width = "180";
									$height = "54";
									if($from=="admin"){
										$width*=2;
										$height*=2;
									}
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&picon=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&colour=".$qdata["colours"];
									?>
									<br><br>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_book_labels.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#5D7EB9>
									 <EMBED src="<? echo $aim;?>../images/display_book_labels.swf<? echo $swfstring;?>" quality=high bgcolor=#5D7EB9  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
							}	
							// Maxi Pack
							else if($qdata["type"]==34){
									?><br><br>
										<table width="100%" align="center"  border="0" cellpadding="2" cellspacing="0">
										<tr><td colspan="2">&nbsp;</td></tr>
									<?
									$font_face = 3;
									$text1 = explode(",",$qdata["text1"]); // name
									$text2 = explode(",",$qdata["text2"]); // phone
									$text3 = explode(",",$qdata["text3"]); // picture
									$text4 = explode(",",$qdata["text4"]); // background colour
									$text5 = explode(",",$qdata["text5"]); // font colour
									$text6 = explode(",",$qdata["text6"]); // split name to two lines
									$text7 = explode(",",$qdata["text7"]); // tags and bands
									$text8 = explode(",",$qdata["text8"]); // perm or semi-perm ironons
									$text9 = explode(",",$qdata["text9"]); // show phone boolean
									$text10 = explode(",",$qdata["text10"]); // show picture boolean
									
									$labelIronon = ($text8[2] == "0"?19:2);
									$labelType = array(0 => 1, 1=>3, 2=>28, 3=>20, 4=>$labelIronon);
									$swfIronon = ($text8[2] == "0"?"display_coloured_ironon":"display_iron");
									$swf = array(0 => "display_vinyl",1 => "display_mini", 2=>"display_shoe_dots", 3=>"display_shoe_dots", 4=>$swfIronon);
																		
									// Show the labels
									for($i = 0;$i<=4;$i++){
										$phone = ((int)$text9[$i]==1?urlencode($text2[$i]):"");
										
										switch($i){
											case 0:
												// vinyl 1
												//type=1&amp;colour=3&amp;pic=36&amp;text1=Firstname+Surname&amp;text2=Ph%3A+0000+5555&amp;font=5&amp;picon=1&amp;split=0&amp;fontcolour=2
												$swfstring = "?type=".$qdata["type"]."&pic=".$text3[$i]."&text1=".urlencode($text1[$i])."&text2=".$phone."&colour=".$text4[$i]."&split=".$text6[$i]."&fontcolour=".$text5[$i]."&picon=".$text10[$i];
												$width = "300";
												$height = "100";
												break;
											case 1:
												// mini 3
												//$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&background_colour=" . (int)$background_colour . "&font_colour=" . $font_colour;
												$swfstring = "?type=".$qdata["type"]."&pic=".$text3[$i]."&text1=".urlencode($text1[$i])."&text2=".$phone."&background_colour=".$text4[$i]."&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
												$width = "164";
												$height = "83";
												break;
											case 2:
												// zipdedo 28
												//type=28&amp;pic=35&amp;kidsName=Firstname2+Surname2&amp;kidsPhone=Ph%3A+0000+55552&amp;picon=1&amp;background_colour=8&amp;font_colour=1
												$swfstring = "?type=".$qdata["type"]."&pic=".$text3[$i]."&kidsName=".urlencode($text1[$i])."&kidsPhone=".$phone."&background_colour=".$text4[$i]."&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
												$width = "160";
												$height = "160";
												break;
											case 3:
												// shoe dots 20
												//$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&kidsName=".urlencode($qdata["text1"])."&kidsPhone=".urlencode($qdata["text2"])."&picon=".$qdata["picon"]."&background_colour=" . $qdata['data_colour_id'] . "&font_colour=" . $qdata['data_font_colour_id'];
												$swfstring = "?type=".$qdata["type"]."&pic=".$text3[$i]."&kidsName=".urlencode($text1[$i])."&kidsPhone=".$phone."&background_colour=".$text4[$i]."&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
												$width = "160";
												$height = "160";
												break;
											case 4:
												// ironon 19 (or 2 semi-permanent)
												//type=19&amp;pic=34&amp;text1=Firstname+Surname&amp;text2=Ph%3A+0000+5555&amp;font=1&amp;picon=1&amp;split=0&amp;background_colour=1&amp;font_colour=2
												$swfstring = "?type=".$qdata["type"]."&pic=".$text3[$i]."&text1=".urlencode($text1[$i])."&text2=".$phone."&background_colour=".$text4[$i]."&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
												$width = "270";
												$height = "90";
												break;
										}
										
										$swfstring .= "&font=".$font_face;
										//$swfstring = "?type=".$qdata["type"]."&pic=".$text3[$i]."&picon=1&text1=".urlencode($text1[$i])."&colour=".$text4[$i];
										?>
										<tr> 
											  <td width="22%" class="maintext" nowrap><strong>Pack Item:</strong></td>
											  <td width="78%" class="maintext" nowrap><?= getLabelType($labelType[$i]) ?></td>
										</tr>
										<tr> 
											  <td class="maintext" nowrap>Font Colour:</td>
											  <td class="maintext" nowrap><?= get_font_colour($text5[$i]) ?></td>
										</tr>
										<tr> 
											  <td class="maintext" nowrap>Background Colours:</td>
											  <td class="maintext" nowrap><?= get_background_colour($text4[$i]) ?></td>
										</tr>
										<tr> 
											  <td class="maintext" nowrap>Picture:</td>
											  <td class="maintext" nowrap><?= getPicType($text3[$i]) ?></td>
										</tr>
										<tr>
											<td width="100%" class="maintext" colspan="2" align="center">	
												<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
												 codebase="<? echo $codebase;?>"
												 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="<?=$swf[$i]?>" ALIGN="">
												 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/<?=$swf[$i]?>.swf<? echo $swfstring;?>">
												 <PARAM NAME=quality VALUE=high>
												 <PARAM NAME=bgcolor VALUE=#FFFFFF>
												 <EMBED src="<? echo $aim;?>../images/<?=$swf[$i]?>.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="<?=$swf[$i]?>" ALIGN=""
												 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
												</OBJECT>
											</td>
						  				</tr>
										<tr><td colspan="2">&nbsp;</td></tr>
									<?
									} // for
									
									// show the tags and bands
									?>
									<tr><td colspan="2">
									<!-- IdentiTag -->
									<table width="100%" align="left">
										<tr> 
											<td width="22%" class="maintext" nowrap><strong>Pack Item:</strong></td>
											<td width="78%" class="maintext" nowrap><?= getLabelType(14) ?></td>
										</tr>
										<tr>
											<td class="maintext" nowrap>&nbsp;</td>
											<td class="maintext" nowrap><img src = "../images/identitags/<?=$text7[0]?>.gif" border="0"></td>
										</tr>
									</table>
									</td></tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr><td colspan="2">
									<!-- WristBand -->
									<table width="100%" align="left">
										<tr> 
											<td width="22%" class="maintext" nowrap><strong>Pack Item:</strong></td>
											<td width="78%" class="maintext" nowrap><?= getLabelType(30) ?></td>
										</tr>
										<tr>
											<td class="maintext" nowrap>&nbsp;</td>
											<td class="maintext" nowrap><img src = "../images/identibands/<?=$text7[1]?>.gif" border="0"></td>
										</tr>
									</table>
									</td></tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr><td colspan="2">
									<!-- ZipTag -->
									<table width="100%" align="left">
										<tr> 
											<td width="22%" class="maintext" nowrap><strong>Pack Item:</strong></td>
											<td width="78%" class="maintext" nowrap><?= getLabelType(22) ?></td>
										</tr>
										<tr>
											<td class="maintext" nowrap>&nbsp;</td>
											<td class="maintext" nowrap><img src = "../images/ziptags/<?=getZipTagNumber($text7[2])?>.gif" border="0"></td>
										</tr>
									</table>
									</td></tr>
									</table>
								<?
									
							}
							else{

							
								for($k=1; $k<5; $k++){
								  echo "<BR />";
								  if($qdata["text".$k]!=""){
									if($k==1 && $qdata["text5"]!="")
									{
										?>
		<br> <i><? echo ($qdata["type"]==14)? getIdentitagDesc(strtoupper($qdata["text1"])):$qdata["text".$k];
													echo "<BR />".$qdata["text5"]."<BR />".$qdata["text6"];?></i> 
		<?	
									}
									elseif($k==2 && $qdata["text7"]!="")
									{
										?>
		<br> <i><? echo ($qdata["type"]==14)? getIdentitagDesc(strtoupper($qdata["text2"])):$qdata["text".$k];
													echo "<BR />".$qdata["text7"]."<BR />".$qdata["text8"];?></i> 
		<?	
									}
									elseif($k==3 && $qdata["text9"]!="")
									{
										?>
		<br> <i><? echo ($qdata["type"]==14)? getIdentitagDesc(strtoupper($qdata["text3"])):$qdata["text".$k];
													echo "<BR />".$qdata["text9"]."<BR />".$qdata["text10"];?></i> 
		<?	
									}
									elseif($k==4 && $qdata["text11"]!="")
									{
										?>
		<br> <i><? echo ($qdata["type"]==14)? getIdentitagDesc(strtoupper($qdata["text4"])):$qdata["text".$k];
													echo "<BR />".$qdata["tex11"]."<BR />".$qdata["text12"];?></i> 
		<?	
									}
									else
									{
										?>
		<br> <i><? echo ($qdata["type"]==14)? getIdentitagDesc(strtoupper($qdata["text".$k])):$qdata["text".$k];?></i> 
		<?
									}
								  }
								} 
								if ($qdata["type"]==15){
									echo '<br><i>' . $qdata["quantdesc"] . '</i>';
								}
								if ($qdata["type"]==16){
								echo "<BR />";
								$width = "164";
								$height = "63";
								
								if( (int)$qdata['data_colour_id']==0)
								{
									// old format, bg = yellow, font = black;
									$background_colour = VINYL_OLD_DEFAULT_BACKGROUND_COLOUR;
									//$font_colour = VINYL_OLD_DEFAULT_FONT_COLOUR;
								}
								else 
								{
									$background_colour = $qdata['data_colour_id'];
								}
								$font_colour = $qdata['data_font_colour_id'];
									$bg_colour= $qdata["colours"];
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&colour=" . (int)$bg_colour . "&font_colour=" . $font_colour;
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini_new" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_mini_new.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>../images/display_mini_new.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini_new" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
									echo '<br><i>' . $qdata["quantdesc"] . '</i>';
								}
							}
								
								?>
            <br> <? echo $thiscur['symbol'].toDollarsAndCents($qdata["price"]);?></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="2" width="1" border="0"></td>
        </tr>
        <tr> 
          <td class="smalltext" align="center"><input type="button" value="delete" onClick="confirmItemDelete(<? echo $qdata["id"];?>)"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
        </tr>
        <?
							}
						}
					if($runningtotal>50){?>
        <tr> 
          <td class="admintext" align="center"><strong>* FREE GIFT! *</strong></td>
        </tr>
        <?
					}
					if($id==false || mysql_num_rows($result)==0 ){?>
        <tr> 
          <td class="admintext" align="center">No items added yet</td>
        </tr>
        <?
					}else{?>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
        </tr>
        <tr> 
          <td class="admintext" align="center"><strong>TOTAL: <? echo $thiscur['symbol'].toDollarsAndCents($runningtotal);?></strong></td>
        </tr>
        <? }?>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
      </table>
			</td>
		</tr>
	</table>
</body>