<link type="text/css" rel="Stylesheet" href="_designer/css/designer-common.css" />
<link type="text/css" rel="Stylesheet" href="../_designer/css/designer-common.css" />

<?php
ini_set('display_errors', '0');
if (isset($_COOKIE["currency"])) {
linkme();
$query = "SELECT * FROM currencies WHERE id=" . $_COOKIE["currency"];
$result = mysql_query($query);
if (!$result)
error_message(sql_error());
$cur = mysql_fetch_assoc($result);
}




function getRealFontNumber($number) {
if ($number == 1 || $number == 6) {
return $number;
} else if ($number == 2) {
return 5;
} else if ($number == 3) {
return 4;
} else if ($number == 4) {
return 3;
} else if ($number == 5) {
return 2;
}
}

function getNewTags($tagnumber) {
if ($tagnumber == 32) {
return "Spider";
} else if ($tagnumber == 33) {
return "Bear";
} else if ($tagnumber == 34) {
return "Pig";
} else if ($tagnumber == 35) {
return "Cat";
} else if ($tagnumber == 36) {
return "Rocket";
} else if ($tagnumber == 37) {
return "Dairy Free";
} else if ($tagnumber == 38) {
return "Egg Free";
} else if ($tagnumber == 39) {
return "Sugar Free";
} else if ($tagnumber == 40) {
return "Nut Free";
} else if ($tagnumber == 41) {
return "Wheat Free";
} else if ($tagnumber == 42) {
return "Seafood Free";
} else if ($tagnumber == 43) {
return "Nurse";
} else if ($tagnumber == 44) {
return "Cross";
} else if ($tagnumber == 45) {
return "Football";
} else if ($tagnumber == 46) {
return "Guitar";
} else if ($tagnumber == 47) {
return "Boat";
} else if ($tagnumber == 48) {
return "Saxaphone";
} else if ($tagnumber == 49) {
return "Soccerbal";
} else if ($tagnumber == 50) {
return "Drum";
} else if ($tagnumber == 51) {
return "Ladybug";
} else {
return $tagnumber;
}
}

function viewOrder($id, $from) {
global $itemnums, $totalprice, $postage, $oseas, $secure, $cur, $currency;
if (isset($secure) && $secure == true) {
$codebase = "https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0";
$pluginspace = "https://www.macromedia.com/go/getflashplayer";
} else {
$codebase = "http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0";
$pluginspace = "http://www.macromedia.com/go/getflashplayer";
}

/*
  if($from=="admin"){
  $aim = "../";
  }
 */

$aim = SITE_URL;


if ($id != false) {
$query = "SELECT *
						FROM orders a, customers b 
						WHERE a.customer=b.id 
						AND a.id=" . $id;
//echo $query;
$result = mysql_query($query);
if (!$result)
error_message(sql_error());
while ($qdata = mysql_fetch_array($result)) {
$oseas = $qdata["oseas"];
$status = $qdata["status"];
}
if ($status == "ordered" && $from == "user") {
?>
<link href="css/identi kid.css" rel="stylesheet" type="text/css" />

<tr> 
    <td colspan="3" width="73%" class="maintext">&nbsp;&nbsp;<strong>This order has been received - thank you!</strong></td>
</tr>
<tr> 
    <td colspan="3">&nbsp;</td>
</tr>
<? }

$query = "SELECT *, bi.id as basketid FROM basket_items bi
LEFT JOIN data_font_colour dfc ON (dfc.data_font_colour_id=bi.data_font_colour_id)
LEFT JOIN data_identitag di ON (di.data_identitag_id=bi.data_identitag_id)
LEFT JOIN data_colour dc ON (dc.data_colour_id=bi.data_colour_id)
LEFT JOIN product p ON (p.id=bi.text5)
WHERE ordernumber=".$id;
//echo $query;
$result = mysql_query($query);
if(!$result) error_message(sql_error());
$itemnums = mysql_num_rows($result);
if(mysql_num_rows($result)>0){
while($qdata = mysql_fetch_array($result)){
//debug_showvar($qdata);

$qdata["text1"] = trim(stripslashes($qdata["text1"]));
$qdata["text2"] = trim(stripslashes($qdata["text2"]));
$qdata["text3"] = trim(stripslashes($qdata["text3"]));
$qdata["text4"] = trim(stripslashes($qdata["text4"]));
$qdata["text5"] = trim(stripslashes($qdata["text5"]));
?>
<tr> 
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="7%"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                <td width="93%" align="center"><?
                    if($qdata["type"]==7){
                    if($qdata["colours"]==2){
                    ?><img src="<? echo $aim;?>images/image_order_boys_pack.gif" alt="KIDSCARDS - Boys' Pack" width="184" height="182"><?
                    }else{
                    ?><img src="<? echo $aim;?>images/image_order_girls_pack.gif" alt="KIDSCARDS - Girls' Pack" width="184" height="182"><?
                    }	
                    }else{
                    if($qdata["type"]==6 || $qdata["type"]==11 && $qdata["basketid"] < 63006  ){ //61266 mixed pack
                    $width = "300";
                    $height = "100";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&colour=".$qdata["colours"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=hello".$qdata["text2"]."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_vinyl.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?	
                    }else if(($qdata["type"]>=48 && $qdata["type"]<=72)||($qdata["type"]>=80 && $qdata["type"]<=82) || $qdata["type"] == 87 || $qdata["type"]==88 || $qdata["type"]==85){
                    ?>
                    <table width="100%" align="left"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="76%" class="maintext"><strong><?= $qdata['quantdesc']; ?></strong></td>
                        </tr>
                        <? if($qdata["text4"]!='') { ?>
                        <tr>
                            <td width="22%" class="maintext">Design:</td>
                            <td width="76%" class="maintext"><?= $qdata["text4"]; ?></td>
                        </tr>
                        <? } 
                        if($qdata["text1"]!='') { ?>
                        <tr>
                            <td width="22%" class="maintext">Name:</td>
                            <td width="76%" class="maintext"><?= $qdata["text1"]; ?></td>
                        </tr>
                        <? }
                        if($qdata["text5"]!='') { ?>
                        <tr>
                            <td width="22%" class="maintext"><?= $qdata["text5"]; ?>:</td>
                            <td width="76%" class="maintext"><?= $qdata["text6"]; ?></td>
                        </tr>
                        <? } 
                        if($qdata["text2"]!='') { ?>
                        <tr>
                            <td width="22%" class="maintext">Colour:</td>
                            <td width="76%" class="maintext"><?= $qdata["text2"]; ?></td>
                        </tr>
                        <? } 
                        if($qdata["text3"]!='') { ?>
                        <tr>
                            <td width="22%" class="maintext">Material:</td>
                            <td width="76%" class="maintext"><?= $qdata["text3"]; ?></td>
                        </tr>
                        <? } ?>
                    </table>
                    <?
                    }else if($qdata["type"]==47){

                    $width = "160";
                    $height = "160";

                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&kidsName=".urlencode(" ".$qdata["text1"]." ")."&kidsPhone=".urlencode($qdata["text2"])."&picon=".$qdata["picon"]."&background_colour=" . $qdata['data_colour_id'] . "&font_colour=" . $qdata['data_font_colour_id'];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_shoe_dots.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_shoe_dots.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>

                    <?

                    } else if($qdata["type"]==46){
                    ?>
                    <table width="100%" align="left"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="76%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
                        </tr>
                        <tr>
                            <td width="22%" class="maintext"><strong>Colours:</strong></td>
                            <td width="76%" class="maintext"><?= $qdata["text1"]; ?></td>
                        </tr>
                    </table>
                    <?
                    }else if($qdata["type"]==45){
                    ?>
                    <table width="100%" align="left"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="76%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
                        </tr>
                        <tr>
                            <td width="22%" class="maintext"><strong>Design:</strong></td>
                            <td width="76%" class="maintext"><?= $qdata["text3"]; ?></td>
                        </tr>
                    </table>
                    <?
                    }
                    else if($qdata["type"]==43){  ?>
                    <table width="100%" align="left"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="76%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
                        </tr>
                        <tr>
                            <td width="22%" class="maintext">Name:</td>
                            <td width="76%" class="maintext"><?= $qdata["text1"] ?></td>
                        </tr>
                        <tr> 
                            <td class="maintext">Pic:</td>
                            <td class="maintext"><? if($qdata["picon"]=="1")
                                {
                                if ($qdata["pic"] >= 32)
                                {
                                echo getNewTags($qdata["pic"]);
                                }
                                elseif($qdata["pic"] < 32)
                                {
                                echo getPicType($qdata["pic"]);
                                }
                                }else
                                { 
                                echo "none"; 
                                }?>
                            </td>
                        </tr>
                        <tr> 
                            <td class="maintext">Font:</td>
                            <td class="maintext"><? echo getRealFontNumber($qdata["font"]);?></td>
                        </tr>
                        <tr>
                            <td width="22%" class="maintext">Font Colour:</td>
                            <td width="76%" class="maintext"><?= $qdata["colours"] ?></td>
                        </tr>
                    </table>
                    <? }
                    else if($qdata["type"]==42){ 
                    $width = "300";
                    $height = "100";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&colour=".$qdata["colours"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display__bin_labelss" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_bin_labels.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_bin_labels.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_bin_labels" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?	
                    }
                    else if($qdata["type"]==41){ 
                    ?>
                    <table width="100%" align="left"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="76%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
                        </tr>
                        <tr>
                            <td width="22%" class="maintext"><strong>Quantity:</strong></td>
                            <td width="76%" class="maintext"><strong><?= $qdata["text1"]; ?>&nbsp;<?= $qdata["text1"] > 1 ? "Packs" : "Pack"; ?></strong></td>
                        </tr>
                    </table>

                    <? 	
                    }else if($qdata["type"]==40 ){ ?>
                    <table width="100%" align="left"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="76%" class="maintext"><strong> Thingamejig Extra Charms</strong></td>
                        </tr>
                        <tr>
                            <td width="22%" class="maintext"><strong>Name:</strong></td>
                            <td width="76%" class="maintext"><?= $qdata["text1"]; ?></td>
                        </tr>
                        <tr>
                            <td width="22%" class="maintext" valign="top"><strong>Charms</strong>:</strong></td>
                            <td width="76%" class="maintext" valign="top">

                                <? 

                                for( $i=3 ; $i <= 12; $i++) {
                                print($qdata["text".$i]!=''?$qdata["text".$i].'<br>':'');
                                }
                                /*  
                                ?>
                                <?= $qdata["text3"] > 0 ? $qdata["text3"] . ' x Fairy<br>' : ''; ?>
                                <?= $qdata["text4"] > 0 ? $qdata["text4"] . ' x Mermaid<br>' : ''; ?>
                                <?= $qdata["text5"] > 0 ? $qdata["text5"] . ' x Butterfly<br>' : ''; ?>
                                <?= $qdata["text6"] > 0 ? $qdata["text6"] . ' x Heart<br>' : ''; ?>
                                <?= $qdata["text7"] > 0 ? $qdata["text7"] . ' x Flower' : ''; ?>

                                <? */ ?>
                            </td>
                        </tr>	
                    </table>
                    <?  
                    }else if($qdata["type"]>=36 && $qdata["type"]<=39 ){ ?>
                    <table width="100%" align="left"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="76%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
                        </tr>
                        <tr>
                            <td width="22%" class="maintext"><strong>Name:</strong></td>
                            <td width="76%" class="maintext"><?= $qdata["text1"]; ?></td>
                        </tr>
                        <tr>
                            <td width="22%" class="maintext"><strong>Band Colour:</strong></td>
                            <td width="76%" class="maintext"><?= $qdata["text2"]; ?></td>
                        </tr>
                        <tr>
                            <td width="22%" class="maintext" valign="top"><strong>Charms</strong>:</strong></td>
                            <td width="76%" class="maintext" valign="top">

                                <? 

                                for( $i=3 ; $i <= 12; $i++) {
                                print($qdata["text".$i]!=''?$qdata["text".$i].'<br>':'');
                                }
                                /*  
                                ?>
                                <?= $qdata["text3"] > 0 ? $qdata["text3"] . ' x Fairy<br>' : ''; ?>
                                <?= $qdata["text4"] > 0 ? $qdata["text4"] . ' x Mermaid<br>' : ''; ?>
                                <?= $qdata["text5"] > 0 ? $qdata["text5"] . ' x Butterfly<br>' : ''; ?>
                                <?= $qdata["text6"] > 0 ? $qdata["text6"] . ' x Heart<br>' : ''; ?>
                                <?= $qdata["text7"] > 0 ? $qdata["text7"] . ' x Flower' : ''; ?>

                                <? */ ?>
                            </td>
                        </tr>	
                    </table>
                    <?  
                    }else if($qdata["type"]==35){ 
                    ?>
                    <table width="100%" align="left"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="76%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
                        </tr>
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
                        $labelType = array(0=>3, 1=>28, 2=>20);
                        //$swfIronon = ($text8[2] == "0"?"display_coloured_ironon":"display_iron");
                        $swfIronon = '';
                        $swf = array(0 => "display_mini", 1=>"display_shoe_dots", 2=>"display_shoe_dots");

                        // Show the labels
                        for($i = 0;$i<=2;$i++){
                        $phone = ((int)$text9[$i]==1 ? urlencode($text2[$i]):"");

                        switch($i){
                        case 0:
                        // mini 3
                        //$swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&background_colour=" . (int)$background_colour . "&font_colour=" . $font_colour;
                        $swfstring = "type=".$qdata["type"]."&pic=".$text3[$i]."&text1=".urlencode($text1[$i])."&text2=".$phone."&background_colour=".$text4[$i]."&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
                        $width = "164";
                        $height = "83";
                        break;
                        case 1:
                        // zipdedo 28
                        //type=28&amp;pic=35&amp;kidsName=Firstname2+Surname2&amp;kidsPhone=Ph%3A+0000+55552&amp;picon=1&amp;background_colour=8&amp;font_colour=1
                        $swfstring = "type=".$qdata["type"]."&pic=".$text3[$i]."&kidsName=".urlencode($text1[$i])."&kidsPhone=".$phone."&background_colour=".$text4[$i]."&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
                        $width = "160";
                        $height = "160";
                        break;
                        case 2:
                        // shoe dots 20
                        //$swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&kidsName=".urlencode($qdata["text1"])."&kidsPhone=".urlencode($qdata["text2"])."&picon=".$qdata["picon"]."&background_colour=" . $qdata['data_colour_id'] . "&font_colour=" . $qdata['data_font_colour_id'];
                        $swfstring = "type=".$qdata["type"]."&pic=".$text3[$i]."&kidsName=".urlencode($text1[$i])."&kidsPhone=".$phone."&background_colour=".$text4[$i]."&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
                        $width = "160";
                        $height = "160";
                        break;
                        }

                        $swfstring .= "&font=".$font_face;
                        //$swfstring = "type=".$qdata["type"]."&pic=".$text3[$i]."&picon=1&text1=".urlencode($text1[$i])."&colour=".$text4[$i];
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
                                        WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="<?= $swf[$i] ?>" ALIGN="">
                                    <PARAM NAME=movie VALUE="<? echo $aim;?>../images/<?= $swf[$i] ?>.swf?<? echo $swfstring;?>">
                                    <PARAM NAME=quality VALUE=high>
                                    <PARAM NAME=bgcolor VALUE=#FFFFFF>
                                    <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>../images/<?= $swf[$i] ?>.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="<?= $swf[$i] ?>" ALIGN=""
                                           TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                                </OBJECT>
                            </td>
                        </tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <?
                        } // for

                        // show the tags and bands
                        ?>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr><td>
                                <!-- WristBand -->
                                <table width="100%" align="left">
                                    <tr> 
                                        <td width="22%" class="maintext" nowrap><strong>Pack Item:</strong></td>
                                        <td width="78%" class="maintext" nowrap><?= getLabelType(30) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="maintext" nowrap>&nbsp;</td>
                                        <td class="maintext" nowrap><img src = "<?= $aim ?>images/identibands/<?= strstr($text7[4], '.gif') ? $text7[4] : $text7[4] . ".gif" ?>" border="0"></td>
                                    </tr>
                                </table>
                            </td></tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr><td>
                                <!-- ZipTag -->
                                <table width="100%" align="left">
                                    <tr> 
                                        <td width="22%" class="maintext" nowrap><strong>Pack Item:</strong></td>
                                        <td width="78%" class="maintext" nowrap><?= getLabelType(22) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="maintext" nowrap>&nbsp;</td>
                                        <td class="maintext" nowrap><img src = "<?= $aim ?>images/ziptags/<?= strstr($text7[3], '.gif') ? $text7[3] : $text7[3] . ".gif" ?>" border="0"></td>
                                    </tr>
                                </table>
                            </td></tr>
                    </table>
                    <?	

                    }else if($qdata["type"]==11 && $qdata["basketid"] > 63006){ //61266
                    $width = "300";
                    $height = "100";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&colour=".$qdata["colours"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"]."&fontcolour=".$qdata["data_font_colour_id"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_vinyl.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?php
                    if ($qdata["type"] == 11 && $qdata["text3"] == 1) { //61266 semi permanent iron on
                    $width = "180";
                    $height = "54";
                    if ($from == "admin") {
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=" . $qdata["type"] . "&pic=" . $qdata["pic"] . "&text1=" . urlencode($qdata["text1"]) .
                    "&text2=" . urlencode($qdata["text2"]) . "&font=" . $qdata["font"] .
                    "&picon=" . $qdata["picon"] . "&split=" . $qdata["split"];
                    ?>
                    <br /><br />
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_iron.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_iron.swf"
                               quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" 
                               HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>		  
                    <?
                    }elseif($qdata["type"]==11 && $qdata["text3"] == 2){ //61266 coloured iron on for mixed packs
                    $width = "180";
                    $height = "54";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"]).
                    "&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".
                    $qdata["split"] . "&background_colour=" . $qdata['text4'] . "&font_colour=" . $qdata['text5'];
                    ?>				
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_coloured_ironon.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_coloured_ironon.swf"
                               quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>"
                               NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>

                    <?php
                    }
                    } else if ($qdata["type"] == 1 && $qdata["basketid"] > 54876) {
                    $width = "300";
                    $height = "100";
                    if ($from == "admin") {
                    $width*=2;
                    $height*=2;
                    }

                    $swfstring = "type=" . $qdata["type"] . "&colour=" . $qdata["colours"] . "&pic=" . $qdata["pic"] . "&text1=" . urlencode($qdata["text1"]) . "&text2=" . urlencode($qdata["text2"]) . "&font=" . $qdata["font"] . "&picon=" . $qdata["picon"] . "&split=" . $qdata["split"] . "&fontcolour=" . $qdata["data_font_colour_id"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_vinyl.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>" FlashVars="<? echo $swfstring;?>"></EMBED>
                    </OBJECT>
                    <?php
                    } else if ($qdata["type"] == 1 && $qdata["basketid"] < 54876) {
                    $width = "300";
                    $height = "100";
                    if ($from == "admin") {
                    $width*=2;
                    $height*=2;
                    }

                    $swfstring = "type=" . $qdata["type"] . "&colour=" . $qdata["colours"] . "&pic=" . $qdata["pic"] . "&text1=" . urlencode($qdata["text1"]) . "&text2=" . urlencode($qdata["text2"]) . "&font=" . $qdata["font"] . "&picon=" . $qdata["picon"] . "&split=" . $qdata["split"] . "&fontcolour=" . $qdata["data_font_colour_id"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_vinyl.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?php
                    } else if ($qdata["type"] == 12 && $qdata["basketid"] > 59990) {
                    $width = "300";
                    $height = "100";
                    if ($from == "admin") {
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=" . $qdata["type"] . "&colour=" . $qdata["colours"] . "&pic=" . $qdata["pic"] . "&text1=" . urlencode($qdata["text1"]) . "&text2=" . urlencode($qdata["text2"]) . "&font=" . $qdata["font"] . "&picon=" . $qdata["picon"] . "&split=" . $qdata["split"] . "&fontcolour=" . $qdata["data_font_colour_id"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_vinyl.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?					
                    if ($qdata["type"]==12 && $qdata["text6"] == 1){ //semi permanent iron on
                    $width = "180";
                    $height = "54";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"].
                    "&text1=".urlencode($qdata["text1"]).
                    "&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"].
                    "&picon=".$qdata["picon"]."&split=".$qdata["split"];
                    ?>
                    <br /><br />
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_iron.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_iron.swf"
                               quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" 
                               HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>		  
                    <?
                    }elseif($qdata["type"]==12 && $qdata["text6"] == 2){ 
                    $width = "180";
                    $height = "54";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"].
                    "&text1=".urlencode($qdata["text1"]).
                    "&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"].
                    "&picon=".$qdata["picon"]."&split=".
                    $qdata["split"] . "&background_colour=" . $qdata['text4'] . "&font_colour=" . $qdata['text5'];
                    ?>				
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_coloured_ironon.swf
                               <? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_coloured_ironon.swf"
                               quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>"
                               NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?php
                    }
                    } else if ($qdata["type"] == 12 && $qdata["basketid"] < 59990) {
                    $width = "300";
                    $height = "100";
                    if ($from == "admin") {
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=" . $qdata["type"] . "&colour=" . $qdata["colours"] . "&pic=" . $qdata["pic"] . "&text1=" . urlencode($qdata["text1"]) . "&text2=" . urlencode($qdata["text2"]) . "&font=" . $qdata["font"] . "&picon=" . $qdata["picon"] . "&split=" . $qdata["split"] . "&fontcolour=" . $qdata["data_font_colour_id"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_vinyl.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>		
                    <?php
                    } else if ($qdata["type"] == 10) { //&& $qdata["basketid"] > 58159){ // Starter Packs
                    $width = "300";
                    $height = "100";
                    if ($from == "admin") {
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=" . $qdata["type"] . "&colour=" . $qdata["colours"] . "&pic=" . $qdata["pic"] . "&text1=" . urlencode($qdata["text1"]) . "&text2=" . urlencode($qdata["text2"]) . "&font=" . $qdata["font"] . "&picon=" . $qdata["picon"] . "&split=" . $qdata["split"] . "&fontcolour=" . $qdata["data_font_colour_id"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_vinyl.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?	
                    if ($qdata["typedetail"] == 1){ //61266 semi permanent iron on
                    $width = "180";
                    $height = "54";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"].
                    "&text1=".urlencode($qdata["text1"]).
                    "&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"].
                    "&picon=".$qdata["picon"]."&split=".$qdata["split"];
                    ?>
                    <br />
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_iron.swf
                               <? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_iron.swf"
                               quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" 
                               HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>		  
                    <?php
                    } elseif ($qdata["typedetail"] == 2) { //61266 coloured iron on for mixed packs
                    $width = "180";
                    $height = "54";
                    if ($from == "admin") {
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=" . $qdata["type"] . "&pic=" . $qdata["pic"] .
                    "&text1=" . urlencode($qdata["text1"]) .
                    "&text2=" . urlencode($qdata["text2"]) . "&font=" . $qdata["font"] .
                    "&picon=" . $qdata["picon"] . "&split=" .
                    $qdata["split"] . "&background_colour=" . $qdata['text4'] .
                    "&font_colour=" . $qdata['text5'];
                    ?>				
                    <br />
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>"
                            id="display_coloured_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>../images/display_coloured_ironon.swf
                               <? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_coloured_ironon.swf"
                               quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>"
                               NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <? 
                    }



                    // identitags	
                    }else if($qdata["type"]==14){

                    }else if($qdata["type"]==2){
                    $width = "180";
                    $height = "54";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"];
                    ?>

                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_iron.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_iron.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?

                    // Book Labels
                    }else if($qdata["type"]==33){
                    $width = "180";
                    $height = "54";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&picon=1&text1=".urlencode($qdata["text1"])."&colour=".$qdata["colours"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_book_labels.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_book_labels.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?

                    // Maxi Pack
                    }else if($qdata["type"]==34){ 
                    ?>
                    <table width="100%" align="left"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="76%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
                        </tr>
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

                        $white = false;
                        if($text5[1] == '2'){ $white = true; }

                        // Show the labels
                        for($i = 0;$i<=4;$i++){
                        $phone = ((int)$text9[$i]==1?urlencode($text2[$i]):"");

                        switch($i){
                        case 0:
                        // vinyl 1
                        //type=1&amp;colour=3&amp;pic=36&amp;text1=Firstname+Surname&amp;text2=Ph%3A+0000+5555&amp;font=5&amp;picon=1&amp;split=0&amp;fontcolour=2
                        $swfstring = "type=".$qdata["type"]."&pic=".$text3[$i]."&text1=".urlencode($text1[$i])."&text2=".$phone."&colour=".$text4[$i]."&split=".$text6[$i]."&fontcolour=".$text5[$i]."&picon=".$text10[$i];
                        $width = "300";
                        $height = "100";
                        break;
                        case 1:
                        // mini 3
                        //$swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&background_colour=" . (int)$background_colour . "&font_colour=" . $font_colour;
                        $swfstring = "type=".$qdata["type"]."&pic=".$text3[$i]."&text1=".urlencode($text1[$i])."&text2=".$phone."&background_colour=".$text4[$i]."&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
                        $width = "164";
                        $height = "83";
                        break;
                        case 2:
                        // zipdedo 28
                        //type=28&amp;pic=35&amp;kidsName=Firstname2+Surname2&amp;kidsPhone=Ph%3A+0000+55552&amp;picon=1&amp;background_colour=8&amp;font_colour=1
                        $swfstring = "type=".$qdata["type"]."&pic=".$text3[$i]."&kidsName=".urlencode($text1[$i])."&kidsPhone=".$phone."&background_colour=8&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
                        $width = "160";
                        $height = "160";
                        break;
                        case 3:
                        // shoe dots 20
                        //$swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&kidsName=".urlencode($qdata["text1"])."&kidsPhone=".urlencode($qdata["text2"])."&picon=".$qdata["picon"]."&background_colour=" . $qdata['data_colour_id'] . "&font_colour=" . $qdata['data_font_colour_id'];
                        if($white == true){$text5[$i] = '2';}
                        $swfstring = "type=".$qdata["type"]."&pic=".$text3[$i]."&kidsName=".urlencode($text1[$i])."&kidsPhone=".$phone."&background_colour=".$text4[$i]."&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
                        $width = "160";
                        $height = "160";
                        break;
                        case 4:
                        // ironon 19 (or 2 semi-permanent)
                        //type=19&amp;pic=34&amp;text1=Firstname+Surname&amp;text2=Ph%3A+0000+5555&amp;font=1&amp;picon=1&amp;split=0&amp;background_colour=1&amp;font_colour=2
                        if($white == true){ $text5[$i] = '2'; }
                        $swfstring = "type=".$qdata["type"]."&pic=".$text3[$i]."&text1=".urlencode($text1[$i])."&text2=".$phone."&background_colour=".$text4[$i]."&split=".$text6[$i]."&font_colour=".$text5[$i]."&picon=".$text10[$i];
                        $width = "270";
                        $height = "90";
                        break;
                        }

                        $swfstring .= "&font=".$font_face;
                        //$swfstring = "type=".$qdata["type"]."&pic=".$text3[$i]."&picon=1&text1=".urlencode($text1[$i])."&colour=".$text4[$i];
                        $label = getLabelType($labelType[$i])
                        ?>
                        <tr> 
                            <td width="22%" class="maintext" nowrap><strong>Pack Item:</strong></td>
                            <td width="78%" class="maintext" nowrap><?= $label ?></td>
                        </tr>
                        <? if($label != 'Semi-Permanent Iron Ons' && $label != 'ZipDeDo - 10' ){ ?>
                        <tr> 
                            <td class="maintext" nowrap>Font Colour:</td>
                            <td class="maintext" nowrap><?= get_font_colour($text5[$i]) ?></td>
                        </tr>
                        <tr> 
                            <td class="maintext" nowrap>Background Colours:</td>
                            <td class="maintext" nowrap><?= get_background_colour($text4[$i]) ?></td>
                        </tr>
                        <? } ?>
                        <tr> 
                            <td class="maintext" nowrap>Picture:</td>
                            <td class="maintext" nowrap><?= getPicType($text3[$i]) ?></td>
                        </tr>
                        <tr>
                            <td width="100%" class="maintext" colspan="2" align="center">	
                                <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                                        codebase="<? echo $codebase;?>"
                                        WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="<?= $swf[$i] ?>" ALIGN="">
                                    <PARAM NAME=movie VALUE="<? echo $aim;?>../images/<?= $swf[$i] ?>.swf?<? echo $swfstring;?>">
                                    <PARAM NAME=quality VALUE=high>
                                    <PARAM NAME=bgcolor VALUE=#FFFFFF>
                                    <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>../images/<?= $swf[$i] ?>.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="<?= $swf[$i] ?>" ALIGN=""
                                           TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                                </OBJECT>
                            </td>
                        </tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <?
                        } // for

                        // show the tags and bands
                        ?>
                        <tr><td>
                                <!-- IdentiTag -->
                                <table width="100%" align="left">
                                    <tr> 
                                        <td width="22%" class="maintext" nowrap><strong>Pack Item:</strong></td>
                                        <td width="78%" class="maintext" nowrap><?= getLabelType(14) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="maintext" nowrap>&nbsp;</td>
                                        <td class="maintext" nowrap><img src = "<?= $aim ?>images/identitags/<?= $text7[0] ?>.gif" border="0"></td>
                                    </tr>
                                </table>
                            </td></tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr><td>
                                <!-- WristBand -->
                                <table width="100%" align="left">
                                    <tr> 
                                        <td width="22%" class="maintext" nowrap><strong>Pack Item:</strong></td>
                                        <td width="78%" class="maintext" nowrap><?= getLabelType(30) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="maintext" nowrap>&nbsp;</td>
                                        <td class="maintext" nowrap><img src = "<?= $aim ?>images/identibands/<?= $text7[1] ?>.gif" border="0"></td>
                                    </tr>
                                </table>
                            </td></tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr><td>
                                <!-- ZipTag -->
                                <table width="100%" align="left">
                                    <tr> 
                                        <td width="22%" class="maintext" nowrap><strong>Pack Item:</strong></td>
                                        <td width="78%" class="maintext" nowrap><?= getLabelType(22) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="maintext" nowrap>&nbsp;</td>
                                        <td class="maintext" nowrap><img src = "<?= $aim ?>images/ziptags/<?= getZipTagNumber($text7[2]) ?>.gif" border="0"></td>
                                    </tr>
                                </table>
                            </td></tr>
                    </table>
                    <?	

                    // 16 Baby Pack
                    }else if($qdata["type"]==16) {
                    $width = "164";
                    $height = "63";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }

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
                    if ( $qdata["basketid"] > 0){
                    $bg_colour= $qdata["colours"];
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&background_colour=" . (int)$bg_colour . "&font_colour=" . $font_colour;
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini_new" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_mini.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_mini.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini_new" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?
                    }
                    /*if ( $qdata["basketid"] < 57743){
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&background_colour=" . (int)$background_colour . "&font_colour=" . $font_colour;
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_mini.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_mini.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?
                    }*/?>
                    <?php
                    // mini vinyls
                    } else if ($qdata["type"] == 3) {
                    $width = "164";
                    $height = "63";
                    if ($from == "admin") {
                    $width*=2;
                    $height*=2;
                    }

                    if ((int) $qdata['data_colour_id'] == 0) {
                    // old format, bg = yellow, font = black;
                    $background_colour = VINYL_OLD_DEFAULT_BACKGROUND_COLOUR;
                    $font_colour = VINYL_OLD_DEFAULT_FONT_COLOUR;
                    } else {
                    $background_colour = $qdata['data_colour_id'];
                    $font_colour = $qdata['data_font_colour_id'];
                    }

                    $text1 = $qdata['text1'];
                    $text2 = trim(str_replace('Ph:','',$qdata['text2']));




                    if ($font_colour == '1') {
                    // black
                    $logo = 'background-image: url(http://www.identikid.com.au/_designer/images/bwl/' . $qdata["pic"] . '.png);';
                    $fontColor = 'color:#000000;';

                    } else {
                    //white
                    $logo = 'background-image: url(http://www.identikid.com.au/_designer/images/bwl2/' . $qdata["pic"] . '.png);';
                    $fontColor = 'color:#ffffff;';
                    }

                    if (!$qdata["picon"]) {
                    $logo = 'background-image:none;';
                    }

                    $sql = "select * from designer_fonts";
                    $res = mysql_query($sql);
                    $fontName = array();
                    while($row = mysql_fetch_assoc($res)) {
                    $fontName[$row['link']] = $row['fontName'];
                    }


                   // echo '<pre>';
                    //print_r($fontName);
                    //echo '</pre>';
                    //echo $swfstring = "type=" . $qdata["type"] . "&pic=" . $qdata["pic"] . "&text1=" . urlencode($qdata["text1"]) . "&font=" . $qdata["font"] . "&picon=" . $qdata["picon"] . "&background_colour=" . (int) $background_colour . "&font_colour=" . $font_colour;


                    $style = '';
                    $fontfamily = 'font-family:'.$fontName[$qdata["font"]].';'.$fontColor;

                    if ($background_colour == 9) {
                    $class = 'designer_preview_rainbow_a';
                    } else if ($background_colour == 10) {
                    $class = 'designer_preview_rainbow_b';
                    } else {
                    $class = "individual_preivew";
                    $style = 'background: url(http://www.identikid.com.au/_designer/images/mini_vinyls/' . $background_colour . '.png) no-repeat scroll 30px 54px transparent;';
                    }
                    ?>
                    <link type="text/css" rel="Stylesheet" href="_designer/css/flash_to_html_vinyls_mini.css" />
                    <link type="text/css" rel="Stylesheet" href="../_designer/css/flash_to_html_vinyls_mini.css" />
                    <div id="vinyls-mini">
                    <div id="designer_preview" class="<?php echo $class; ?>" style="<?php echo $style; ?>">
                        <span class="preview_image" style="<?php echo $logo; ?>"></span>
                        <span class="preview_text" style="<?php echo $fontfamily; ?>"><?php echo $text1; ?></span>
                        <span class="preview_phone" style="<?php echo $fontfamily; ?>"><?php echo $text2; ?></span>
                    </div>
                    </div>
                    <!--
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_mini.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php //echo $swfstring;  ?>" src="<? echo $aim;?>images/display_mini.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>-->
                    <?
                    }else if($qdata["type"]==4){
                    $width = "165";
                    $height = "54";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_shoe" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_shoe.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_shoe.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_shoe" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?php
                    }else if($qdata["type"]==5){
                    $width = "170";
                    $height = "32";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }

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
                    
                    $fontColor = ($font_colour == '1') ? 'color:#000000;' : 'color:#ffffff;';
       
                    $sql = "select * from designer_fonts";
                    $res = mysql_query($sql);
                    $fontName = array();
                    while($row = mysql_fetch_assoc($res)) {
                    $fontName[$row['link']] = $row['fontName'];
                    }

                    $style = '';
                    $fontfamily = 'font-family:'.$fontName[$qdata["font"]].';'.$fontColor;

                    if ($background_colour == 9) {
                    $class = 'designer_preview_rainbow_a';
                    } else if ($background_colour == 10) {
                    $class = 'designer_preview_rainbow_b';
                    } else {
                    $class = "individual_preivew";
                    $style = 'background: url(http://www.identikid.com.au/_designer/images/pencil/'.$background_colour.'.png) no-repeat scroll 30px 54px rgba(0, 0, 0, 0);';
                    }
                    
                    

                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&background_colour=" . (int)$background_colour . "&font_colour=" . $font_colour;
                    $flash = false;
                    ?>
                    <link type="text/css" rel="Stylesheet" href="_designer/css/pencil_labels.css" />
                    <link type="text/css" rel="Stylesheet" href="../_designer/css/pencil_labels.css" />
                    <div id="pencil_labels" style="marging:0px;padding:0px;">
                    <div id="designer_preview" class="<?php echo $class;?>" style="<?php echo $style;?>">
                        <span class="preview_text" style="<?php echo $fontColor;?>"><?php echo $qdata["text1"];?></span>
                    </div>
                    </div>
                    
                    <?php if($flash): ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_pencil" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_pencil.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_pencil.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_shoe" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?php endif; ?>
                    <?
                    }else if($qdata["type"]==8 || $qdata["type"]==9){
                    $width = "195";
                    $height = "128";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&text3=".urlencode($qdata["text3"])."&text4=".urlencode($qdata["text4"])."&text5=".urlencode($qdata["text5"])."&font=".$qdata["font"]."&picon=".$qdata["picon"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_diy" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_diy.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_diy.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_diy" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?
                    }else if($qdata["type"]==13){
                    ?><img src="<? echo $aim;?>images/image_gift_box_white_bg.jpg" alt="Gift Box" width="137" height="134"><?

                    // ADDRESS LABELS
                    }elseif((int)$qdata['type'] == 24 || (int)$qdata['type'] == 25 || (int)$qdata['type'] == 26){
                    echo "<BR /><BR />";	
                    $swfstring = "type=".$qdata["type"]."&colour=".$qdata["colours"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&text3=".urlencode($qdata["text3"])."&text4=".urlencode($qdata["text4"]);
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="250" HEIGHT="110" id="display_address_labels.swf" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_address_labels.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_address_labels.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_address_labels" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT><?PHP
                    echo "<BR /><BR />";


                    //SHARED PACKS
                    } else if ($qdata['type'] == 17) {
                    // pack type;
                    list($pack1, $pack2) = split(",", $qdata['text5']);
                    $pack = split(",", $qdata['text5']);
                    // kidsName
                    list($pack1_text1, $pack2_text1) = split(",", $qdata['text1']);
                    $pack1_text1 = rawurldecode($pack1_text1);
                    $pack2_text1 = rawurldecode($pack2_text1);
                    $text1 = split(",", $qdata['text1']);
                    // phone number
                    list($pack1_text2, $pack2_text2) = split(",", $qdata['text2']);
                    $pack1_text2 = rawurldecode($pack1_text2);
                    $pack2_text2 = rawurldecode($pack2_text2);
                    $text2 = split(",", $qdata['text2']);
                    // pictures
                    list($pack1_picon, $pack2_picon) = split(",", $qdata['picon']);
                    $picon = split(",", $qdata['picon']);
                    list($pack1_pic, $pack2_pic) = split(",", $qdata['pic']);
                    $pic = split(",", $qdata['pic']);
                    //font
                    list($pack1_font, $pack2_font) = split(",", $qdata['font']);
                    $font = split(",", $qdata['font']);
                    // colours
                    list($pack1_colours, $pack2_colours) = split(",", $qdata['colours']);
                    $colours = split(",", $qdata['colours']);
                    //split
                    list($pack1_split, $pack2_split) = split(",", $qdata['split']);
                    $split = split(",", $qdata['split']);
                    //font colours
                    list($pack1_font_col, $pack2_font_col) = split(",", $qdata['text10']);
                    $font_col = split(",", $qdata['text10']);


                    for ($i = 0;
                    $i <= 1;
                    $i++) {

                    if ($pack[$i] == 1 && $qdata["basketid"] < 56508) {
                    // vinyl
                    $width = "300";
                    $height = "100";
                    if ($from == "admin") {
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=7&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&split={$split[$i]}";
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_vinyl.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT><br><br>
                    <?
                    }
                    elseif($pack[$i]==1	&& $qdata["basketid"] > 56508){
                    // vinyl
                    $width = "300";
                    $height = "100";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=7&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&fontcolour={$font_col[$i]}&split={$split[$i]}&colour={$colours[$i]}";
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_vinyl.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT><br><br>
                    <?
                    }elseif($pack[$i]==2){
                    //iron semi-permanent
                    $width = "180";
                    $height = "54";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=2&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&split={$split[$i]}";
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_iron.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_iron.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT><br><br>
                    <?
                    }
                    elseif($pack[$i]==19){
                    //iron permanent coloured
                    $width = "180";
                    $height = "54";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }

                    $swfstring = "type=19&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&split={$split[$i]}&background_colour={$colours[$i]}&font_colour={$font_col[$i]}";
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_coloured_ironon.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_coloured_ironon.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT><br><br>
                    <?
                    }
                    elseif($pack[$i]==3 && $qdata["basketid"] > 56508){
                    // mini's
                    $width = "164";
                    $height = "63";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=2&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&font_colour={$font_col[$i]}&background_colour={$colours[$i]}";
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini_new" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_mini.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_mini.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini_new" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT><br><br>
                    <?
                    } //end if

                    elseif($pack[$i]==3 && $qdata["basketid"] < 56508){
                    // mini's
                    $width = "164";
                    $height = "63";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=2&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}";
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_mini.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_mini.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT><br><br>
                    <?
                    } //end if

                    }	// end for



                    //								}

                    }
                    elseif($qdata["type"]==18)  //								$swfstring = "type=".$qdata["type"]."&colour=".$qdata["colours"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"]."&fontcolour=".$qdata["data_font_colour_id"];
                    {
                    if($qdata["text5"]==1 && $qdata["basketid"] < 63006){
                    // vinyl
                    $width = "300";
                    $height = "100";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=7&colour={$qdata["colours"]}&pic={$qdata["pic"]}&text1={$qdata["text1"]}&text2={$qdata["text2"]}&font={$qdata["font"]}&picon={$qdata["picon"]}&split={$qdata["split"]}";
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_allergy_vinyl.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_allergy_vinyl.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?
                    }
                    if($qdata["text5"]==1 && $qdata["basketid"] > 63006){
                    // vinyl
                    $width = "300";
                    $height = "100";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=7&pic={$qdata["pic"]}&colour=".$qdata["colours"]."&text1={$qdata["text1"]}&text2={$qdata["text2"]}&font={$qdata["font"]}&picon={$qdata["picon"]}&split={$qdata["split"]}&fontcolour=".$qdata["data_font_colour_id"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_allergy_vinyl_new.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_allergy_vinyl_new_new.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl_new" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?
                    }										
                    elseif($qdata["text5"]==3 && $qdata["basketid"] < 63006){
                    // mini's
                    $width = "164";
                    $height = "63";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=2&pic={$qdata["pic"]}&text1={$qdata["text1"]}&text2={$qdata["text2"]}&font={$qdata["font"]}&picon={$qdata["picon"]}";
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_allergy_mini.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_allergy_mini.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?
                    } //end if

                    elseif($qdata["text5"]==3 && $qdata["basketid"] > 63006){
                    // mini's
                    $width = "164";
                    $height = "63";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=2&pic={$qdata["pic"]}&colour=".$qdata["colours"]."&text1={$qdata["text1"]}&text2={$qdata["text2"]}&font={$qdata["font"]}&picon={$qdata["picon"]}&fontcolour=".$qdata["data_font_colour_id"];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini_new" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_allergy_mini.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_allergy_mini.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?
                    } //end if

                    }else if($qdata["type"]==19){
                    $width = "180";
                    $height = "54";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"] . "&background_colour=" . $qdata['data_colour_id'] . "&font_colour=" . $qdata['data_font_colour_id'];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_coloured_ironon.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_coloured_ironon.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?
                    }
                    elseif((int)$qdata['type'] == 20 || (int)$qdata['type'] == 28 || (int)$qdata['type'] == 29)
                    {
                    $width = "160";
                    $height = "160";
                    /*if($from=="admin"){
                    //								$width*=2;
                    //									$height*=2;
                    }*/
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&kidsName=".urlencode($qdata["text1"])."&kidsPhone=".urlencode($qdata["text2"])."&picon=".$qdata["picon"]."&background_colour=" . $qdata['data_colour_id'] . "&font_colour=" . $qdata['data_font_colour_id'];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_shoe_dots.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_shoe_dots.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?

                    }else if($qdata["type"]==21){
                    $width = "300";
                    $height = "50";
                    if($from=="admin"){
                    $width*=2;
                    $height*=2;
                    }
                    $swfstring = "type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"] . "&background_colour=" . ($qdata['colours']) . "&font_colour=" . $qdata['data_font_colour_id'];
                    ?>
                    <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="<? echo $codebase;?>"
                            WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
                        <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_coloured_ironon.swf?<? echo $swfstring;?>">
                        <PARAM NAME=quality VALUE=high>
                        <PARAM NAME=bgcolor VALUE=#FFFFFF>
                        <EMBED FlashVars="<?php echo $swfstring; ?>" src="<? echo $aim;?>images/display_coloured_ironon.swf" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
                               TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
                    </OBJECT>
                    <?
                    }
                    }
                    ?>
                </td>
            </tr>
        </table></td>
    <td rowspan="2"><img src="<? echo $aim;?>images/gen/spacer.gif" width="1" height="1"></td>
    <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="maintext"> <div align="right"><strong><? echo $cur['symbol'].toDollarsAndCents($qdata["price"]);?></strong></div></td>
            </tr>
        </table></td>
</tr>
<tr> 
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <?
            if((int)$qdata['type'] == 5 )
            {
            // pencils

            if( (int)$qdata['data_colour_id']==0)
            {
            $sql = "SELECT data_font_colour_name FROM data_font_colour WHERE data_font_colour_id=" . MINI_OLD_DEFAULT_FONT_COLOUR;
            $colour_result = db_get_field($sql, $font_colour_name);
            if($colour_result = false)
            {
            $font_colour_name="ERROR";
            }
            $sql = "SELECT data_colour_name FROM data_colour WHERE data_colour_id=" . MINI_OLD_DEFAULT_BACKGROUND_COLOUR;
            $colour_result = db_get_field($sql, $background_colour_name);
            if($colour_result = false)
            {
            $background_colour_name="ERROR";
            }
            }
            else 
            {
            $background_colour_name = $qdata['data_colour_name'];
            $font_colour_name = $qdata['data_font_colour_name'];
            }


            ?>
            <tr> 
                <td width="9%" rowspan="11" class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                <td class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                <td width="3%" rowspan="11"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                <td class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
            </tr>
            <tr> 
                <td width="44%" class="maintext"><strong>Product:</strong></td>
                <td width="56%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
            </tr>
            <tr>
                <td class="maintext">Background Colour:</td>
                <td class="maintext"><?= $background_colour_name; ?></td>
            </tr>
            <tr> 
                <td class="maintext">Font:</td>
                <td class="maintext"><? echo getRealFontNumber($qdata["font"]);?></td>
            </tr>
            <tr>
                <td class="maintext">Font Colour:</td>
                <td class="maintext"><?= $font_colour_name; ?></td>
            </tr>
            <?

            }

            elseif ($qdata['type']==30) // Identibands
            {
            echo "<BR /><BR />
            <tr><td class='maintext' style='padding-left:25px;'><strong>Product:</strong></td><td class='maintext' style='padding-left:10px;'><strong>identi bands</td></tr> 
            <tr><td class='maintext' style='padding-left:25px;'>Amount : </td><td class='maintext' style='padding-left:10px;'>".$qdata['quantdesc']."</td></tr>";
            // get the product description
            $sqlBands = "	SELECT *
            FROM product
            WHERE id IN (30,31,32)";
            $resultBands = db_query($sqlBands);
            $products_bands = array();
            while($recordBands = db_fetch_array($resultBands)){
            $products_bands[(int)$recordBands['id']] = $recordBands['productName'];
            }
            $band_qtys = explode(",",$qdata["text5"]);

            for($k=1; $k<=5; $k++){
            if($qdata["text".$k] != "0"){
            $text = $qdata["text".$k];
            $productId = $band_qtys[$k-1];
            ?><tr>
                <td class='maintext' style='padding-left:25px;'>
                    <strong>Design <?= $k ?> : <?= getBandPicType($text) ?></strong><br>
<?= $products_bands[$productId] ?>
                </td>
                <td><img src = 'http://www.identikid.com.au/images/identibands/<?= $qdata["text" . $k] ?>.gif'></td></tr>
            <?
            }
            }


            }elseif($qdata['type']==17){
            // shared pack
            $types=array();
            $types[1] = 'Vinyl Labels';
            $types[2] = 'Semi-Permanent Iron Ons';
            $types[3] = 'Mini Vinyl Labels';
            $types[19] = 'Permanent Iron Ons';

            $colsql = "SELECT data_colour_id, data_colour_name FROM data_colour WHERE data_colour_id = '$colours[0]' OR data_colour_id = '$colours[1]'"; 
            $colresult = mysql_query($colsql) or die("error ".mysql_error());

            while ($colrow = mysql_fetch_assoc($colresult))
            {
            if ($colrow['data_colour_id']==$colours[0])
            {
            $colour1 = $colrow['data_colour_name'];
            }
            else
            {
            $colour2 = $colrow['data_colour_name'];
            }
            }
            //$colour_types=array('', 'Girls Colours', 'Boys Colours');

            if ($font[0] == 1)
            $pack1_fontcolour = "Black";
            else
            $pack1_fontcolour = "White";

            if ($font[1] == 1)
            $pack2_fontcolour = "Black";
            else
            $pack2_fontcolour = "White";		

            ?>

            <?

            if($from=="admin"){
            ?>
            <tr>
                <td colspan=4 align=center class="maintext"><strong>Product:</strong> <? echo getLabelType($qdata["type"]);?></strong></td>
            </tr>
            <tr>

                <td width=50% colspan=2 valign=top>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">


<?PHP } else {
?>
                        <tr> 
                            <td width="9%" rowspan="15" class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                            <td width="3%" rowspan="15"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                            <td class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                        </tr>
                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="66%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <?
                        }	
                        ?>

                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext"><strong>Pack1</strong></td>
                            <td class="maintext"></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext">Type:</td>
                            <td class="maintext"> <?= $types[$pack[0]]; ?></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <?
                        if($pack1!=2)
                        {
                        ?>
                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext">Colours: </td>
                            <td class="maintext"><?= $colour1; ?></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <?
                        }
                        ?>
                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext">Pic:</td>
                            <td class="maintext"><?= ($picon[0] == 1) ? getPicType($pic[0]) : ""; ?></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext">Font: </td>
                            <td class="maintext"><?= getRealFontNumber($font[0]); ?></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <?
                        if($from=="admin"){
                        ?>
                    </table>
                </td>
                <td width=50% colspan=2>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <?
                        }else{
                        ?>
                        <tr> 
                            <td class="maintext" colspan=4>&nbsp;</td>
                        </tr>
                        <?
                        }
                        ?>
                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext"><strong>Pack2</strong></td>
                            <td class="maintext"></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext">Type:</td>
                            <td class="maintext"> <?= $types[$pack[1]]; ?></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <?
                        if($pack2!=2)
                        {
                        ?>
                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext">Colours: </td>
                            <td class="maintext"><?= $colour2; ?></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <?
                        }
                        ?>
                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext">Pic: </td>
                            <td class="maintext"><?= ($picon[1] == 1) ? getPicType($pic[1]) : ""; ?></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <tr> 
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext">Font: </td>
                            <td class="maintext"><?= getRealFontNumber($font[1]); ?></td>
                            <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                        </tr>
                        <?
                        if($from=="admin"){
                        ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan=4 align=center class="maintext"><strong>Total:</strong> <? echo $cur['symbol'].toDollarsAndCents($qdata["price"]);?></strong></td>
            </tr>

            <?
            }else{
            ?>
            <tr> 
                <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                <td class="maintext" colspan=4>&nbsp;</td>
                <td class="maintext">&nbsp;</td>
            </tr>
            <tr> 
                <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                <td class="maintext">Total:</td>
                <td class="maintext"><? echo $cur['symbol'].toDollarsAndCents($qdata["price"]);?></td>
                <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
            </tr>
            <?
            }


            }

            // Address Labels
            elseif((int)$qdata['type'] == 24 || (int)$qdata['type'] == 25 || (int)$qdata['type'] == 26) {
            $pic = $qdata['pic'];
            ?>
            <tr>
                <td width="22%" class="maintext"><strong>Product:</strong></td>
                <td width="66%" class="maintext"><strong>Address Labels</strong></td>
            </tr>
            <tr>
                <td width="22%" class="maintext">Colour:</td>
                <td width="66%" class="maintext"><? echo $qdata["colours"];?></td>
            </tr>
            <tr>
                <td width="22%" class="maintext">Amount:</td>
                <td width="66%" class="maintext"><? echo $qdata["quantdesc"];?></td>
            </tr>
            <?	}


            // Custom Label
            elseif((int)$qdata['type'] == 27) {
            $pic = $qdata['pic'];
            ?>
            <tr>
                <td width="22%" class="maintext" align="left"><strong>Product:</strong></td>
                <td width="66%" class="maintext" align="left">&nbsp;&nbsp;Custom Label</td>
            </tr>
            <tr>
                <td colspan="2" height="8"></td>
            </tr>
            <tr>
                <td width="22%" class="maintext" align="left"><strong>Quantity Description:</strong></td>
                <td width="66%" class="maintext" align="left">&nbsp;&nbsp;<? echo $qdata["quantdesc"];?></td>
            </tr>
            <tr>
                <td colspan="2" height="8"></td>
            </tr>
            <tr>
                <td width="22%" class="maintext" align="left"><strong>Size/Dimensions:</strong></td>
                <td width="66%" class="maintext" align="left">&nbsp;&nbsp;<? echo $qdata["text1"];?></td>
            </tr>
            <tr>
                <td colspan="2" height="8"></td>
            </tr>
            <tr>
                <td width="22%" class="maintext" align="left"><strong>Materials:</strong></td>
                <td width="66%" class="maintext" align="left">&nbsp;&nbsp;<? echo $qdata["text2"];?></td>
            </tr>
            <tr>
                <td colspan="2" height="8"></td>
            </tr>
            <tr>
                <td width="22%" class="maintext" align="left"><strong>Colour(s):</storng></td>
                <td width="66%" class="maintext" align="left">&nbsp;&nbsp;<? echo $qdata["colours"];?></td>
            </tr>
            <tr>
                <td colspan="2" height="8"></td>
            </tr>
            <tr>
                <td width="22%" class="maintext" align="left"><strong>Price:</storng></td>
                <td width="66%" class="maintext" align="left">&nbsp;&nbsp;<? echo $cur['symbol'].toDollarsAndCents($qdata["price"]);?></td>
            </tr>
            <tr>
                <td colspan="2" height="8"></td>
            </tr>
            <tr>
                <td width="22%" class="maintext" align="left"><strong>Delivery Instructions:</storng></td>
                <td width="66%" class="maintext" align="left">&nbsp;&nbsp;<? echo $qdata["text3"];?></td>
            </tr>
            <tr>
                <td width="22%" class="maintext" align="left"><strong>File Attachment:</storng></td>
                <td width="66%" class="maintext" align="left">&nbsp;&nbsp;<?php
                    if ($qdata["text4"] != '') {
                    $picid = $qdata["text4"];
                    $sqlpic = "SELECT * FROM document_db WHERE id = '$picid'";
                    $resultpic = mysql_query($sqlpic);
                    $rowpic = mysql_fetch_assoc($resultpic);
                    echo "<a href = 'http://identikid.com.au/pdf/" . $rowpic["document_db_filename"] . "' target='_blank'>" . $rowpic["document_db_filename"] . "</a>";
                    } else {
                    echo "No Attachement";
                    }
                    ?></td>
            </tr>
            <?	}

            // Additional Amount
            elseif((int)$qdata['type'] == 666) {
            ?>
            <tr>
                <td width="22%" class="maintextalert" align="left"><strong>Product:</strong></td>
                <td width="66%" class="maintextalert" align="left">&nbsp;&nbsp;Additional Costing</td>
            </tr>
            <tr>
                <td width="22%" class="maintextalert" align="left"><strong>Reason:</strong></td>
                <td width="66%" class="maintextalert" align="left">&nbsp;&nbsp;<? echo $qdata["text1"];?></td>
            </tr>
            <?php
            } elseif((int) $qdata['type'] == 19 || (int) $qdata['type'] == 3 || (int) $qdata['type'] == 20 || (int) $qdata['type'] == 28 || (int) $qdata['type'] == 29) {
//						debug_showvar($qdata);
            // coloured iron-ons
            // & mini labels
            // & shoedots

            if ((int) $qdata['data_colour_id'] == 0) {
            // old format, bg = yellow, font = black;
            $sql = "SELECT data_font_colour_name FROM data_font_colour WHERE data_font_colour_id=" . VINYL_OLD_DEFAULT_FONT_COLOUR;
            $colour_result = db_get_field($sql, $font_colour_name);
            if ($colour_result = false) {
            $font_colour_name = "ERROR";
            }
            $sql = "SELECT data_colour_name FROM data_colour WHERE data_colour_id=" . VINYL_OLD_DEFAULT_BACKGROUND_COLOUR;
            $colour_result = db_get_field($sql, $background_colour_name);
            if ($colour_result = false) {
            $background_colour_name = "ERROR";
            }
            } else {
            $background_colour_name = $qdata['data_colour_name'];
            $font_colour_name = $qdata['data_font_colour_name'];
            }
            ?>
            <tr> 
                <td width="9%" rowspan="9" class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                <td class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                <td width="3%" rowspan="9"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                <td class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
            </tr>
            <tr> 
                <td width="44%" class="maintext"><strong>Product:</strong></td>
                <td width="56%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?>
                    </strong></td>
            </tr>
            <tr>
                <td class="maintext">Background Colour:</td>
                <td class="maintext"><?= $background_colour_name; ?></td>
            </tr>
            <tr> 
                <td class="maintext">Font:</td>
                <td class="maintext"><? echo getRealFontNumber($qdata["font"]);?></td>
            </tr>
            <tr>
                <td class="maintext">Font Colour:</td>
                <td class="maintext"><?= $font_colour_name; ?></td>
            </tr>
            <tr> 
                <td class="maintext">Pic:</td>
                <td class="maintext">
                    <? if($qdata["picon"]=="1")
                    {
                    if ($qdata["pic"] >= 32)
                    {
                    echo getNewTags($qdata["pic"]);
                    }
                    elseif($qdata["pic"] < 32)
                    {
                    echo getPicType($qdata["pic"]);
                    }
                    }else
                    { 
                    echo "none"; 
                    }?>
                </td>
            </tr>
            <?

            }

            elseif((int)$qdata['type'] == 21)
            {
            // colour my world pack
            ?>
            <tr> 
                <td width="9%" rowspan="10" class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                <td class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                <td width="3%" rowspan="10"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                <td class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
            </tr>
            <tr> 
                <td width="44%" class="maintext"><strong>Product:</strong></td>
                <td width="56%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
            </tr>
            <tr> 
                <td class="maintext">Colours:</td>
                <td class="maintext"><? 
                    db_get_field("SELECT data_colour_name FROM data_colour WHERE data_colour_id=" . ((int)$qdata['colours']), $colour_name);
                    echo $colour_name;

                    ?></td>
            </tr>
            <tr> 
                <td class="maintext">Font:</td>
                <td class="maintext"><? echo getRealFontNumber($qdata["font"]);?></td>
            </tr>
            <tr>
                <td class="maintext">Font Colour:</td>
                <td class="maintext"><?= $qdata['data_font_colour_name']; ?></td>
            </tr>
            <tr> 
                <td class="maintext">Pic:</td>
                <td class="maintext"><?
                    if($qdata["picon"]=="1"){
                    if ($qdata["pic"] > 31)
                    {
                    echo getNewTags($qdata["pic"]);
                    }
                    else
                    {
                    echo getPicType($qdata["pic"]);
                    }
                    }else{
                    echo "none";
                    }
                    //$thetext = strtoupper($qdata["data_identitag_id"]);
                    ?></td>
            </tr>
            <tr> 
                <td class="maintext">identiTAG:</td>
                <td class="maintext"><?php
                    $tagsql = "SELECT data_identitag_code FROM data_identitag WHERE data_identitag_id=" . $qdata["data_identitag_id"];
                    $tagresult = mysql_query($tagsql) or die($tagsql . mysql_error());
                    $tagrow = mysql_fetch_assoc($tagresult);
                    echo "<img src = 'http://www.identikid.com.au/images/identitags/" . $tagrow['data_identitag_code'] . ".gif'>"
                    ?></td>
            </tr>
            <tr>
                <td class="maintext">Print Reverse:</td>
                <td class="maintext"><?= $qdata['text7'] == '1' ? "Yes" : "No"; ?></td>
            </tr>
            <tr>
                <td class="maintext">IronOn Colour:</td>
                <td class="maintext"><?= $qdata['data_colour_name']; ?></td>
            </tr>
            <tr>
                <td class="maintext">Pack Choice:</td>
                <td class="maintext"><?= $qdata['productName']; ?></td>
            </tr>
            <?

            }

            // ZIPTAG
            elseif((int)$qdata['type'] == 22 || (int)$qdata['type'] == 23) {
            $pic = $qdata['pic'];
            ?>
            <tr>
                <td width="22%" class="maintext"><strong>Product:</strong></td>
                <td width="66%" class="maintext"><strong>Zip Tags</strong></td>
            </tr>
            <tr>
                <td width="22%" class="maintext">Amount:</td>
                <td width="66%" class="maintext"><? echo $qdata["quantdesc"];?></td>
            </tr>
            <tr>
                <td width="25px"></td>
                <td><? echo "<img src = '../images/ziptags/".$pic.".gif'>"?></td>
            </tr>
<?php if ($qdata["text1"] != '') { ?>
            <tr>
                <td width="15px"></td>
                <td class="maintext"><strong>Reverse text</strong></td>
            </tr>
            <tr>
                <td width="15px"></td>
                <td class="maintext">Line 1: <? echo $qdata["text1"];?></td>
            </tr>
            <tr>
                <td width="15px"></td>
                <td class="maintext">Line 2: <? echo $qdata["text2"];?></td>
            </tr>
            <? } ?>
            <?	}

            // all other types with exclusions
            else
            {

            if($from=="admin" && ($qdata["type"]==10 || $qdata["type"]==11 || $qdata["type"]==12 || $qdata['type']==16))
            {
            ?>
            <tr>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <?
                        }
                        ?>
                        <tr> 
                            <td width="9%" rowspan="9" class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                            <td class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                            <td width="3%" rowspan="9"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                            <td class="maintext"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
                        </tr>
                        <?
                        if ( !($qdata["type"]>=48 && $qdata["type"]<=56) && $qdata["type"]!=46 && $qdata["type"]!=45 && $qdata["type"]!=34 && !( $qdata["type"]>=36 && $qdata["type"]<=41) && $qdata["type"]!=43 && $qdata["type"]!=35 && ($qdata["type"]<59))
                        {
                        ?>
                        <tr> 
                            <td width="22%" class="maintext"><strong>Product:</strong></td>
                            <td width="66%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
                        </tr>
                        <?
                        }
                        if(!($qdata["type"]>=48 && $qdata["type"]<=56) && $qdata["type"]!=47 && $qdata["type"]!=46 && $qdata["type"]!=45 && $qdata["type"]!=13 && !( $qdata["type"]>=36 && $qdata["type"]<=41) && $qdata["type"]!=43 && $qdata["type"]!=14 && $qdata["type"]!="15" && $qdata["type"]!="44" && $qdata['type']!=18 && $qdata['type']!=19 && $qdata['type']!=20 && $qdata['type']!=28 && $qdata['type']!=29 && $qdata['type']!=33 && $qdata['type']!=34 && $qdata["type"]!=35 && ($qdata["type"]<59))
                        {
                        ?>
                        <tr> 
                            <td class="maintext"><? if($qdata["type"]==7){?>Pack:<? }else{ ?>Colours:<? }?></td>
                            <td class="maintext"><?
                                if($qdata["type"]==5 || $qdata["type"]==6 || $qdata["type"]==7){
                                if($qdata["colours"]==2){
                                //echo "Boys Colours";
                                }else{
                                //	echo "Girls Colours";
                                }
                                }
                                elseif($qdata["type"]==1){ // Vinyl Labels Colours
                                $thecol = $qdata["colours"];	
                                $mysql = "SELECT data_colour_name FROM data_colour WHERE data_colour_id = '$thecol'";
                                $myresult = mysql_query($mysql) or die (mysql_error());
                                while ($myrow = mysql_fetch_assoc($myresult))
                                {
                                echo $myrow["data_colour_name"];
                                }

                                }elseif($qdata["type"]==16 || $qdata["type"]==10 || $qdata["type"]==11 || $qdata["type"]==12){ // Baby Packs // starter packs // baby packs
                                $thecol = $qdata["colours"];	
                                $mysql = "SELECT data_colour_name FROM data_colour WHERE data_colour_id = '$thecol'";
                                $myresult = mysql_query($mysql) or die (mysql_error());
                                while ($myrow = mysql_fetch_assoc($myresult))
                                {
                                echo $myrow["data_colour_name"];
                                }

                                }else{
                                echo $qdata["colours"];
                                }
                                ?></td>
                        </tr>
                        <?
                        }


                        if($qdata['type']=="15")
                        {
                        $desc = substr($qdata["quantdesc"], 2, strpos($qdata["quantdesc"], "for")-2);
                        ?>
                        <tr> 
                            <td class="maintext">Desc:</td>
                            <td class="maintext"><?= $desc ?></td>
                        </tr>
                        <?
                        }

                        if($qdata['type']=="44")
                        {
                        $desc = substr($qdata["quantdesc"], 2, strpos($qdata["quantdesc"], " - ")-2);
                        ?>
                        <tr> 
                            <td class="maintext">Desc:</td>
                            <td class="maintext"><?= $desc ?></td>
                        </tr>
                        <?
                        }


                        if(!($qdata["type"]>=48 && $qdata["type"]<=56) && $qdata["type"]!=46 && $qdata["type"]!=45 && $qdata["type"]!=7 && !( $qdata["type"]>=36 && $qdata["type"]<=41) && $qdata["type"]!=43 && $qdata["type"]!=13 && $qdata["type"]!=14 && $qdata["type"]!="15"  && $qdata["type"]!="44" && $qdata["type"]!="44" &&  $qdata['type']!=18 && $qdata['type']!=16 && $qdata['type']!=33 && $qdata['type']!=34 && $qdata["type"]!=35  && ($qdata["type"]<59))
                        {
                        ?>
                        <tr> 
                            <td class="maintext">Pic:</td>
                            <td class="maintext"><? if($qdata["picon"]=="1")
                                {
                                if ($qdata["pic"] >= 32)
                                {
                                echo getNewTags($qdata["pic"]);
                                }
                                elseif($qdata["pic"] < 32)
                                {
                                echo getPicType($qdata["pic"]);
                                }
                                }else
                                { 
                                echo "none"; 
                                }?>
                            </td>
                        </tr>
                        <tr> 
                            <td class="maintext">Font:</td>
                            <td class="maintext"><? echo getRealFontNumber($qdata["font"]);?></td>
                        </tr><? 
                        if($qdata["typedetail"]==1){
                        $typeDetailDes="60 vinyl";
                        }else if($qdata["typedetail"]==2){
                        $typeDetailDes="60 iron";
                        }else{
                        $typeDetailDes="30 vinyl, 30 iron";
                        }
                        if($qdata["type"]==11){?>
                        <tr> 
                            <td class="maintext">Font Colour:</td>
                            <td class="maintext"><?php
                                if ($qdata['data_font_colour_id'] == 1)
                                echo "Black";
                                else
                                echo "White";
                                ?></td>
                        </tr>
                        <tr> 
                            <td class="maintext">Pack Type:</td>
                            <td class="maintext"><? echo $typeDetailDes;?></td>
                        </tr>

                        <tr> 
                            <td class="maintext">&nbsp;</td>
                            <td class="maintext">&nbsp;</td>
                        </tr>

                        <tr> 
                            <td class="maintext">&nbsp;</td>
                            <td class="maintext"><strong>Iron-on Type:</strong></td>
                            <td class="maintext">&nbsp;</td>
                            <td class="maintext"><? if ($qdata['text3'] == 2) echo "Coloured"; else echo "Semi-permanent"; ?></td>
                        </tr>
                        <?								
                        if ($qdata['text3'] == 2)
                        {
                        db_get_field("SELECT data_colour_name FROM data_colour WHERE data_colour_id="
                        . ((int)$qdata['text4']), $colour_name);
                        if ((int)$qdata['text5'] == 1)
                        $fcolour = "Black";
                        else
                        $fcolour = "White";
                        echo '<tr><td></td><td class="maintext">Colour:</td>
                        <td></td><td class="maintext">'.$colour_name.'</tr>';
                        echo '<tr><td></td><td class="maintext">Font Colour:</td>
                        <td></td><td class="maintext">'.$fcolour.'</tr>';
                        }

                        }
                        }

                        if($qdata["type"]==16){							?>
                        <tr> 
                            <td class="maintext">Pic:</td>
                            <td class="maintext"><? if($qdata["picon"]=="1"){
                                if ($qdata["pic"] >= 32){
                                echo getNewTags($qdata["pic"]);
                                }
                                elseif($qdata["pic"] < 32)
                                {
                                echo getPicType($qdata["pic"]);
                                }else{ echo "none"; }?></td>
                        </tr>
                        <tr> 
                            <td class="maintext">Font:</td>
                            <td class="maintext"><? echo getRealFontNumber($qdata["font"]);?></td>
                        </tr>

                        <?   }

                        // new baby pack
                        if($qdata["type"]==16 && $from!="admin"){
                        ?>
                        <tr> 
                            <td class="maintext" valign=top>Pack Type:</td>
                            <td class="maintext">40 Mini Labels, 20 Iron Ons, 1 identiTAG, 1 Gift Box, 1 kidcard</td>
                        </tr>
                        <?
                        }

                        } // all other types with exclusions


                        if( $qdata["type"]==10 && $qdata["gift"]!=""){?>
                        <tr> 
                            <td class="maintext">Labels:</td>
                            <td class="maintext"><? if($qdata["gift"]=="1"){ echo "30 Mini Labels"; }else{ echo "60 Pencil Labels"; };?></td>
                        </tr>
                        <? }

                        // new baby pack card.
                        if( $qdata["type"]==16 && $qdata["text5"]!=""){
                        ?>
                        <tr> 
                            <td class="maintext">&nbsp;</td>
                            <td class="maintext"></td>
                        </tr>
                        <tr> 
                            <td class="maintext"><b>Gift Card:</b></td>
                            <!--<td class="maintext"><?= getPicType($qdata['text5']) ?></td>-->
                            <td class="maintext"><?= $qdata['text5'] == "50" ? "Girl Card" : "Boys Card" ?></td>
                        </tr>
                        <? 
                        }

                        // birthday pack
                        if( $qdata["type"]==12 && $qdata["gift"]!=""){
                        ?>
                        <tr> 
                            <td class="maintext"><strong>Identitag:</strong></td>
                            <td class="maintext"><img src="<? echo $aim;?>images/identitags/<?= $qdata['text3'] ?>.gif"  border="0"></td>
                        </tr>
                        <tr> 
                            <td class="maintext"><b>Print reverse:</b></td>
                            <td class="maintext"><?= $qdata['text7'] == "1" ? "Yes" : "No" ?></td>
                        </tr>
                        <tr> 
                            <td class="maintext" valign="top"><strong>Iron-on Type:</strong></td>
                            <td class="maintext"><?= ((int) $qdata['text6'] == 2 ? "Coloured" : "Semi-permanent") ?>
                                <?								
                                if ($qdata['text6'] == 2)
                                {
                                db_get_field("SELECT data_colour_name FROM data_colour WHERE data_colour_id=". ((int)$qdata['text4']), $colour_name);
                                if ((int)$qdata['text5'] == 1) {
                                $fcolour = "Black";
                                } else {
                                $fcolour = "White";
                                ?><br>
                                Colour: <?= $colour_name ?><br>
                                Font Colour: <?= $fcolour ?>
                                <!--
                                        <tr>
                                                <td class="maintext">Colour:</td>
                                                <td class="maintext"><?= $colour_name ?></td>
                                        </tr>
                                        <tr>
                                                <td class="maintext">Font Colour:</td>
                                                <td class="maintext"><?= $fcolour ?></td>
                                        </tr>
                                -->
                                <?
                                }
                                }
                                ?></td>
                        </tr>
                        <tr> 
                            <td class="maintext"><b class="maintextalert">Gift Card:</b></td>
                            <? //for all gift cards ?>
                            <!--<td class="maintext"><?= getPicType($qdata['gift']) ?></td>-->
                            <? //Boy or Girl ?>
                            <td class="maintext"><?= $qdata['gift'] == "50" ? "Girl Card" : "Boys Card" ?></td>
                        </tr>
                        <? 
                        }
                        // Starter packs
                        if ($qdata['type']==10)
                        {
                        if ($qdata["text3"]!="")
                        {
                        $thetext = strtoupper($qdata["text3"]);								
                        ?><tr>
                            <td class="maintext" width="25px"><b>Identitag:</b></td>
                            <td><? echo "<img src = 'http://www.identikid.com.au/images/identitags/".$thetext.".gif'>"?></td>
                        </tr>
                        <tr> 
                            <td class="maintext"><b>Print reverse:</b></td>
                            <td class="maintext"><?= $qdata['text7'] == "1" ? "Yes" : "No" ?></td>
                        </tr>
                        <tr> 
                            <td colsapn="4"></td>
                        </tr>
                        <? } ?>
                        <tr> 
                            <td colsapn="4"></td>
                        </tr>
                        <tr> 
                            <td class="maintext">&nbsp;</td>
                            <td class="maintext"><strong>Iron-on Type:</strong></td>
                            <td class="maintext">&nbsp;</td>
                            <td class="maintext">
                                <? 	if ($qdata['typedetail'] == 2) 
                                echo "Coloured";
                                else 
                                echo "Semi-permanent"; 						?>
                            </td>
                        </tr>
                        <?								
                        if ($qdata['typedetail'] == 2)
                        {
                        db_get_field("SELECT data_colour_name FROM data_colour WHERE data_colour_id="
                        . ((int)$qdata['text4']), $colour_name);
                        if ((int)$qdata['text5'] == 1)
                        $fcolour = "Black";
                        else
                        $fcolour = "White";
                        echo '<tr><td></td><td class="maintext">Colour:</td>
                        <td></td><td class="maintext">'.$colour_name.'</tr>';
                        echo '<tr><td></td><td class="maintext">Font Colour:</td>
                        <td></td><td class="maintext">'.$fcolour.'</tr>';
                        }
                        } ?>


                        <?php
                        // New Baby Packs and Starter packs
                        if ($qdata['type'] == 16 && $qdata["text3"] != "") {
                        $thetext = strtoupper($qdata["text3"]);
                        ?>
                        <tr> 
                            <td colsapn="4"></td>
                        </tr>
                        <tr>
                            <td class="maintext">&nbsp;</td>
                            <td class="maintext" width="25px"><b>Identitag:</b></td>
                            <td class="maintext">&nbsp;</td>
                            <td><? echo "<img src = 'http://www.identikid.com.au/images/identitags/".$thetext.".gif'>"?></td>
                        </tr>
                        <tr> 
                            <td class="maintext"><b>Print reverse:</b></td>
                            <td class="maintext"><?= $qdata['text7'] == "1" ? "Yes" : "No" ?></td>
                        </tr>

                        <? 	} 

                        // IDENTITAGS
                        if($qdata["type"]==14){
                        //$t=1;
                        $x=1; //reference to tag image
                        $tagArray = array();

                        $basketid = $qdata['basketid'];

                        $mysql = "SELECT * FROM basket_items WHERE type = 14 AND ordernumber='$id' AND id = '$basketid'";
                        $myresult = mysql_query($mysql) or die ("database error identitag line 939(or abouts");
                        while ($myrow = mysql_fetch_assoc($myresult))
                        {
                        $offset = 4;
                        for($i=1; $i<5; $i++){

                        $thetext = getIdentitagDesc(strtoupper($myrow["text".$i]));
                        // extract first 2 digits
                        $temp = substr($thetext, 0, 2);
                        // remove blank spaces
                        $finalstring = str_replace(" ", "", $temp);
                        if($finalstring != ''){							
                        ?></table>
                    <br>
                    <table>
                        <tr>
                            <td width="25px"></td>
                            <td><? echo "<img src = 'http://www.identikid.com.au/images/identitags/".$finalstring.".gif'>"?></td>
                        </tr>								

                        <?
                        $num = $i+$offset;
                        $text1 = getIdentitagDesc($myrow["text".$num]);
                        $num = $i+$offset+1;
                        $text2 = getIdentitagDesc($myrow["text".$num]);
                        $offset++;

                        if($text1 != '' || $text2 != '') {
                        ?>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td colspan="2" height="12"><strong><font face="Arial, Helvetica, sans-serif" size="2">Text on reverse side of tag</font></strong></td>
                        </tr>

                        <?
                        if($text1 != '') { ?>
                        <tr> 
                            <td class="maintext" width="90px" bgcolor="#CCFFCC">First Line:</td>
                            <td class="maintext" bgcolor="#CCFFCC"><?= $text1; ?></td>
                        </tr>
                        <? } 

                        if($text2 != '') { ?>							
                        <tr> 
                            <td class="maintext" bgcolor="#66CCFF">Second Line:</td>
                            <td class="maintext" bgcolor="#66CCFF"><?= $text2; ?></td>
                        </tr> 
                        <?
                        }  
                        }  
                        }
                        }
                        }

                        /*	  }						

                        //	while($qdata["text".$t] && $qdata["text".$t]!=""){

                        // if reverse text not checked
                        if($myrow["text5"] == "")
                        {
                        for ($y=1; $y<5; $y++)
                        {
                        if($myrow["text".$y] !='')
                        {
                        $thetext = getIdentitagDesc(strtoupper($myrow["text".$y]));
                        // extract first 2 digits
                        $temp = substr($thetext, 0, 2);
                        // remove blank spaces
                        $finalstring = str_replace(" ", "", $temp);

                        ?>
                        <tr>
                            <td width="25px"></td>
                            <td><? echo "<img src = 'http://www.identikid.com.au/images/identitags/".$finalstring.".gif'>"?></td>
                        </tr>								

                        <?
                        }
                        }
                        }

                        // if reverse text checked
                        else
                        {
                        for ($t=1; $t<13; $t++)

                        {

                        if($myrow["text".$t] && $myrow["text".$t]="")
                        {
                        // create image name array (a.gif, s.gif etc)
                        if ($t < 5)
                        {
                        // text as it is called from basket_items
                        $thetext = getIdentitagDesc(strtoupper($myrow["text".$t]));
                        // extract first 2 digits
                        $temp = substr($thetext, 0, 2);
                        // remove blank spaces
                        $finalstring = str_replace(" ", "", $temp);
                        // add to array
                        $tagArray[$t] = $finalstring;	
                        } 

                        // if the tag number is odd (reverse text)	
                        if ($t % 2 && $t > 4) {
                        ?>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td colspan="2"><? echo "<img src = 'http://www.identikid.com.au/images/identitags/".$tagArray[$x].".gif'>"?></td>
                        </tr>
                        <tr>
                            <td colspan="2" height="12"><strong><font face="Arial, Helvetica, sans-serif" size="2">Text on reverse side of tag</font></strong></td>
                        </tr>
                        <tr> 
                            <td class="maintext" width="90px" bgcolor="#CCFFCC">First Line:</td>
                            <td class="maintext" bgcolor="#CCFFCC"><? echo getIdentitagDesc($myrow["text".$t]);?></td>
                        </tr>

                        <?
                        // if the tag number is even
                        $x++;
                        } elseif (($t % 2) == 0 && $t > 4) {
                        ?>
                        <tr> 
                            <td class="maintext" bgcolor="#66CCFF">Second Line:</td>
                            <td class="maintext" bgcolor="#66CCFF"><? echo getIdentitagDesc($myrow["text".$t]);?></td>
                        </tr>
                        <? } 
                        }
                        //end if

                        // end for
                        }
                        $t++;

                        }//end while
                        } */

                        } // IDENTITAGS

                        if($qdata['type']==18)
                        {

                        $desc = substr($qdata["quantdesc"], 0, strpos($qdata["quantdesc"], "Allergy")-1);
                        if($qdata['text5']==1)
                        {
                        $desc .= " Vinyl Labels";
                        }
                        else {
                        $desc .= " Mini Labels";
                        }
                        ?>
                        <tr> 
                            <td class="maintext">Pack Type:</td>
                            <td class="maintext"><?= $desc; ?></td>
                        </tr>
                        <tr> 
                            <td class="maintext">Colours:</td>
                            <td class="maintext"><? 
                                db_get_field("SELECT data_colour_name FROM data_colour WHERE data_colour_id=" . ((int)$qdata['colours']), $colour_name);
                                echo $colour_name;

                                ?></td>
                        </tr>

                        <tr> 
                            <td class="maintext">Pic:</td>
                            <td class="maintext"><? if($qdata["picon"]=="1"){ echo getAllergyPicType($qdata["pic"]); }else{ echo "none"; }?></td>
                        </tr>
                        <tr> 
                            <td class="maintext">Font:</td>
                            <td class="maintext"><? echo getRealFontNumber($qdata["font"]);?></td>
                        </tr>
                        <tr> 
                            <td class="maintext">Font Colour:</td>
                            <td class="maintext"><?php
                                if ($qdata['data_font_colour_id'] == 1)
                                echo "Black";
                                else
                                echo "White";
                                ?></td>
                        </tr>

                        <?
                        }

                        if( (int)$qdata['type'] == 19 || (int)$qdata['type'] == 20)
                        {
                        ?>
                        <tr> 
                            <td class="maintext" nowrap>Background Colour:</td>
                            <td class="maintext"><?= get_background_colour($qdata['colours']); ?></td>
                        </tr>
                        <tr> 
                            <td class="maintext">Font Colour:</td>
                            <td class="maintext"><?= get_font_colour($qdata['text5']); ?></td>
                        </tr>
                        <?

                        }

                        // Book Labels
                        if( (int)$qdata['type'] == 33)
                        {
                        ?>
                        <tr> 
                            <td class="maintext" nowrap>Background Colour:</td>
                            <td class="maintext"><?= ((int) $qdata['colours'] == 10 ? "Set B" : "Set A") ?></td>
                        </tr>
                        <tr> 
                            <td class="maintext">Pic:</td>
                            <td class="maintext"><?= getPicType($qdata["pic"]) ?></td>
                        </tr>
                        <?

                        }

                        ?>
                                <!--<tr>
                                  <td> </td> 
                                  <td class="maintext" width="25px"><b>Total:</b></td>
                                  <td class="maintext"><? echo $cur['symbol'].toDollarsAndCents($qdata["price"]);?></td>
                                </tr>-->
                        <? if($from=="admin" && ($qdata["type"]==10 || $qdata["type"]==11 || $qdata["type"]==12 || $qdata['type']==16)){ ?>
                    </table>
                </td>
                <td><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="1"></td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <? if($qdata["type"]==10){ ?>
                        <tr>
                            <td class="maintext">
                                <strong>Starter Pack - <?= $cur[$currency]['symbol']; ?><?= $qdata["price"] ?></strong><br>
                                40 vinyls<br>
                                40 iron-ons<br>
                                20 shoe labels<br>
                                1 bagtags<br>
                                30 mini labels or 60 pencil labels</td>
                        </tr>
                        <? }else if($qdata["type"]==11){ ?>
                        <tr>
                            <td class="maintext">
                                <strong>Mixed Pack - <?= $cur[$currency]['symbol']; ?><?= $qdata["price"] ?> per child</strong><br>
                                30 vinyls<br>
                                30 iron-ons</td>
                        </tr>
                        <? }else if($qdata["type"]==12){ // birthday pack ?>
                        <tr>
                            <td class="maintext">
                                <strong>Birthday Pack - <?= $cur[$currency]['symbol']; ?><?= $qdata["price"] ?></strong><br>
                                30 vinyls<br>
                                30 iron-ons<br>
                                1 Identitag<br>
                                Giftbox<br>
                                <span class="maintextalert">Gift Card</span><br>
                                Matching ribbon</td>
                        </tr>
                        <?
                        }else if($qdata["type"]==16){ 			// new baby pack
                        ?>
                        <tr>
                            <td class="maintext">
                                <strong>New Baby Pack - <?= $cur[$currency]['symbol']; ?><?= $qdata["price"] ?></strong><br>
                                40 mini labels<br>
                                20 iron-ons<br>
                                1 identiTAG<br>
                                1 Kidcard<br>
                                1 Gift Box with ribbon<br>
                            </td>
                        </tr>
                        <? }?>
                    </table>
                </td>
            </tr>
            <? }
            }
            ?>
        </table></td>

    <td valign="bottom">
        <?
        $totalprice += $qdata["price"];

        if($from=="user"){
        if($qdata["type"]==1){
        $filename="Products/Labels/Vinyls";
        }else if($qdata["type"]==2){
        $filename="Products/Clothing_Labels/Semi-Permanent_Iron-Ons";
        }else if($qdata["type"]==3){
        $filename="Products/labels/mini_vinyls";
        }else if($qdata["type"]==4){
        $filename="Products/Clothing_Labels/Shoe_Labels";
        }else if($qdata["type"]==5){
        $filename="products/labels/pencil_labels";
        }else if($qdata["type"]==6){
        $filename="products_bag_tags.php";
        }else if($qdata["type"]==7){
        $filename="Products/Gift_Cards_&_Packaging/Kidcards";
        }else if($qdata["type"]==8){
        $filename="products/labels/diy_labels";
        }else if($qdata["type"]==9){
        $filename="products/labels/diy_labels";
        }else if($qdata["type"]==10){
        $filename="Products/Packs/Starter_Pack";
        }else if($qdata["type"]==11){
        $filename="products_mixed_pack.php";
        }else if($qdata["type"]==12){
        $filename="Products/Packs/Birthday_Pack";
        }
        else if($qdata["type"]==14){
        $filename="Products/Tags/IdentiTAGS";
        }
        elseif($qdata["type"]=="15"){
        $filename ="Products/Gift_Vouchers";
        }
        elseif($qdata['type']==16){
        $filename="Products/Packs/Baby_Pack";
        }
        elseif($qdata['type']==17){
        $filename="Products/Packs/Shared_Pack";
        }
        elseif($qdata['type']==18){
        $filename = "Products/Medical_Alerts/Medical_Alert_Labels";
        }
        elseif($qdata['type']==19){
        $filename = "Products/Clothing_Labels/Permanent_Iron-Ons";
        }
        elseif($qdata['type']==20){
        $filename = "Products/Clothing_Labels/Shoe_Dots";
        }
        elseif($qdata['type']==21){
        $filename = "Products/Packs/Colour_My_World_Pack";
        }
        elseif($qdata['type']==22 || $qdata['type']==23){
        $filename = "Products/Tags/Zip_Tags";
        }
        elseif($qdata['type']==28 || $qdata['type']==29){
        $filename = "Products/Tags/ZipiDiDo_Dots";
        }
        elseif($qdata['type']==30 || $qdata['type']==31){
        $filename = "Products/Identibands";
        }						
        elseif($qdata['type']==33){
        $filename = "products/labels/book_labels";
        }						
        elseif($qdata['type']==34){
        $filename = "Products/Packs/Maxi_Packs";
        }
        elseif($qdata['type']==35){
        $filename = "Products/Packs/Itty_Bitty_Pack";
        }
        elseif($qdata['type']==36){
        $filename = "Products/Thingamejigs/Name_Bracelets";
        }	
        elseif($qdata['type']==37){
        $filename = "Products/Thingamejigs/Pet_Collars";
        }	
        elseif($qdata['type']==38){
        $filename = "Products/Thingamejigs/Boybandz";
        }
        elseif($qdata['type']==39){
        $filename = "Products/Thingamejigs/Gadget_Straps";
        }
        elseif($qdata['type']==40){
        $filename = "Products/Thingamejigs/Extra_Charms";
        }
        elseif($qdata['type']==41){
        $filename = "products/labels/magpie_eyes";
        }
        elseif($qdata['type']==42){
        $filename = "products/labels/Bin_Labels";
        }	
        elseif($qdata['type']==43){
        $filename = "products/Packs/Seniors_Pack";
        }
        elseif($qdata['type']==44){
        $filename ="Products/Gift_Vouchers/Instant";
        }	
        elseif($qdata['type']==45){
        $filename ="Products/Wall_Art";
        }									
        elseif($qdata['type']==46){
        $filename ="Products/Baby_Stuff/Kipiis";
        }
        elseif($qdata['type']==47){
        $filename ="Products/Baby_Stuff/Dummy_Dots";
        }
        elseif($qdata['type']==48){
        $filename ="/Products/Drink_Bottle_Covers";
        }
        elseif($qdata['type']==49){
        $filename ="/Products/Lunchboxes";
        }
        elseif($qdata['type']==50){
        $filename ="/Products/Pencil_Cases";
        }	
        elseif($qdata['type']==51){
        $filename ="/Products/Mugs";
        }	
        elseif($qdata['type']==52){
        $filename ="/Products/Muslins_Wraps";
        }	
        else {
        $filename = "Products";
        }						
        ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><a href="<? echo $filename;?>" ><img src="<? echo $aim;?>images/nav/n_more_info.gif" name="<? echo "im".$qdata["basketid"]."1";?>" width="83" height="22" border="0"></a></td>
            </tr>
            <tr class="noshow">
                <td><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="10"></td>
            </tr>
            <tr class="noshow">
                <td>
                    <form name="remove<? echo $qdata["basketid"];?>" method="post" action="remove_item.php">
                          <input type="hidden" name="id" value="<? echo $qdata["basketid"];?>">
                    </form>
                    <img src="<? echo $aim;?>images/nav/n_remove.gif" alt="Remove Item" name="<? echo "im".$qdata["basketid"]."2";?>" width="83" height="22" border="0" id="remove_item1"  onClick="if(window.confirm('Really remove this item?') == true){ document.forms['remove'+<? echo $qdata["basketid"];?>].submit();}"></td>
            </tr>
        </table>
    </td>
</tr>
<? }?>
<tr class="noshow">
    <td colspan="3">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="5%" rowspan="3"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                <td width="95%"><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="20"></td>
            </tr>
            <tr>
                <td><div align="center"><img src="<? echo $aim;?>images/seperator_grey_line.gif" width="100%" height="1"></div></td>
            </tr>
            <tr>
                <td><img src="<? echo $aim;?>images/gen/spacer.gif" width="10" height="20"></td>
            </tr>
        </table></td>
</tr>
<?
}
}
}

if($id==false || mysql_num_rows($result)==0){
?>
<tr> 
    <td width="73%"><img src="<? echo $aim;?>images/gen/spacer.gif" width="1" height="10"></td>
</tr>
<tr> 
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="maintext">
            <tr> 
                <td width="7%"><img src="<? echo $aim;?>images/gen/spacer.gif" width="25" height="10"></td>
                <td width="93%">Nothing ordered yet!</td>
            </tr>
        </table>
    </td>
</tr>
<tr class="noshow"> 
    <td width="73%"><img src="<? echo $aim;?>images/gen/spacer.gif" width="1" height="10"></td>
</tr><?
}
}
?>
