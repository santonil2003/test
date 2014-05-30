<?

if(!isset($useractions)){
	include("useractions.php");
}


if(isset($securesite) && $securesite == true){
	$id = $_POST["orderid"];
}else{
	$id = checkOrderId(false);
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi kid - Orders</title>
<script Language="JavaScript" src="/ezytrack.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="javascript.js"></script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="MM_preloadImages('images/button_view_order_mo.gif')">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="FFE500">
  <tr> 
    <td><img src="images/spacer_trans.gif" width="10" height="20"></td>
    <td rowspan="2"><img src="images/spacer_trans.gif" width="10" height="10"></td>
  </tr>
  <tr> 
    <td class="maintext"><div align="center"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><div align="center"> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr> 
                    <td width="10" class="maintext"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                    <td class="maintext"> 
                      <div align="left"><img src="images/text_your_order.gif" width="100" height="19"></div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
		  <?
		  $runningtotal=0;
		  if($id!=false){
				?>
          <tr> 
            <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
          </tr>
					<tr>
						<td align=center class=smalltext>Order ID: <?=$id+1000?></td>
					</tr>
				<?



		  	$query = "SELECT * FROM basket_items WHERE ordernumber=".$id;
		  	$result = mysql_query($query);
			if(!$result) error_message(sql_error());
			if(mysql_num_rows($result)>0){
				while($qdata = mysql_fetch_array($result)){
		  ?>
          <tr> 
            <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
          </tr>
          <tr> 
            <td> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr> 
                  <td width="10" class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                  <td width="740" class="maintext"> 
                    <div align="left"><img src="images/seperator_black_line.gif" width="100%" height="1"></div></td>
                </tr>
              </table>
              <div align="center"></div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr> 
                    <td width="10" rowspan="3" class="maintext"><img src="images/spacer_trans.gif" width="13" height="10"></td>
                    <td class="ordertext"> 
                      <div align="left"><strong>
					  <?
					  echo getLabelType($qdata["type"]);
					  ?>
					  </strong></div></td>
                  </tr>
                  <tr> 
                    <td class="ordertext"> 
                      <div align="left"><? echo $qdata["quantdesc"];?></div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
			  	<?
						$runningtotal += $qdata["price"];
					}?>
		  <tr> 
            <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
          </tr>
          <tr> 
            <td> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr> 
                  <td width="10" class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                  <td width="740" class="maintext"> 
                    <div align="left"><img src="images/seperator_black_line.gif" width="100%" height="1"></div></td>
                </tr>
              </table>
              <div align="center"></div></td>
          </tr>
		  <tr> 
			<td><div align="center"> 
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="10" class="maintext"><img src="images/spacer_trans.gif" width="13" height="10"></td>
					<td class="ordertext"> <div align="left"><strong>TOTAL:</strong></div></td>
					<td class="ordertext"><div align="right"><strong><? echo $cur['symbol'].toDollarsAndCents($runningtotal);?></strong></div></td>
				  </tr>
				</table>
			  </div></td>
		  </tr>
				<?
		}
	}
	if($id==false || mysql_num_rows($result)==0 ){?>
		  <tr> 
            <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
          </tr>
		  <tr> 
			<td class="ordertext"><div align="center">No items yet!</div></td>
		  </tr>
		  <tr> 
            <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
          </tr>
		  <tr> 
            <td align="center"><img src="images/image_noorder_boy.gif" width="75" height="95"></td>
          </tr>
	<? }?>
        </table>
      </div></td>
  </tr>
  <tr> 
    <td><img src="images/spacer_trans.gif" width="10" height="20"></td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><div align="center">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="10" class="maintext"><img src="images/spacer_trans.gif" width="10" height="10"></td>
            <td class="maintext"> 
              <div align="center">
			  <a href="view_order.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('view_order','','images/button_view_order_mo.gif',1)"><img src="images/button_view_order.gif" alt="View Order" name="view_order" width="94" height="22" border="0"></a>
			  </div></td>
          </tr>
        </table>
        
      </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><img src="images/spacer_trans.gif" width="10" height="20"></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
