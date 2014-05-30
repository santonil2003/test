<script>

var voucherNames = new Array();
voucherNames[1] = new Array(2,'I love you tutu much');
voucherNames[2] = new Array(14, 'A Gift For you Gear!');
voucherNames[3] = new Array(5,'BEE Good,BEE Happy,BEE my friend!');
voucherNames[4] = new Array(8,'Especially for you!');
voucherNames[5] = new Array(4, 'A Beary Nice gift especially for you!');
voucherNames[6] = new Array(6,'The purfect gift for you!');
voucherNames[7] = new Array(3,'A special wish and gift tutu!');
voucherNames[8] = new Array(16, 'A Gift that never dates!');
voucherNames[9] = new Array(12, 'Hope this adds a little sparkle to your day!');
voucherNames[10] = new Array(13, 'Children are the flowers in the garden of life!');
voucherNames[11] = new Array(9, 'A gift to make your tail wag!');
voucherNames[12] = new Array(20, 'A gift to stimulate your senses!');
voucherNames[13] = new Array(19, 'Some loot especially for you!');
voucherNames[14] = new Array(24, 'A gift for all seasons!');
voucherNames[15] = new Array(21, 'Hope your day is a blast!');
voucherNames[16] = new Array(23, 'A gift for all seasons!');


function addVoucherToOrder(v_num) {

  var voucher_html = '<form name="addorder" method="POST" action="addtoorder.php">';
  voucher_html+='<input type="hidden" id="voucher_id" name="voucher_id" value="'+v_num+'">';
  voucher_html+='<input type="hidden" name="type" value="44">';
  voucher_html+='<input type="hidden" name="typedetail" value="">';
  voucher_html+='<input type="hidden" name="quantdesc" value="">';
  voucher_html+='<br><br><img src="images/products/prod_gv_bday_'+v_num+'.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="122" height="214" border="0">';
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

<table border="0" cellspacing="0" cellpadding="0" width="890">
				<tr>
					<td align="center">

					<img src="images/products/prod_gv_bday_1.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(1); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_2.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(2); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>

					<td align="center">
					<img src="images/products/prod_gv_bday_3.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(3); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_4.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(4); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>

					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_5.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(5); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_6.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(6); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>

					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_7.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(7); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_8.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>

					<a href="" onClick="addVoucherToOrder(8); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
				</tr>
			</table>
			<br>

<table border="0" cellspacing="0" cellpadding="0" width="890">
				<tr>
					<td align="center">
					<img src="images/products/prod_gv_bday_9.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>

					<a href="" onClick="addVoucherToOrder(9); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_10.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(10); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">

					<img src="images/products/prod_gv_bday_11.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(11); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_12.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(12); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>

					<td align="center">
					<img src="images/products/prod_gv_bday_13.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(13); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_14.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(14); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>

					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_15.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(15); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>
					</td>
					<td><img src="images/gen/spacer.gif" width="11" height="10" alt=""><br></td>
					<td align="center">
					<img src="images/products/prod_gv_bday_16.gif" alt="identiKid Products - Gift Vouchers - Instant Gift Vouchers" width="99" height="201" border="0"><br>
					<a href="" onClick="addVoucherToOrder(16); return false;"><img src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"></a>

					</td>
				</tr>
			</table>
