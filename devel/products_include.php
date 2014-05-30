<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top"> 
    <td colspan="5"><img src="images/spacer_trans.gif" width="10" height="10"></td>
  </tr>
  <tr valign="top"> 
    <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
    <td colspan="3">
		<?PHP
		// if user tried to goto a page without selecting  their currency
			if ($_GET["error"] == "nocurrency" && !isset($_COOKIE["currency"]))
			{
				echo "<table width='340' border='0' align='center' cellpadding='5' cellspacing='0'>
				<tr>
          			<td><div align='center'><img src='images/no_currency_selected.gif' width='200' height='23'></div></td>
        		</tr>
      			</table>";
			}
		?>

<!-- if currency hasn't been selected-->
<?php 
	if(!isset($_COOKIE["currency"]) || $_GET["error"]=="changecurrency"){ 
		if (isset($_GET["returnurl"]))
		{
			$returnurl = $_GET["returnurl"];
		}
	
	echo "<table width='340' height='95' border='0' align='center' cellpadding='5' cellspacing='0' background='images/select_currency.gif'>
        <tr> 
          <td width='15' rowspan='3'>&nbsp;</td>
          <td height='36'></td>
          <td width='25' rowspan='3'>&nbsp;</td>
        </tr>
        <tr>
          <td valign='top'> 
			<form name='form1' method='post' enctype='multipart/form-data' action='check_currency_chosen.php?returnurl=$returnurl'>
					  <div align='center'>
						<select name='thecurrency'>
						  <option value='1' selected>Australian Dollar</option>
						  <option value='2'>United States Dollar</option>
						  <option value='3'>Euro Dollar</option>
						</select>
						<input name='selectcurrency' type='submit' value='Go' style='background: white; color: black; font-size: 13px; font-weight:bold'>
					  </div>
					</form>
		  </td>
        </tr>
      </table>
	  <table width='340' border='0' align='center' cellspacing='0'>
	  	<tr>
			<td align='center'>
				<img src='/images/currency_must.gif'>
			</td>
		</tr>
	  </table>";
		}
		else
		{
			// determine currency 
			if($_COOKIE["currency"] ==1) $curr = "Australian Dollar"; elseif ($_COOKIE["currency"] == 2) $curr = "United States Dollar"; else $curr = "Euro Dollar";
			// display currency chosen
			echo "<table width='340' height='25' border='0' align='center' cellpadding='5' cellspacing='0'>
				  <tr>
				  	<td align='center'>
						<p class='maintext'><strong>Currency in use :" . $curr . " </strong></p>
					</td>
				  <tr>
				  	<td align='center'>
						<p class='maintext'><a href='products_home.php?error=changecurrency'>Click here </a>to change currency</p>
					</td>
				  </tr>
				  </table>";	
		}
		?>
       </td>
    <td>&nbsp;</td>
  </tr>
  
  <?php // hide options if no currency
	if(!isset($_COOKIE["currency"]) || $_GET["error"]=="changecurrency")
		echo "<!--";?>
  
  <tr valign="top"> 
    <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"></td>
    <td width="208"><table width="208" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="2" colspan="2"><strong><img src="images/spacer_trans.gif" width="11" height="2"></strong></td>
        </tr>
        <tr> 
          <td width="163"><a href="products.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('view_all','','images/image_view_poducts_mo.gif',1)"><img src="images/image_view_poducts.gif" alt="View All Products" name="view_all" width="163" height="99" border="0"></a></td>
          <td width="51" class="maintext"><div align="right"><strong><img src="images/or.gif" width="36" height="28"></strong></div></td>
        </tr>
      </table>
      <br> <table width="176" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="217"><div align="left"> 
              <p class="maintext">We offer a fun and ever 
                growing range of childrens label products, all of which can be 
                purchased online safely.</p>
              <p class="maintext">If you need labels for your childrens school 
                clothes &amp; property then checkout our fantastic selection.</p>
              <p class="maintext">All orders are taken through our secure server, 
                so you can be sure your details will be safe.</p>
            </div></td>
        </tr>
      </table>
      <span class="maintext"><br>
      </span> <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><div align="left"><strong><img src="images/spacer_trans.gif" width="11" height="20"><img src="images/text_happy_shopping.gif" alt="Happy Shopping!" width="125" height="20"></strong></div></td>
        </tr>
      </table></td>
    <td width="10"><img src="images/spacer_trans.gif" width="10" height="10"><br> 
      <br> <br> <span class="maintext"></span> </td>
    <td width="159"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="9"><strong><img src="images/spacer_trans.gif" width="11" height="9"></strong></td>
        </tr>
        <tr> 
          <td><table width="127" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr valign="top"> 
                <td width="127" valign="middle" bgcolor="5d7eb9" class="whitetext"><div align="center"><strong><img src="images/text_select_product.gif" alt="Select a Product" width="127" height="32"></strong></div></td>
              </tr>
              <tr valign="top"> 
                <td><table width="127" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFF00">
                    <tr> 
                      <td><table width="127" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="maintext"><div align="left"><strong>Stick 
                                        On Labels </strong></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_vinyl_labels.php" class="type1">Vinyl</a></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_mini_vinyls.php" class="type1">Mini 
                                        Vinyl</a></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_pencil_labels.php" class="type1">Pencil</a></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_diy_labels.php" class="type1">DIY</a></div></td>
                                  </tr>
								  <tr>
                                    <td class="smalltext"><div align="left"><a href="products_addresslabels.php" class="type1">Address Labels</div></a></td>
                                  </tr>
								  <tr>
                                    <td class="smalltext"><div align="left"><a href="products_book_labels.php" class="type1">Book Labels</div></a></td>
                                  </tr>
                                <tr> 
                                  </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="maintext"><div align="left"><strong>Clothing 
                                        Labels </strong></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext">
										<div align="left">
										<a href="products_iron_labels.php" class="type1">Semi-Permanent Iron Ons</a>
										</div>
									</td>
                                 </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext">
										<div align="left">
										<a href="products_coloured_ironons.php" class="type1" title="Permanent Iron Ons (Coloured)">Permanent Iron Ons</a>
										</div>
									</td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="maintext"><div align="left"><strong>Shoes</strong></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_shoe_labels.php" class="type1">Shoe 
                                        Labels</a></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_shoe_dots.php" class="type1">Shoe 
                                        Dots</a></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
								   <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="maintext"><div align="left"><strong>Thingamejigs</strong></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td class="smalltext"><a href="products_thingamejig.php" class="type1">Name Bracelets</a> </td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td class="smalltext"><a href="products_thingamejig_collar.php" class="type1">Pet Collars</a> </td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td class="smalltext"><a href="products_thingamejig_boybandz.php" class="type1">Boybandz</a> </td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td class="smalltext"><a href="products_thingamejig_gadget.php" class="type1">Gadget Straps</a> </td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="maintext"><div align="left"><strong>Packs</strong></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_colourmyworld_packs.php" class="type1">Colour My World</a></div></td>
                                  </tr>
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_starter_packs.php" class="type1">Starter Packs </a></div></td>
                                  </tr>
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_mixed_pack.php" class="type1">Mixed Packs</a></div></td>
                                  </tr>
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_birthday_pack.php" class="type1">Birthday Packs</a> </div></td>
                                  </tr>
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_new_baby_pack.php" class="type1">New Baby Packs</a> </div></td>
                                  </tr>
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_shared_packs.php" class="type1">Shared Packs</a> </div></td>
                                  </tr>
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_maxi_pack.php" class="type1">Maxi Packs</a> </div></td>
                                  </tr>
				   <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_itty_bitty_pack.php" class="type1">Itty Bitty Packs</a> </div></td>
                                  </tr>
                                 </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="maintext"><div align="left"><strong>Allergy/Medical 
                                        Alerts</strong></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_allergy_alert.php" class="type1">Allergy 
                                        Alert Labels</a></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td class="maintext"><strong>Wristbands</strong></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td class="smalltext"><a href="products_identibands.php" class="type1">Identi Bands</a> </td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td width="10">&nbsp;</td>
                            <td class="maintext"><strong>Bagtags</strong></td>
                            <td width="10">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                            <td class="smalltext"><a href="products_identitags.php" class="type1">IdentiTAGS</a><br>
                              <a href="products_ziptags.php" class="type1">Zip 
                              Tags</a> <br>
                              <a href="products_zipdedo.php" class="type1">ZipDeDo Dots</a></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td height="15" colspan="3"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="maintext"><div align="left"><strong>Gift 
                                        Vouchers</strong> </div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"> <div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td align="left" valign="top" class="smalltext"><a href="boy_gift_voucher.php" class="type1">Boy</a><br> 
                                      <a href="girl_gift_voucher.php" class="type1">Girl</a> 
                                      <br> <a href="baby_gift_voucher.php" class="type1">Baby</a></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td height="15" colspan="3"><img src="images/spacer_trans.gif" width="10" height="15"></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                            <td class="maintext"><strong>Gift packaging</strong></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="center"> 
                                <table width="100" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_kidcards.php" class="type1">KIDCARDS</a> 
                                      </div></td>
                                  </tr>
                                  <tr> 
                                    <td class="smalltext"><div align="left"></div></td>
                                  </tr>
                                  <tr> 
                                    <td class="smalltext"><div align="left"></div></td>
                                  </tr>
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_gift_box.php" class="type1">Presentation 
                                        / Storage Envelope</a></div></td>
                                  </tr>
                                  <tr> 
                                    <td class="smalltext"><div align="left"><a href="products_gift_voucher.php" class="type1">Gift 
                                        vouchers</a></div></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><div align="left"><img src="images/spacer_trans.gif" width="10" height="20"></div></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    <td width="11"><img src="images/spacer_trans.gif" width="10" height="10"></td>
  </tr>
   <?php // hide options if no currency
	if(!isset($_COOKIE["currency"]) || $_GET["error"]=="changecurrency")
		echo "-->";?>
</table>



