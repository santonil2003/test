<?php
	include("../common_db.php");
	linkme();
session_start();
$user_section_id = 5;
require_once("./security.php");
check_access($user_section_id);

	
	$type = $_GET["type"];
	$items = split(";",$_GET["id"]);
	$startpoint = ($_GET["page"]-1)*16;
	
	function getAusState($state){
		if($state=="New South Wales"){
			return "NSW";
		}else if($state=="Australian Capital Territory"){
			return "ACT";
		}else if($state=="Western Australia"){
			return "WA";
		}else if($state=="South Australia"){
			return "SA";
		}else if($state=="Queensland"){
			return "QLD";
		}else if($state=="Tasmania"){
			return "TAS";
		}else if($state=="Northern Territory"){
			return "NT";
		}else if($state=="Victoria"){
			return "VIC";
		}else{
			return $state;
		}
	}

	$endpoint = (($startpoint+16)<count($items)) ? $startpoint+16 : count($items);
	
	for($i=$startpoint; $i<$endpoint; $i++){ 
		if($items[$i]!=""){
			if($type=="byInv"){
				$query = "SELECT * FROM orders a, customers b WHERE a.id=".$items[$i]." AND b.id=a.customer";
			}else{
				$query = "SELECT * FROM customers WHERE id=".$items[$i];
			}
			$result = mysql_query($query);
			if(!$result) error_message(sql_error());
			while($qdata = mysql_fetch_array($result)){
				$firstname[$i] = $qdata["firstname"];
				$surname[$i] = $qdata["surname"];
				$address[$i] = $qdata["address"];
				$suburb[$i] = $qdata["suburb"];
				$postcode[$i] = $qdata["postcode"];
				$state[$i] = $qdata["state"];
				$country[$i] = $qdata["country"];
			}
		}else{
			$firstname[$i] = $surname[$i] = $address[$i] = $suburb[$i] = $postcode[$i] = $state[$i] = $country[$i] = "";
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"> 
	<p class="addresslabels">&nbsp;</p>
	<table cellpadding="0" cellspacing="0" border="0"> 
		<!-- Label Numbers 1 and 2 -->
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td width="400" class="addresslabels">
				<?php
					if (!empty($address[$startpoint])){
						echo "<strong>" . $firstname[$startpoint] . " " . $surname[$startpoint] . "</strong><br>" . stripslashes($address[$startpoint]) . "<br>" . $suburb[$startpoint] . " " . getAusState($state[$startpoint])." ".$postcode[$startpoint]."<br>"; if((strtolower($country[$startpoint]) == "australia") OR (strtolower($country[$startpoint]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td width="65"><img src="../images/spacer_trans.gif" height="8" width="65" border="0"></td>
			<td width="400" class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 1])){
						echo "<strong>" . $firstname[$startpoint + 1] . " " . $surname[$startpoint + 1] . "</strong><br>" . stripslashes($address[$startpoint + 1]) . "<br>" . $suburb[$startpoint + 1] . " " . getAusState($state[$startpoint + 1])." ".$postcode[$startpoint + 1]."<br>"; if((strtolower($country[$startpoint + 1]) == "australia") OR (strtolower($country[$startpoint + 1]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 1]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 3 and 4 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="25" width="1" border="0"></td>
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 2])){
						echo "<strong>" . $firstname[$startpoint + 2] . " " . $surname[$startpoint + 2] . "</strong><br>" . stripslashes($address[$startpoint + 2]) . "<br>" . $suburb[$startpoint + 2] . " " . getAusState($state[$startpoint + 2])." ".$postcode[$startpoint + 2]."<br>"; if((strtolower($country[$startpoint + 2]) == "australia") OR (strtolower($country[$startpoint + 2]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 2]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 3])){
						echo "<strong>" . $firstname[$startpoint + 3] . " " . $surname[$startpoint + 3] . "</strong><br>" . stripslashes($address[$startpoint + 3]) . "<br>" . $suburb[$startpoint + 3] . " " . getAusState($state[$startpoint + 3])." ".$postcode[$startpoint + 3]."<br>"; if((strtolower($country[$startpoint + 3]) == "australia") OR (strtolower($country[$startpoint + 3]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 3]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>		
		</tr>
		<!-- Label Numbers 5 and 6 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="25" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 4])){
						echo "<strong>" . $firstname[$startpoint + 4] . " " . $surname[$startpoint + 4] . "</strong><br>" . stripslashes($address[$startpoint + 4]) . "<br>" . $suburb[$startpoint + 4] . " " . getAusState($state[$startpoint + 4])." ".$postcode[$startpoint + 4]."<br>"; if((strtolower($country[$startpoint + 4]) == "australia") OR (strtolower($country[$startpoint + 4]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 4]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 5])){
						echo "<strong>" . $firstname[$startpoint + 5] . " " . $surname[$startpoint + 5] . "</strong><br>" . stripslashes($address[$startpoint + 5]) . "<br>" . $suburb[$startpoint + 5] . " " . getAusState($state[$startpoint + 5])." ".$postcode[$startpoint + 5]."<br>"; if((strtolower($country[$startpoint + 5]) == "australia") OR (strtolower($country[$startpoint + 5]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 5]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 7 and 8 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="25" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 6])){
						echo "<strong>" . $firstname[$startpoint + 6] . " " . $surname[$startpoint + 6] . "</strong><br>" . stripslashes($address[$startpoint + 6]) . "<br>" . $suburb[$startpoint + 6] . " " . getAusState($state[$startpoint + 6])." ".$postcode[$startpoint + 6]."<br>"; if((strtolower($country[$startpoint + 6]) == "australia") OR (strtolower($country[$startpoint + 6]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 6]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 7])){
						echo "<strong>" . $firstname[$startpoint + 7] . " " . $surname[$startpoint + 7] . "</strong><br>" . stripslashes($address[$startpoint + 7]) . "<br>" . $suburb[$startpoint + 7] . " " . getAusState($state[$startpoint + 7])." ".$postcode[$startpoint + 7]."<br>"; if((strtolower($country[$startpoint + 7]) == "australia") OR (strtolower($country[$startpoint + 7]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 7]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 9 and 10 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="27" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 8])){
						echo "<strong>" . $firstname[$startpoint + 8] . " " . $surname[$startpoint + 8] . "</strong><br>" . stripslashes($address[$startpoint + 8]) . "<br>" . $suburb[$startpoint + 8] . " " . getAusState($state[$startpoint + 8])." ".$postcode[$startpoint + 8]."<br>"; if((strtolower($country[$startpoint + 8]) == "australia") OR (strtolower($country[$startpoint + 8]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 8]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 9])){
						echo "<strong>" . $firstname[$startpoint + 9] . " " . $surname[$startpoint + 9] . "</strong><br>" . stripslashes($address[$startpoint + 9]) . "<br>" . $suburb[$startpoint + 9] . " " . getAusState($state[$startpoint + 9])." ".$postcode[$startpoint + 9]."<br>"; if((strtolower($country[$startpoint + 9]) == "australia") OR (strtolower($country[$startpoint + 9]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 9]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 11 and 12 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="27" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 10])){
						echo "<strong>" . $firstname[$startpoint + 10] . " " . $surname[$startpoint + 10] . "</strong><br>" . stripslashes($address[$startpoint + 10]) . "<br>" . $suburb[$startpoint + 10] . " " . getAusState($state[$startpoint + 10])." ".$postcode[$startpoint + 10]."<br>"; if((strtolower($country[$startpoint + 10]) == "australia") OR (strtolower($country[$startpoint + 10]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 10]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="8" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 11])){
						echo "<strong>" . $firstname[$startpoint + 11] . " " . $surname[$startpoint + 11] . "</strong><br>" . stripslashes($address[$startpoint + 11]) . "<br>" . $suburb[$startpoint + 11] . " " . getAusState($state[$startpoint + 11])." ".$postcode[$startpoint + 11]."<br>"; if((strtolower($country[$startpoint + 11]) == "australia") OR (strtolower($country[$startpoint + 11]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 11]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 13 and 14 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="27 width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 12])){
						echo "<strong>" . $firstname[$startpoint + 12] . " " . $surname[$startpoint + 12] . "</strong><br>" . stripslashes($address[$startpoint + 12]) . "<br>" . $suburb[$startpoint + 12] . " " . getAusState($state[$startpoint + 12])." ".$postcode[$startpoint + 12]."<br>"; if((strtolower($country[$startpoint + 12]) == "australia") OR (strtolower($country[$startpoint + 12]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 12]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 13])){
						echo "<strong>" . $firstname[$startpoint + 13] . " " . $surname[$startpoint + 13] . "</strong><br>" . stripslashes($address[$startpoint + 13]) . "<br>" . $suburb[$startpoint + 13] . " " . getAusState($state[$startpoint + 13])." ".$postcode[$startpoint + 13]."<br>"; if((strtolower($country[$startpoint + 13]) == "australia") OR (strtolower($country[$startpoint + 13]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 13]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 15 and 16 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="27" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 14])){
						echo "<strong>" . $firstname[$startpoint + 14] . " " . $surname[$startpoint + 14] . "</strong><br>" . stripslashes($address[$startpoint + 14]) . "<br>" . $suburb[$startpoint + 14] . " " . getAusState($state[$startpoint + 14])." ".$postcode[$startpoint + 14]."<br>"; if((strtolower($country[$startpoint + 14]) == "australia") OR (strtolower($country[$startpoint + 14]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 14]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="8" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 15])){
						echo "<strong>" . $firstname[$startpoint + 15] . " " . $surname[$startpoint + 15] . "</strong><br>" . stripslashes($address[$startpoint + 15]) . "<br>" . $suburb[$startpoint + 15] . " " . getAusState($state[$startpoint + 15])." ".$postcode[$startpoint + 15]."<br>"; if((strtolower($country[$startpoint + 15]) == "australia") OR (strtolower($country[$startpoint + 15]) == "")){ echo "&nbsp;"; }else{ echo $country[$startpoint + 15]; }
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
	</table>
	<p class="addresslabels">&nbsp;</p> 
</body>
</html>
