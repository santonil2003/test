<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Secure Payment</title>
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
<style>

body {
	margin: 0;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="Label,labels,labelling,personalised,labels,name,identikid,identi,kid,sticker,stickers,vinyl,iron,iron-on,tag,shoes,pencil,pack,fabric,bag,child,kidcards,kid,cards,clothing,lost,property,school">
<meta name="description" content="Personalised name labels that really work.  Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more.  Design your own labels online, with your choice of fun fonts and pictures.  All products are high quality, attractive and easy to use.">
<script type="text/javascript" src="../javascript/validation.js"></script>
<script type="text/javascript">
<!--//
function validateForm(form) {
	var ccform = false;

	if ( validateFilled(form.Cust_Name, 'name') &&
		validateFilled(form.cc1, 'Credit card number') &&
		validateFilled(form.cc2, 'Credit card number') &&
		validateFilled(form.cc3, 'Credit card number') &&
		validateFilled(form.cc4, 'Credit card number') &&
		validateNumber(form.cc1, 'Credit card number', 4) &&
		validateNumber(form.cc2, 'Credit card number', 4) &&
		validateNumber(form.cc3, 'Credit card number', 4) 
		){

		var cvv_number=4;
		if(form.Cust_CardType[form.Cust_CardType.selectedIndex].value=="Amex")
		{	// validate for 3 CC numbers at end (AMEX cards are 15 in length)

			cvv_number=4;
			if(!validateNumber(form.cc4, 'Credit card number', 3))
			{
				return false;
			}
		}
		else {
			cvv_number=3
			if(!validateNumber(form.cc4, 'Credit card number', 4))
			{
				return false;
			}
		}

	<?PHP
	// if order is from admin, it doesnt ask for the CVV code.
	if(!isset($_SESSION['fromAdmin']) && !$_SESSION['fromAdmin']){
		?>
		if(!validateNumber(form.Cust_CVV, 'Credit card security code', cvv_number))
		{
			return false;
		}
		<?
	}

	?>



		var currentMonth = parseInt("<?=date("m")?>");
		var currentYear  = parseInt("<?=date("y")?>");
		var ccMonth = parseFloat(form.Cust_Card_MM[form.Cust_Card_MM.selectedIndex].value);
		var ccYear  = parseFloat(form.Cust_Card_YY[form.Cust_Card_YY.selectedIndex].value);

		var ccvalid = false;
		if( ccYear > currentYear || ( ccYear == currentYear && ccMonth >= currentMonth ) )
		{	// cc is valid
			return true;
		}
		else {
			self.alert("Please enter a valid expiry date");
			return false;
		}
	}
	else {
		return false;
	}
}

function backForm(f)
{
	f.section.value="getcc";
	f.submit();
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

//-->
</script>
</head>
<body> 
			<table width="100%" border="0" cellspacing="0" cellpadding="0" height=100%> 
				<tr> 
					<td width="181" valign="top" background="../images/bg_left_column.gif"><table width="181" border="0" cellspacing="0" cellpadding="0">
							<tr> 
								<td><a href="http://www.identikid.com.au"><img src="../images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td> 
							</tr> 
							<tr> 
								<td><a href="http://www.identikid.com.au"><img src="../images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td> 
							</tr> 
							<tr> 
								<td><a href="http://www.identikid.com.au"><img src="../images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td> 
							</tr> 
						</table></td> 
					<td valign="top" bgcolor="#FFFFFF"><table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" width=100% height=100%> 
							<tr valign="top"> 
								<td height=62><table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor="#5d7eb9">
										<tr>
											<td align=center><img src="../images/heading_labels_for_littlies.gif" alt="Labels for littlies" width="304" height="62"></td>
											<td align=right width=141>
											<!--<img src="../images/image_phone_heading.gif" alt="Ph: 1300 133 949" width="141" height="62" align=right>-->
											 <img border="0" src="../font.php?size=15&text={PH: +61 2 6921 2888}&textColour=ffffff&bgColour=5c7db8"  alt="61 2 6921 2888" align="right">
											</td>
									</table></td>
							</tr>
							<tr bgcolor="#FF0000"> 
								<td bgcolor="#6FFF6F" valign="top" align=center height=65><?

if(!empty($receiptHeader)){
	$headerGraphic = "heading_receipt.gif";
}
else {
	$headerGraphic = "heading_secure_area.gif";
}

?>
<img src="../images/<?=$headerGraphic?>" height=65></td>
							</tr>
							</tr>
								<td bgcolor="#FFFFFF" valign=top> 
									<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
										<tr valign="top" bgcolor="#FFFFFF"> 
											<td><img src="../images/spacer_trans.gif" width="10" height="15"></td> 
										</tr>
										<tr>
											<td>
												<table  border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">	
													<tr>
														<td><img src="../images/spacer_trans.gif" width="15" height="1"></td> 
														<td colspan="3" class="maintext">