<?

if(isset($_COOKIE["currency"])){
	linkme();
	$query = "SELECT * FROM currencies WHERE id=".$_COOKIE["currency"];
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	$cur = mysql_fetch_assoc($result);
}


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

function viewOrder($id, $from){
	global $itemnums, $totalprice, $postage, $oseas, $secure, $cur, $currency;
	if(isset($secure) && $secure==true){
		$codebase = "https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0";
		$pluginspace = "https://www.macromedia.com/go/getflashplayer";
	}else{
		$codebase = "http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0";
		$pluginspace = "http://www.macromedia.com/go/getflashplayer";
	}
	
	if($from=="admin"){
		$aim = "../";
	}
	
	if($id != false){
		$query = "SELECT * FROM orders a, customers b WHERE a.customer=b.id AND a.id=".$id;
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		while($qdata = mysql_fetch_array($result)){
			$oseas = $qdata["oseas"];
			$status = $qdata["status"];
		}
		if($status == "ordered" && $from=="user"){?>
		<tr> 
			<td colspan="3" width="73%" class="maintext">&nbsp;&nbsp;<strong>This order has been received - thank you!</strong></td>
		</tr>
		<tr> 
			<td colspan="3">&nbsp;</td>
		  </tr>
		<? }
		
		if($from=="user"){
		?>
		<tr> 
			<td colspan="3">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td width="4%"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
					<td width="96%"><img src="<? echo $aim;?>images/text_your_order_so_far.gif" width="149" height="19"> 
				</td>
				</tr>
			  </table>
			</td>
		  </tr><?
		 }				
		$query = "SELECT *, bi.id as basketid FROM basket_items bi
		LEFT JOIN data_font_colour dfc ON (dfc.data_font_colour_id=bi.data_font_colour_id)
		LEFT JOIN data_identitag di ON (di.data_identitag_id=bi.data_identitag_id)
		LEFT JOIN data_colour dc ON (dc.data_colour_id=bi.data_colour_id)
		LEFT JOIN product p ON (p.id=bi.text5)
		WHERE ordernumber=".$id;
//		echo $query;
		$result = mysql_query($query);
		if(!$result) error_message(sql_error());
		$itemnums = mysql_num_rows($result);
		if(mysql_num_rows($result)>0){
			while($qdata = mysql_fetch_array($result)){
//				debug_showvar($qdata);
		?>
			<tr> 
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td width="7%"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td width="93%" align="center"><?
						  if($qdata["type"]==7){
								if($qdata["colours"]==2){
									?><img src="<? echo $aim;?>images/image_order_boys_pack.gif" alt="KIDSCARDS - Boys' Pack" width="184" height="182"><?
								}else{
									?><img src="<? echo $aim;?>images/image_order_girls_pack.gif" alt="KIDSCARDS - Girls' Pack" width="184" height="182"><?
								}	
						  }else{
								if($qdata["type"]==6 || $qdata["type"]==10 || $qdata["type"]==11 || $qdata["type"]==12){
									$width = "300";
									$height = "100";
									if($from=="admin"){
										$width*=2;
										$height*=2;
									}
									$swfstring = "?type=".$qdata["type"]."&colour=".$qdata["colours"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>images/display_vinyl.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?php
									}else if($qdata["type"]==1 && $qdata["basketid"] > 54876){
													$width = "300";
										$height = "100";
										if($from=="admin"){
											$width*=2;
											$height*=2;
										}
										$swfstring = "?type=".$qdata["type"]."&colour=".$qdata["colours"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"]."&fontcolour=".$qdata["data_font_colour_id"];
										?>
										<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
										 codebase="<? echo $codebase;?>"
										 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
										 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl_new.swf<? echo $swfstring;?>">
										 <PARAM NAME=quality VALUE=high>
										 <PARAM NAME=bgcolor VALUE=#FFFFFF>
										 <EMBED src="<? echo $aim;?>images/display_vinyl.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
										 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
										</OBJECT>
								<?php	
								}else if($qdata["type"]==1 && $qdata["basketid"] < 54876){
										$width = "300";
										$height = "100";
										if($from=="admin"){
											$width*=2;
											$height*=2;
										}
										$swfstring = "?type=".$qdata["type"]."&colour=".$qdata["colours"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"]."&fontcolour=".$qdata["data_font_colour_id"];
										?>
										<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
										 codebase="<? echo $codebase;?>"
										 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
										 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf<? echo $swfstring;?>">
										 <PARAM NAME=quality VALUE=high>
										 <PARAM NAME=bgcolor VALUE=#FFFFFF>
										 <EMBED src="<? echo $aim;?>images/display_vinyl.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
										 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
										</OBJECT>
								<?php			
								}else if($qdata["type"]==2){
									$width = "180";
									$height = "54";
									if($from=="admin"){
										$width*=2;
										$height*=2;
									}
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_iron.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>images/display_iron.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
								}else if($qdata["type"]==3 || $qdata["type"]==16){
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
									 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_mini.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>images/display_mini.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
								}else if($qdata["type"]==4){
									$width = "165";
									$height = "54";
									if($from=="admin"){
										$width*=2;
										$height*=2;
									}
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_shoe" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_shoe.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>images/display_shoe.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_shoe" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
								}else if($qdata["type"]==5){
									$width = "180";
									$height = "54";
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
									
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&background_colour=" . (int)$background_colour . "&font_colour=" . $font_colour;
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_pencil" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_pencil.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>images/display_pencil.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_shoe" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
								}else if($qdata["type"]==8 || $qdata["type"]==9){
									$width = "195";
									$height = "128";
									if($from=="admin"){
										$width*=2;
										$height*=2;
									}
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&text3=".urlencode($qdata["text3"])."&text4=".urlencode($qdata["text4"])."&text5=".urlencode($qdata["text5"])."&font=".$qdata["font"]."&picon=".$qdata["picon"];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_diy" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_diy.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>images/display_diy.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_diy" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
								}else if($qdata["type"]==13){
									?><img src="<? echo $aim;?>images/image_gift_box_white_bg.jpg" alt="Gift Box" width="137" height="134"><?
								}	
								else if($qdata['type']==17){



									//shared pack.  1=vinyl, 2=iron-on or 3=mini's.
									
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

										if($pack[$i]==1	&& $qdata["basketid"] < 1){
											// vinyl
											$width = "300";
											$height = "100";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											$swfstring = "?type=7&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&split={$split[$i]}";
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>images/display_vinyl.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
											 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
											</OBJECT><br>
											<?
										}
										elseif($pack[$i]==1	&& $qdata["basketid"] > 1){
											// vinyl
											$width = "300";
											$height = "100";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											$swfstring = "?type=7&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&fontcolour={$font_col[$i]}&split={$split[$i]}&colour={$colours[$i]}";
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_vinyl_new.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>images/display_vinyl.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
											 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
											</OBJECT><br>
											<?
										}elseif($pack[$i]==2){
											//iron
											$width = "180";
											$height = "54";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											$swfstring = "?type=2&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&split={$split[$i]}";
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_iron" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_iron.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>images/display_iron.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
											 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
											</OBJECT><br>
											<?
										}
										elseif($pack[$i]==3 && $qdata["basketid"] > 1){
											// mini's
											$width = "164";
											$height = "63";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											$swfstring = "?type=2&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}&fontcolour={$font_col[$i]}&colour={$colours[$i]}";
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_mini.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>images/display_mini.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
											 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
											</OBJECT><br>
											<?
										} //end if
										
										elseif($pack[$i]==3 && $qdata["basketid"] < 1){
											// mini's
											$width = "164";
											$height = "63";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											$swfstring = "?type=2&pic={$pic[$i]}&text1={$text1[$i]}&text2={$text2[$i]}&font={$font[$i]}&picon={$picon[$i]}";
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_mini.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>images/display_mini.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
											 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
											</OBJECT><br>
											<?
										} //end if

									}	// end for
					


//								}
						  
							}
							elseif($qdata["type"]==18)
							{
										if($qdata["text5"]==1){
											// vinyl
											$width = "300";
											$height = "100";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											$swfstring = "?type=7&pic={$qdata["pic"]}&text1={$qdata["text1"]}&text2={$qdata["text2"]}&font={$qdata["font"]}&picon={$qdata["picon"]}&split={$qdata["split"]}";
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_vinyl" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_allergy_vinyl.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>images/display_allergy_vinyl.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
											 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
											</OBJECT>
											<?
										}
										elseif($qdata["text5"]==3){
											// mini's
											$width = "164";
											$height = "63";
											if($from=="admin"){
												$width*=2;
												$height*=2;
											}
											$swfstring = "?type=2&pic={$qdata["pic"]}&text1={$qdata["text1"]}&text2={$qdata["text2"]}&font={$qdata["font"]}&picon={$qdata["picon"]}";
											?>
											<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
											 codebase="<? echo $codebase;?>"
											 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_mini" ALIGN="">
											 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_allergy_mini.swf<? echo $swfstring;?>">
											 <PARAM NAME=quality VALUE=high>
											 <PARAM NAME=bgcolor VALUE=#FFFFFF>
											 <EMBED src="<? echo $aim;?>images/display_allergy_mini.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_mini" ALIGN=""
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
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"] . "&background_colour=" . $qdata['data_colour_id'] . "&font_colour=" . $qdata['data_font_colour_id'];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_coloured_ironon.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>images/display_coloured_ironon.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
							}
							elseif((int)$qdata['type'] == 20)
							{
								$width = "160";
								$height = "160";
								if($from=="admin"){
//									$width*=2;
//									$height*=2;
								}
								$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&kidsName=".urlencode($qdata["text1"])."&kidsPhone=".urlencode($qdata["text2"])."&picon=".$qdata["picon"]."&background_colour=" . $qdata['data_colour_id'] . "&font_colour=" . $qdata['data_font_colour_id'];
																?>
								<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
								 codebase="<? echo $codebase;?>"
								 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
								 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_shoe_dots.swf<? echo $swfstring;?>">
								 <PARAM NAME=quality VALUE=high>
								 <PARAM NAME=bgcolor VALUE=#FFFFFF>
								 <EMBED src="<? echo $aim;?>images/display_shoe_dots.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
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
									$swfstring = "?type=".$qdata["type"]."&pic=".$qdata["pic"]."&text1=".urlencode($qdata["text1"])."&text2=".urlencode($qdata["text2"])."&font=".$qdata["font"]."&picon=".$qdata["picon"]."&split=".$qdata["split"] . "&background_colour=" . ($qdata['colours']+8) . "&font_colour=" . $qdata['data_font_colour_id'];
									?>
									<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
									 codebase="<? echo $codebase;?>"
									 WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" id="display_coloured_iron" ALIGN="">
									 <PARAM NAME=movie VALUE="<? echo $aim;?>images/display_coloured_ironon.swf<? echo $swfstring;?>">
									 <PARAM NAME=quality VALUE=high>
									 <PARAM NAME=bgcolor VALUE=#FFFFFF>
									 <EMBED src="<? echo $aim;?>images/display_coloured_ironon.swf<? echo $swfstring;?>" quality=high bgcolor=#FFFFFF  WIDTH="<? echo $width;?>" HEIGHT="<? echo $height;?>" NAME="display_vinyl" ALIGN=""
									 TYPE="application/x-shockwave-flash" PLUGINSPAGE="<? echo $pluginspace;?>"></EMBED>
									</OBJECT>
									<?
							}
						}
						  ?>
						  </td>
						</tr>
					</table></td>
				<td rowspan="2"><img src="<? echo $aim;?>images/spacer_trans.gif" width="1" height="1"></td>
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
						  <td width="9%" rowspan="9" class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						  <td width="3%" rowspan="9"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						  <td class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
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
					elseif($qdata['type']==17){
						// shared pack
						$types=array('', 'Vinyl Labels', 'Iron-on Labels', 'Mini Vinyl Labels');
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

								
							<?
						}else{
							?>
							<tr> 
							  <td width="9%" rowspan="15" class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
							  <td class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
							  <td width="3%" rowspan="15"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
							  <td class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
							</tr>
							<tr> 
							  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
							  <td width="22%" class="maintext"><strong>Product:</strong></td>
							  <td width="66%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
							  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
							</tr>
							<?
						}	
						?>

						<tr> 
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext"><strong>Pack1</strong></td>
						  <td class="maintext"></td>
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						</tr>
						<tr> 
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext">Type:</td>
						  <td class="maintext"> <?=$types[$pack[0]];?></td>
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						</tr>
						<?
						if($pack1!=2)
						{
							?>
						<tr> 
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext">Colours: </td>
						  <td class="maintext"><?=$colour1;?></td>
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						</tr>
							<?
						}
							?>
							<tr> 
							  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
							  <td class="maintext">Pic:</td>
							  <td class="maintext"><?= ($picon[0]==1)?getPicType($pic[0]):"";?></td>
							  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
							</tr>
						<tr> 
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext">Font: </td>
						  <td class="maintext"><?=getRealFontNumber($font[0]);?></td>
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
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
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext"><strong>Pack2</strong></td>
						  <td class="maintext"></td>
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						</tr>
						<tr> 
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext">Type:</td>
						  <td class="maintext"> <?=$types[$pack[1]];?></td>
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						</tr>
						<?
						if($pack2!=2)
						{
							?>
						<tr> 
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext">Colours: </td>
						  <td class="maintext"><?=$colour2;?></td>
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						</tr>
							<?
						}
							?>
							<tr> 
							  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
							  <td class="maintext">Pic: </td>
							  <td class="maintext"><?= ($picon[1]==1)?getPicType($pic[1]):""; ?></td>
							  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
							</tr>
						<tr> 
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext">Font: </td>
						  <td class="maintext"><?=getRealFontNumber($font[1]);?></td>
						  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
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
							  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
							  <td class="maintext" colspan=4>&nbsp;</td>
							  <td class="maintext">&nbsp;</td>
							</tr>
							<tr> 
							  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
							  <td class="maintext">Total:</td>
							  <td class="maintext"><? echo $cur['symbol'].toDollarsAndCents($qdata["price"]);?></td>
							  <td width="9%"  class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
							</tr>
							<?
						}

				
					}
					elseif((int)$qdata['type'] == 19 || (int)$qdata['type'] == 3 || (int)$qdata['type'] == 20)
					{
//						debug_showvar($qdata);
						// coloured iron-ons
						// & mini labels
						// & shoedots
						
						if( (int)$qdata['data_colour_id']==0)
						{
							// old format, bg = yellow, font = black;
							$sql = "SELECT data_font_colour_name FROM data_font_colour WHERE data_font_colour_id=" . VINYL_OLD_DEFAULT_FONT_COLOUR;
							$colour_result = db_get_field($sql, $font_colour_name);
							if($colour_result = false)
							{
								$font_colour_name="ERROR";
							}
							$sql = "SELECT data_colour_name FROM data_colour WHERE data_colour_id=" . VINYL_OLD_DEFAULT_BACKGROUND_COLOUR;
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
						  <td width="9%" rowspan="9" class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						  <td width="3%" rowspan="9"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						  <td class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
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
						<tr> 
							<td class="maintext">Pic:</td>
							<td class="maintext"><?
							if($qdata["picon"]=="1"){
								echo getPicType($qdata["pic"]);
						  	}else{
						  		echo "none";
						  	}
						  	?></td>
						</tr>
						<?
						
					}
					
					elseif((int)$qdata['type'] == 21)
					{
						// colour my world pack
						?>
						<tr> 
						  <td width="9%" rowspan="9" class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						  <td width="3%" rowspan="9"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						  <td class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						</tr>
						<tr> 
						  <td width="44%" class="maintext"><strong>Product:</strong></td>
						  <td width="56%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
						</tr>
						<tr> 
							<td class="maintext">Colours:</td>
							<td class="maintext"><? 
								db_get_field("SELECT data_colour_name FROM data_colour WHERE data_colour_id=" . ((int)$qdata['colours'] + SINGLE_COLOURS), &$colour_name);
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
								echo getPicType($qdata["pic"]);
						  	}else{
						  		echo "none";
						  	}
						  	?></td>
						</tr>
						
						<tr> 
						  <td class="maintext">identiTAG:</td>
						  <td class="maintext"><? echo strtoupper($qdata['data_identitag_name']);?></td>
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
								<td><? echo "<img src = 'http://devel.identikid.com.au/images/ziptags/".$pic.".gif'>"?></td>
							</tr>
							<?php
							if ( $qdata["text1"] != '' ) {?>
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
				
					else{
		
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
						  <td width="9%" rowspan="8" class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
						  <td class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						  <td width="3%" rowspan="8"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						  <td class="maintext"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						</tr>
						<tr> 
						  <td width="22%" class="maintext"><strong>Product:</strong></td>
						  <td width="66%" class="maintext"><strong><? echo getLabelType($qdata["type"]);?></strong></td>
						</tr>
						<?

						 if($qdata["type"]!=13 && $qdata["type"]!=14 && $qdata["type"]!="15" && $qdata['type']!=18 && $qdata['type']!=19 && $qdata['type']!=20){
							?>
							<tr> 
							  <td class="maintext"><? if($qdata["type"]==7){?>Pack:<? }else{ ?>Colours:<? }?></td>
							  <td class="maintext"><?
							  if($qdata["type"]==5 || $qdata["type"]==6 || $qdata["type"]==7 || $qdata["type"]>9){
									if($qdata["colours"]==2){
										//echo "Boys Colours";
									}else{
									//	echo "Girls Colours";
									}
							  }
							  elseif($qdata["type"]==1){ // Vinyl Labels Colours
							  	$thecol = $qdata["colours"];
							 	 if ($thecol == 9){
							 	 //	echo "Girls Colours";
								  }elseif ($thecol == 10){
							  //		echo "Boys Colours";
							 	 }else{	
									$mysql = "SELECT data_colour_name FROM data_colour WHERE data_colour_id = '$thecol'";
							  		$myresult = mysql_query($mysql) or die (mysql_error());
							 	 	while ($myrow = mysql_fetch_assoc($myresult))
							  		{
							  			echo $myrow["data_colour_name"];
							  		}
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
							  <td class="maintext"><?=$desc?></td>
							</tr>
							<?
						}
	
	
						if($qdata["type"]!=7 && $qdata["type"]!=13 && $qdata["type"]!=14 && $qdata["type"]!="15" && $qdata['type']!=18)
						{
							?>
							<tr> 
							  <td class="maintext">Pic:</td>
							  <td class="maintext"><? if($qdata["picon"]=="1"){ echo getPicType($qdata["pic"]); }else{ echo "none"; }?></td>
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
								  <td class="maintext">Pack Type:</td>
								  <td class="maintext"><? echo $typeDetailDes;?></td>
								</tr>
								<?
						}
	
							// new baby pack
							if($qdata["type"]==16 && $from!="admin"){
								?>
								<tr> 
								  <td class="maintext" valign=top>Pack Type:</td>
								  <td class="maintext">40 Mini Labels, 20 Iron Ons, 1 identiTAG, 1 Gift Box, 1 kidcard</td>
								</tr>
								<?
							}
	
			
						}


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
							  <td class="maintext">Gift Card:</td>
							  <td class="maintext"><?=getPicType($qdata['text5'])?></td>
							</tr>
							<? 
						}
	
	
	
	
						// identitag
						if( ($qdata["type"]==10 || $qdata['type']==16) && $qdata["text3"]!=""){?>
						<tr> 
						  <td class="maintext">identiTAG:</td>
						  <td class="maintext"><? echo getIdentitagDesc(strtoupper($qdata["text3"]));?></td>
						</tr>
						<? }
	
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
										<br><br>
								<?
									}
								}
							}
							
							// if reverse text checked
							else
							{
								for ($t=1; $t<13; $t++)
								{
									if($myrow["text".$t] && $myrow["text".$t]!="")
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
					 	}
					// end if type =14
					}
					
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
							  <td class="maintext"><?=$desc;?></td>
							</tr>
							<tr> 
							  <td class="maintext">Colours:</td>
							  <td class="maintext"><?=($qdata['colours']==2)?"Boys Colours":"Girls Colours";?></td>
							</tr>
							
							<tr> 
							  <td class="maintext">Pic:</td>
							  <td class="maintext"><? if($qdata["picon"]=="1"){ echo getAllergyPicType($qdata["pic"]); }else{ echo "none"; }?></td>
							</tr>
							<tr> 
							  <td class="maintext">Font:</td>
							  <td class="maintext"><? echo getRealFontNumber($qdata["font"]);?></td>
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
							

						?>
						<tr> 
						  <td class="maintext">Total:</td>
						  <td class="maintext"><? echo $cur['symbol'].toDollarsAndCents($qdata["price"]);?></td>
						</tr>
						<? if($from=="admin" && ($qdata["type"]==10 || $qdata["type"]==11 || $qdata["type"]==12 || $qdata['type']==16)){ ?>
								</table>
							</td>
							<td><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="1"></td>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<? if($qdata["type"]==10){ ?>
									<tr>
										<td class="maintext">
										<strong>Starter Pack � <?=$cur[$currency]['symbol'];?><?=$qdata["price"]?></strong><br>
										40 vinyls<br>
										40 iron-ons<br>
										20 shoe labels<br>
										1 bagtags<br>
										30 mini labels or 60 pencil labels</td>
									</tr>
									<? }else if($qdata["type"]==11){ ?>
									<tr>
										<td class="maintext">
										<strong>Mixed Pack � <?=$cur[$currency]['symbol'];?><?=$qdata["price"]?> per child</strong><br>
										30 vinyls<br>
										30 iron-ons</td>
									</tr>
									<? }else if($qdata["type"]==12){ ?>
									<tr>
										<td class="maintext">
										<strong>Birthday Pack � <?=$cur[$currency]['symbol'];?><?=$qdata["price"]?></strong><br>
										30 vinyls<br>
										30 iron-ons<br>
										Giftbox<br>
										Gift Card<br>
										Matching ribbon</td>
									</tr>
									<?
								}else if($qdata["type"]==16){ 			// new baby pack
									?>
									<tr>
										<td class="maintext">
										<strong>New Baby Pack � <?=$cur[$currency]['symbol'];?><?=$qdata["price"]?></strong><br>
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
						$filename="products_vinyl_labels.php";
					}else if($qdata["type"]==2){
						$filename="products_iron_labels.php";
					}else if($qdata["type"]==3){
						$filename="products_mini_vinyls.php";
					}else if($qdata["type"]==4){
						$filename="products_shoe_labels.php";
					}else if($qdata["type"]==5){
						$filename="products_pencil_labels.php";
					}else if($qdata["type"]==6){
						$filename="products_bag_tags.php";
					}else if($qdata["type"]==7){
						$filename="products_kidcards.php";
					}else if($qdata["type"]==8){
						$filename="products_diy_labels.php";
					}else if($qdata["type"]==9){
						$filename="products_diy_labels.php";
					}else if($qdata["type"]==10){
						$filename="products_starter_packs.php";
					}else if($qdata["type"]==11){
						$filename="products_mixed_pack.php";
					}else if($qdata["type"]==12){
						$filename="products_birthday_pack.php";
					}
					elseif($qdata["type"]=="15"){
						if(strpos($qdata["quantdesc"], "Boy")){
							$filename = "boy_gift_voucher.php";
						}elseif(strpos($qdata["quantdesc"], "Girl")){
							$filename = "girl_gift_voucher.php";
						}elseif(strpos($qdata["quantdesc"], "New Baby")){
							$filename = "baby_gift_voucher.php";
						}else{
							$filename="products_gift_voucher.php";
						}
					}
					elseif($qdata['type']==16){
						$filename="products_new_baby_pack.php";
					}
					elseif($qdata['type']==17){
						$filename="products_shared_packs.php";
					}
					elseif($qdata['type']==18){
						$filename = "products_allergy_alert.php";
					}
					elseif($qdata['type']==19){
						$filename = "products_coloured_ironons.php";
					}
					elseif($qdata['type']==20){
						$filename = "products_shoe_dots.php";
					}
					elseif($qdata['type']==21){
						$filename = "products_colour_my_world_pack.php";
					}
					elseif($qdata['type']==22 || $qdata['type']==23){
						$filename = "products_ziptags.php";
					}
					else {
						$filename = "products_home.php";
					}
					?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td><a href="<? echo $filename;?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('<? echo "im".$qdata["basketid"]."1";?>','','images/button_more_info_small_mo.gif',1)"><img src="<? echo $aim;?>images/button_more_info_small.gif" name="<? echo "im".$qdata["basketid"]."1";?>" width="86" height="22" border="0"></a></td>
						</tr>
						<tr class="noshow">
						  <td><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="10"></td>
						</tr>
						<tr class="noshow">
						  <td>
						  <form name="remove<? echo $qdata["basketid"];?>" method="post" action="remove_item.php">
						  <input type="hidden" name="id" value="<? echo $qdata["basketid"];?>">
						  </form>
						  <img src="<? echo $aim;?>images/button_remove_item.gif" alt="Remove Item" name="<? echo "im".$qdata["basketid"]."2";?>" width="86" height="22" border="0" id="remove_item1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('<? echo "im".$qdata["basketid"]."2";?>','','images/button_remove_item_mo.gif',1)" onClick="if(window.confirm('Really remove this item?') == true){ document.forms['remove'+<? echo $qdata["basketid"];?>].submit();}"></td>
						</tr>
					  </table>
					  </td>
					</tr>
				<? }?>
				<tr class="noshow">
				<td colspan="3">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td width="5%" rowspan="3"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
					  <td width="95%"><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="20"></td>
					</tr>
					<tr>
					  <td><div align="center"><img src="<? echo $aim;?>images/seperator_grey_line.gif" width="100%" height="1"></div></td>
					</tr>
					<tr>
					  <td><img src="<? echo $aim;?>images/spacer_trans.gif" width="10" height="20"></td>
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
		<td width="73%"><img src="<? echo $aim;?>images/spacer_trans.gif" width="1" height="10"></td>
	</tr>
	<tr> 
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="maintext">
			<tr> 
			  <td width="7%"><img src="<? echo $aim;?>images/spacer_trans.gif" width="25" height="10"></td>
			  <td width="93%">Nothing ordered yet!</td>
			</tr>
		</table>
	</td>
	</tr>
	<tr class="noshow"> 
		<td width="73%"><img src="<? echo $aim;?>images/spacer_trans.gif" width="1" height="10"></td>
	</tr><?
	}
}
?>