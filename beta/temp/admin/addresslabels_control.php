<?
$items = split(";",$_GET["id"]);
$pages = ceil(count($items)/16);

if ($_GET["type"] == 'byInv'){
	if ($_GET["id"]){
		$invoice_numbers = $_GET["id"];
	}
}elseif ($_GET["type"] == 'byDate'){
	if ($_GET["order_ids"]){
		$invoice_numbers = $_GET["order_ids"];
	}
}
//echo '<pre>';
//print_r($_GET);
//print_r($_POST);
//echo '</pre>';
/*
if ((isset($items)) AND (count($items) > 0)){
	for ($index = 0; $index < 16; $index++){
		if ($index != 0){
			$invoice_numbers .= ";" . ($items[$index] + 1000);
		}else{
			$invoice_numbers .= ($items[$index] + 1000);
		}
	}
}
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>
<style>
	input, select {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
	}
</style>
<script language="javascript">
function newPage(){
	parent.viewer.location.href='addresslabels_labels.php?page='+document.forms[0].viewpage.value+'&id='+document.forms[0].id.value;
}

function GoBack(){
	parent.location.href='addresslabels.php?page=' + document.forms[0].viewpage.value + '&id=<? echo $invoice_numbers; ?>&startTS=<? echo $_GET["startTS"]?>&endTS=<? echo $_GET["endTS"];?>';
}
</script>

<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" bgcolor="#5D7EB9">
	<form>
	<input type="hidden" name="id" value="<? echo $_GET["id"];?>">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<tr>
			 <td><input type="button" value="&lt; back" onClick="JavaScript: GoBack();"></td>
		</tr>
		<tr>
			 <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
		</tr>
		<tr>
			<td align="center" class="admintext">View Page:
			<select name="viewpage" onChange="newPage();">
			<? for($i=1; $i<=$pages; $i++){?>
				<option value="<? echo $i;?>"><? echo $i;?></option>
			<? }?>
			</select></td>
		</tr>
		<tr>
			 <td align="center"><input type="button" value="print current page" onClick="parent.viewer.focus(); parent.viewer.print();">&nbsp;<img src="../images/arrow_down.gif" width="30" height="30" border="0"></td>
		</tr>
	</table>
	</form>
</body>

