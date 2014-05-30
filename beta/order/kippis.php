<?

function getCurrency($curr_id){
	$query = "SELECT * FROM currencies WHERE id = '{$curr_id}' LIMIT 1";
	$result = mysql_query($query);
	if(!$result) error_message(sql_error());
	
	$qdata = mysql_fetch_array($result);
	$curr = array();
	$curr['id'] = $qdata['id'];
	$curr['currName'] = $qdata['currName'];
	$curr['symbol'] = $qdata['symbol'];
	$curr['rate'] = $qdata['rate'];
	$curr['postage'] = $qdata['postage'];
	$curr['expresspost'] = $qdata['expresspost'];
	$curr['freeGift'] = $qdata['freeGift'];
	$curr['minimumOrder'] = $qdata['minimumOrder'];
	$curr['fundraisers'] = $qdata['fundraisers'];

	return $curr;
}

$curr = getCurrency($_COOKIE["currency"]);

$query = "SELECT * FROM prices a, product b WHERE a.productId='46' AND a.productId=b.id AND a.currencyInt='1'";

$result = mysql_query($query);
if(!$result) error_message(sql_error());
$qdata = mysql_fetch_array($result);
$price = number_format(round($qdata["price"]*$curr['rate'],2), 2, '.', '');

?>
<script type="text/javascript">

  var item_price = '<?=$price;?>';
  var curr_symbol = '<?=$curr['symbol'];?>';

  
  function updateDesign(){
    var designColour = $('#design').val();
    $('#text1').val(designColour);
    $('#quantdesc').val("1 "+designColour+" Kippis "+curr_symbol+item_price);   
  }
  
  $(function() {
    updateDesign();
  });
  
</script>
<form name="form1" action="addtoorder.php" method="post">
  <input type="hidden" id="type" name="type" value="46" />
  <input type="hidden" id="text1" name="text1" value="" />
  <input type="hidden" id="quantdesc" name="quantdesc" value="" />
  <input type="hidden" id="price" name="price" value="<?=$price;?>" />
  
  <div style="width:100%;text-align:center;">
    <div id="design_preview"><img src="/images/products/kipiisnew2.gif" alt="Kippis" /></div>
    Colours: 
    <select id="design" onchange="updateDesign();" >
      <option value="Lime/Blue">Lime/Blue</option>
      <option value="Magenta/Lime">Magenta/Lime</option>
      <option value="Tangerine/Blue">Tangerine/Blue</option>
    </select>
    <br><br>
    <div align="center">
      <a href="javascript: history.go(-1);" ><img src="images/nav/n_back.gif" name="back" width="58" height="22" border="0"></a> 
      &nbsp;&nbsp;<a href="javascript: document.form1.submit();" ><img src="images/nav/n_continue_x.gif" name="Image28" width="80" height="22" border="0"></a> 
   </div>
  </div>
</form>