<?
$includeabove=true;
include("../useractions.php");
include("currencymanager_functions.php");
linkme();

session_start();
$user_section_id = 6;
require_once("./security.php");
check_access($user_section_id);


$prods = getProducts();
$curr = getCurrencies();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Identikid Admin - Currency/Price Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/identi kid.css" rel="stylesheet" type="text/css">
</head>

<style>
	input, select {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
	}
	.tiny {
		font-size:9px;
	}
</style>

<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" bgcolor="#5D7EB9">
        <tr bgcolor="#FFFFFF"> 
          <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="650" border="0"></td>
          <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td class="admintext"><strong>Currency/Price Manager</strong></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td align="center" class="admintext"> <input name="back" type="button" onClick="location.href='orders_admin.php?startrecord=<? echo $startrecord;?>&showperpage=<? echo $showperpage;?>'" value="&lt; Back"> 
          </td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td align="center" class="admintext">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center" class="admintext"><table width="80%" border="0" align="left">
				<?PHP 
					$sql = "SELECT * FROM prices_reverse_text WHERE prod_id = 14";
					$result = mysql_query($sql) or die("sql error reverse text");
					$row = mysql_fetch_assoc($result);
				?>
				<tr>
                <td valign="top"><form name="identireverse" action="currencymanager_actions.php" method="post">
                  	<input type="hidden" name="action" value="updateidentireverse">
				<div align="right"><strong>IdentiTAGs reverse text price</strong></div></td>
                <td valign="top"><img src="../images/spacer_trans.gif" height="8" width="10" border="0"></td>
                <td valign="top"><input name="reverse_identi" type="text" id="reverse_identi" size="5" value="<?php echo $row["reverse_text_price"]; ?>"></td>
                <td valign="top"><input name="reverseidenti" type="submit" id="reverseidenti" value="update &gt;"></form></td>
              </tr>
				<?PHP 
					$sql = "SELECT * FROM prices_reverse_text WHERE prod_id = 22";
					$result = mysql_query($sql) or die("sql error reverse text");
					$row = mysql_fetch_assoc($result);
				?>			  
			 <tr>
                <td valign="top"><form name="zip3" action="currencymanager_actions.php" method="post">
                  	<input type="hidden" name="action" value="updatezip3">
				<div align="right"><strong>Ziptags reverse text price per tag</strong></div></td>
                <td valign="top"><img src="../images/spacer_trans.gif" height="8" width="10" border="0"></td>
                <td valign="top"><input name="zip3" type="text" id="zip3" size="5" value="<?php echo $row["reverse_text_price"]; ?>"></td>
                <td valign="top"><input name="updatezip3" type="submit" id="updatezip3" value="update &gt;"></form></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="10" width="1" border="0"></td>
        </tr>
        <tr> 
          <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
          <td> <table cellpadding="0" cellspacing="0" border="0">
              <tr class="admintext"> 
                <td colspan="3"><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <? for($j=0; $j<count($curr); $j++){ ?>
                <td width="75" valign="bottom"><strong><? echo $curr[$j]['symbol'];?></strong><br> 
                  <font class="tiny"><? echo $curr[$j]['currName'];?></font></td>
                <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
                <? }?>
              </tr>
              <? for($i=0; $i<count($prods); $i++){ ?>
              <tr class="admintext"> 
                <td align="left"><? echo "<strong>".$prods[$i]['productName']."</strong>"; if($prods[$i]['id']!=6){ echo " (".$prods[$i]['unitQuant']." per unit)"; }?></td>
                <form name="prod<? echo $prods[$i]['id'];?>" action="currencymanager_actions.php" method="post">
                  <input type="hidden" name="action" value="updateprices">
                  <input type="hidden" name="productId" value="<? echo $prods[$i]['id'];?>">
                  <? 
								if($prods[$i]['id']==6){
									?>
                  <td align="right"> <table cellpadding="0" cellspacing="0" border="0">
                      <tr> 
                        <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
                        <td>for <? echo $prods[$i]['unitQuant']?></td>
                      </tr>
                      <tr> 
                        <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
                        <td>for <? echo $prods[$i]['unitQuant']*2?></td>
                      </tr>
                    </table></td>
                  <?
								}else if($prods[$i]['id']==14){
									?>
                  <td align="right"> <table cellpadding="0" cellspacing="0" border="0">
                      <tr> 
                        <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
                        <td>for <? echo $prods[$i]['unitQuant']?></td>
                      </tr>
                      <tr> 
                        <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
                        <td>for <? echo $prods[$i]['unitQuant']*2?></td>
                      </tr>
                      <tr> 
                        <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
                        <td>for <? echo $prods[$i]['unitQuant']*3?></td>
                      </tr>
                      <tr> 
                        <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
                        <td>for <? echo $prods[$i]['unitQuant']*4?></td>
                      </tr>
                    </table></td>
                  <?
                     }else if($prods[$i]['id']==37){
									?>
                  <td align="right"> <table cellpadding="0" cellspacing="0" border="0">
                       <tr> 
                        <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
                        <td>Dog Collar</td>
                      </tr>
                      <tr> 
                        <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
                        <td>Cat Collar</td>
                      </tr>   
                    </table></td>
                  <?
								}else if($prods[$i]['id']==40){
									?>
                  <td align="right"> <table cellpadding="0" cellspacing="0" border="0">
                      <tr> 
                        <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
                        <td>Letter</td>
                      </tr>
                      <tr> 
                        <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
                        <td>Charm</td>
                      </tr>
                    </table></td>
                  <?
								}
								
								else{
									?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <?
								}
								
								for($j=0; $j<count($curr); $j++){ 
									if($prods[$i]['id']==6){
									$query = "SELECT * FROM prices_bagtags WHERE currencyInt=".$curr[$j]['id']." ORDER BY multiplier";
										$result = mysql_query($query);
										if(!$result) error_message(sql_error());
										$price=array();
										$k=1;
										while($qdata = mysql_fetch_array($result)){ 
											$price[$k] = $qdata['price'];
											$k++;
										}?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td> 
                    <?
										for($k=1; $k<3; $k++){?>
                    <input type="text" size="5" name="c<? echo $curr[$j]['id'].'~'.$k;?>" value="<? echo toDollarsAndCents($price[$k]);?>"> 
                    <br> 
                    <? 
										}?>
                  </td>
                  <?
									}else if($prods[$i]['id']==14){
									$query = "SELECT * FROM prices_identitags WHERE currencyInt=".$curr[$j]['id']." ORDER BY multiplier";
										$result = mysql_query($query);
										if(!$result) error_message(sql_error());
										$price=array();
										$k=1;
										while($qdata = mysql_fetch_array($result)){ 
											$price[$k] = $qdata['price'];
											$k++;
										}?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td> 
                    <?
										for($k=1; $k<5; $k++){?>
                    <input type="text" size="5" name="c<? echo $curr[$j]['id'].'~'.$k;?>" value="<? echo toDollarsAndCents($price[$k]);?>"> 
                    <br> 
                    <? 
										}?>
                  </td>
                  <?       }else if($prods[$i]['id']==36){
                  
                  			  $query = "SELECT * FROM prices_thingamejig WHERE currencyInt=".$curr[$j]['id']." AND item = 1 LIMIT 1";
                             $result = mysql_query($query);
									  if(!$result) error_message(sql_error());
										$price=array();
										$k=1;
										while($qdata = mysql_fetch_array($result)){ 
											$price[$k] = $qdata['price'];
											$k++;
										}?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td> 
                     <?
										for($k=1; $k<2; $k++){?>
                    <input type="text" size="5" name="c<? echo $curr[$j]['id'].'~'.$k;?>" value="<? echo toDollarsAndCents($price[$k]);?>"> 
                    <br> 
                     <? 
										}?>
            
                  </td>
                  <?
									}else if($prods[$i]['id']==37){
                  
                  			  $query = "SELECT * FROM prices_thingamejig WHERE currencyInt=".$curr[$j]['id']." AND item > 3 ORDER BY item LIMIT 2";
                             $result = mysql_query($query);
									  if(!$result) error_message(sql_error());
										$price=array();
										$k=4;
										while($qdata = mysql_fetch_array($result)){ 
											$price[$k] = $qdata['price'];
											$k++;
										}?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td> 
                    <?
										for($k=4; $k<6; $k++){?>
                    <input type="text" size="5" name="c<? echo $curr[$j]['id'].'~'.$k;?>" value="<? echo toDollarsAndCents($price[$k]);?>"> 
                    <br> 
                    <? 
										}?>
                  </td>
                  <?
									}else if($prods[$i]['id']==38){
                  
                  			  $query = "SELECT * FROM prices_thingamejig WHERE currencyInt=".$curr[$j]['id']." AND item = 6 LIMIT 1";
                             $result = mysql_query($query);
									  if(!$result) error_message(sql_error());
										$price=array();
										$k=6;
										while($qdata = mysql_fetch_array($result)){ 
											$price[$k] = $qdata['price'];
											$k++;
										}?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td> 
                    <?
										for($k=6; $k<7; $k++){?>
                    <input type="text" size="5" name="c<? echo $curr[$j]['id'].'~'.$k;?>" value="<? echo toDollarsAndCents($price[$k]);?>"> 
                    <br> 
                    <? 
										}?>
                  </td>
                  <?
									}else if($prods[$i]['id']==39){
                  
                  			  $query = "SELECT * FROM prices_thingamejig WHERE currencyInt=".$curr[$j]['id']." AND item = 7 LIMIT 1";
                             $result = mysql_query($query);
									  if(!$result) error_message(sql_error());
										$price=array();
										$k=7;
										while($qdata = mysql_fetch_array($result)){ 
											$price[$k] = $qdata['price'];
											$k++;
										}?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td> 
                    <?
										for($k=7; $k<8; $k++){?>
                    <input type="text" size="5" name="c<? echo $curr[$j]['id'].'~'.$k;?>" value="<? echo toDollarsAndCents($price[$k]);?>"> 
                    <br> 
                    <? 
										}?>
                  </td>
                  <?
									}else if($prods[$i]['id']==40){
                  
                  			  $query = "SELECT * FROM prices_thingamejig WHERE currencyInt=".$curr[$j]['id']." AND item > 1 ORDER BY item LIMIT 2";
                             $result = mysql_query($query);
									  if(!$result) error_message(sql_error());
										$price=array();
										$k=2;
										while($qdata = mysql_fetch_array($result)){ 
											$price[$k] = $qdata['price'];
											$k++;
										}?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td> 
                    <?
										for($k=2; $k<4; $k++){?>
                    <input type="text" size="5" name="c<? echo $curr[$j]['id'].'~'.$k;?>" value="<? echo toDollarsAndCents($price[$k]);?>"> 
                    <br> 
                    <? 
										}?>
                  </td>
                  <?
									}else{
										$query = "SELECT * FROM prices WHERE productId=".$prods[$i]['id']." AND currencyInt=".$curr[$j]['id'];
										$result = mysql_query($query);
										if(!$result) error_message(sql_error());
										$price="";
										while($qdata = mysql_fetch_array($result)){
											$price = $qdata['price'];
										}
										?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td><input type="text" size="5" name="c<? echo $curr[$j]['id'];?>" value="<? echo toDollarsAndCents($price);?>"></td>
                  <?
									}?>
                  <? }?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td><input type="submit" value="update &gt;"></td>
                </form>
              </tr>
              <? }?>
              <tr> 
                <td><img src="../images/spacer_trans.gif" height="20" width="1" border="0"></td>
              </tr><tr class="admintext">
              <form name="postage" action="currencymanager_actions.php" method="post">
                <input type="hidden" name="action" value="updatepostagegift">
                <td colspan="2" align="left"><strong>Postage &amp; Handling</strong></td>
                <? for($j=0; $j<count($curr); $j++){ ?>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td><input type="text" size="5" name="p<? echo $curr[$j]['id'];?>" value="<? echo toDollarsAndCents($curr[$j]['postage']);?>"></td>
                <? }?>
                <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                <td rowspan="2" valign="middle"><input type="submit" value="update &gt;"></td></tr>
                <tr class="admintext"> 
                  <td colspan="2" align="left"><strong>Express Post</strong></td>
                  <? for($j=0; $j<count($curr); $j++){ ?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td><input type="text" size="5" name="po<? echo $curr[$j]['id'];?>" value="<? echo toDollarsAndCents($curr[$j]['expresspost']);?>"></td>
                  <? }?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                </tr>
                <tr class="admintext"> 
                  <td colspan="2" align="left"><strong>Free Gift Cut-off</strong></td>
                  <? for($j=0; $j<count($curr); $j++){ ?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td><input type="text" size="5" name="g<? echo $curr[$j]['id'];?>" value="<? echo toDollarsAndCents($curr[$j]['freeGift']);?>"></td>
                  <? }?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                </tr>
                <tr class="admintext"> 
                  <td colspan="2" align="left"><strong>Minimum Order</strong></td>
                  <? for($j=0; $j<count($curr); $j++){ ?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td><input type="text" size="5" name="m<? echo $curr[$j]['id'];?>" value="<? echo toDollarsAndCents($curr[$j]['minimumOrder']);?>"></td>
                  <? }?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                </tr>
                <tr class="admintext"> 
                  <td colspan="2" align="left"><strong>Fundraisers Page</strong></td>
                  <? for($j=0; $j<count($curr); $j++){ ?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                  <td><input type="checkbox" size="5" name="f<? echo $curr[$j]['id'];?>"<? if($curr[$j]['fundraisers']==1){?> checked <? }?>></td>
                  <? }?>
                  <td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
                </tr>
              </form>
            </table></td>
        </tr>
      </table>
		</tr>
	</table>
</body>
</html>
