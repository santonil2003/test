<?php
	include("required.php");
	linkme();
session_start();
$user_section_id = 2;
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
				$query = "SELECT * FROM fundraisers WHERE idnumber=".$items[$i];
			}else{
				$query = "SELECT * FROM fundraisers WHERE idnumber=".$items[$i];
			}
			$result = mysql_query($query);
			if(!$result) error_message(sql_error());
			while($qdata = mysql_fetch_array($result)){
				$firstname[$i] = $qdata["fname"];
				$address[$i] = nl2br($qdata["address"]);
				$contact[$i] = $qdata["contactname"];
			}
		}else{
			$firstname[$i] = $address[$i] = $contact[$i] = "";
		}
	}
	
	
	function fontResizer($txt) {
	  $maxlength = 30;
	  $return_str = $txt;
	  if(strlen($txt) > $maxlength) {
	    $return_str = '<font style="font-size: 9px">'.$txt.'</font>'; 
	  }
	
	  return $return_str;
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi_kid.css" rel="stylesheet" type="text/css">
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"> 
	<p class="addresslabels">&nbsp;</p>
	<table cellpadding="0" cellspacimaxlengthng="0" border="0"> 
	
	
		
		<!-- 1 through 16 --> 
		<?
		
		  for( $i =0;$i <= 15;($i=$i+2)) {
		
		?>
	
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + $i])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . fontResizer(strtoupper(stripslashes($firstname[$startpoint + $i]))) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + $i])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + ($i + 1)])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . fontResizer(strtoupper(stripslashes($firstname[$startpoint + ($i + 1)]))) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + ($i + 1)])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>		
		</tr>
		<? 
		  if ($i < 14 ) { ?>
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr> 
		
		<?
		  }
		} ?>
		
		
		<? 
		
		 /*  
		
		?>
		

		<!-- Label Numbers 1 and 2 -->
				<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td width="400" class="addresslabels">
				<?php
					if (!empty($address[$startpoint])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td width="65"><img src="../images/spacer_trans.gif" height="8" width="65" border="0"></td>
			<td width="400" class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 1])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 1])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 1])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		
		<!-- Label Numbers 3 and 4 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="38" width="1" border="0"></td>
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 2])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 2])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 2])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 3])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 3])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 3])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>		
		</tr>
		<!-- Label Numbers 5 and 6 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="38" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 4])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 4])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 4])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 5])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 5])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 5])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 7 and 8 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="38" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 6])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 6])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 6])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 7])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 7])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 7])).'<br><br>';
				}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 9 and 10 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="38" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 8])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 8])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 8])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 9])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 9])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 9])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 11 and 12 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="38" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 10])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 10])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 10])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="8" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 11])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 11])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 11])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 13 and 14 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="38" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 12])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 12])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 12])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="1" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 13])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 13])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 13])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<!-- Label Numbers 15 and 16 -->
		<tr> 
			<td colspan="4"><img src="../images/spacer_trans.gif" height="38" width="1" border="0"></td> 
		</tr> 
		<tr>
			<td width="5"><img src="../images/spacer_trans.gif" height="5" width="10" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 14])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 14])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 14])).'<br><br>';
			}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
			<td><img src="../images/spacer_trans.gif" height="8" width="65" border="0"></td>
			<td class="addresslabels">
				<?php
					if (!empty($address[$startpoint + 15])){
						echo "<strong>Fundraising coordinator</strong><br><strong>" . strtoupper(stripslashes($firstname[$startpoint + 15])) . "</strong><br>" . strtoupper(stripslashes($address[$startpoint + 15])).'<br><br>';
					}else{
						echo "<br><br><br><br>";
					}
				?>
			</td>
		</tr>
		<?  
		*/ 
		 ?>
	</table>
	<p class="addresslabels">&nbsp;</p> 
</body>
</html>
