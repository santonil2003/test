<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>LabSearch Australia - Renew Membership</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/labsearch.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
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
<script type="text/javascript" src="scripts/validation.js"></script>
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
		validateNumber(form.cc3, 'Credit card number', 4) &&
		validateNumber(form.cc4, 'Credit card number', 4) &&
		validateSelected(form.Cust_Card_MM, 'Credit card expiry') &&
		validateSelected(form.Cust_Card_YY, 'Credit card expiry') &&
		validateNumber(form.Cust_CVV, 'Credit card security code', 3) ){

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

//-->
</script>
</head>

<body leftmargin="0" topmargin="0" onLoad="MM_preloadImages('images/button_submit_mo.gif','images/button_back_mo.gif');">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td valign="top">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr valign="top"> 
          <td width="17"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/left_column_header.gif" width="17" height="69"></td>
              </tr>
            </table></td>
          <td width="100%">
            <?php include"header.php" ?>
          </td>
          <td width="18"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/right_column_header.gif" width="18" height="69"></td>
              </tr>
            </table></td>
          <td width="190">
            <?php include"top_blue.php" ?>
          </td>
        </tr>
        <tr valign="top"> 
          <td background="images/grey_line_vertical.gif"> <table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td valign="bottom"><img src="images/grey_line_horizontal.gif" width="17" height="1"></td>
              </tr>
            </table></td>
          <td width="100%"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top"> 
                <td><img src="images/picture_top_strip.jpg" width="100%" height="2"></td>
              </tr>
              <tr valign="top"> 
                <td>
                  <?php include"content_pic.php" ?>
                </td>
              </tr>
              <tr valign="top"> 
                <td><img src="images/picture_bottom_strip_content.jpg" width="100%" height="1"></td>
              </tr>
              <tr valign="top"> 
                <td>
<table width="100%" height="32" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="2%" valign="top"><img src="images/heading_left_curve.gif" width="35" height="32"></td>
                      <td width="100%" background="images/bg_heading.gif" class="heading"> 
                        Receipt - Secure Online Payment</td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top"> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top"> 
                      <td colspan="3"><img src="images/spacer_trans.gif" width="100%" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td width="20"><img src="images/spacer_trans.gif" width="10" height="10"></td>
 
                     <td width="100%" valign="top" class="maintext">