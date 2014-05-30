<script>

var voucherNames = new Array();
voucherNames[1] = new Array(17,'Get Well Soon');
voucherNames[2] = new Array(18,'A Gift and Alert in One');

function addVoucherToOrder(v_num) {

  var voucher_html = '<form name="addorder" method="POST" action="addtoorder.php">';
  voucher_html+='<input type="hidden" id="voucher_id" name="voucher_id" value="'+v_num+'">';
  voucher_html+='<input type="hidden" name="type" value="44">';
  voucher_html+='<input type="hidden" name="typedetail" value="">';
  voucher_html+='<input type="hidden" name="quantdesc" value="">';
  voucher_html+='<br><br><img src="images/products/prod_gv_health_'+v_num+'.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="122" height="214" border="0">';
  voucher_html+='<br>Please Enter Voucher Amount: <input type="text" name="price"><br><br>';
  voucher_html+='<img id="cancelVoucher"  src="images/nav/n_back.gif" alt="identi Kid Products - Back" width="58" height="22" style="cursor:pointer;" border="0">';
  voucher_html+='&nbsp;&nbsp;<img style="cursor:pointer;" id="addToOrder" src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"><br><br>';
  voucher_html+='</form>';
  

  $('#voucher_display').html(voucher_html);
  $.blockUI({ 
            message: $('#voucher_display'), 
            css: { top: '20%' } 
            
  });  
  
  $('#cancelVoucher').click($.unblockUI); 
  $('#addToOrder').click(checkVoucherValue); 
}


function checkVoucherValue()
{

   v_num = $("#voucher_id").val();

	if(isNaN(document.addorder.price.value) || document.addorder.price.value<=0)
	{	
		self.alert('Please enter a valid number into the Voucher Value');
		
	}
	else {
		document.addorder.price.value = twoDecimals(document.addorder.price.value);
		document.addorder.typedetail.value = voucherNames[v_num][0];
		document.addorder.quantdesc.value = '1 ' + voucherNames[v_num][1] + ' - ' + document.addorder.price.value + " ea";
		document.addorder.submit();
	}

}

function twoDecimals(string){

	var bits = string.split(".");
	if(bits.length>1){
		if(bits[1].length==0){
			string = string + "00";
		}
		else if(bits[1].length==1){
			string = string + "0";
		}
		else if(bits[1].length>2){
			string = bits[0] + "." + bits[1].substr(0,2);
		}
	}
	else {
		string = string + ".00";
	}
	return string;

}


</script>
<div id="voucher_display" style="display:none;"></div>

<table border="0" cellspacing="0" cellpadding="0" width="264">
				<tr>
					<td align="center">

					<img src="images/products/prod_gv_health_1.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="122" height="214" border="0"><br>
					<a href="" onClick="addVoucherToOrder(1); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="20" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_health_2.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="122" height="214" border="0"><br>
					<a href="" onClick="addVoucherToOrder(2); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>		
				</tr>

			</table>
