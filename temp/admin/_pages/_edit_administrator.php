<?
if($_GET['id'])
{
	require_once(SITE_DIR.'_classes/_entity/_Administrator.php');
	$admin = new Administrator();
	$admin->id = $_GET['id'];
	$admin->findById();
}
else
{
	trigger_error('An id must be provided to edit a agency\'s details', E_USER_ERROR);
}
?>
<form name="form1" method="post" action="">
                <td>
                    <table width="394" border="0" cellpadding="5">
      <tr bgcolor="#CC0000"> 
        <td colspan="2"> <p><strong><font color="#FFFFFF">Change Agency Details</font></strong></p></td>
      </tr>
      <tr bgcolor="#CCCCCC"> 
        <td colspan="2"><p><strong>Change Details</strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p align="left"><strong>ID:</strong></p></td>
        <td> <p align="left"><strong> 
            <?=$admin->id?><input type="hidden" name="id" value="<?=$admin->id?>"></strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td width="32%"> <p align="left"><strong>Legal Name:</strong></p></td>
        <td width="68%"> <p align="left"><strong> 
            <input name="legal_name" type="text" value="<?=$admin->legal_name?>" size="30">
            </strong><strong> </strong> </p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Trading As:</strong></p></td>
        <td> <p><strong> 
            <input name="trading_as" type="text" value="<?=$admin->trading_as?>" size="30">
            </strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Postal Address:</strong></p></td>
        <td> <p><strong> 
            <input name="postal_address" type="text" value="<?=$admin->postal_address?>" size="30">
            </strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Suburb:</strong></p></td>
        <td> <p><strong> 
            <input name="suburb" type="text" value="<?=$admin->suburb?>" size="30">
            </strong><strong> </strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Postcode</strong></p></td>
        <td><input type="text" name="postcode" value="<?=$admin->postcode?>"></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>ABN: </strong></p></td>
        <td><strong> 
          <input name="ABN" type="text" value="<?=$admin->ABN?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#CCCCCC"> 
        <td colspan="2"> <p><strong>Bank Account</strong> (for STeP return funds)</p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Account Name:</strong></p></td>
        <td> <p><strong> 
            <input name="account_name" type="text" value="<?=$admin->account_name?>" size="30">
            </strong><strong> </strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>BSB:</strong></p></td>
        <td> <p><strong> 
            <input name="BSB" type="text" value="<?=$admin->BSB?>" size="15">
            </strong><strong> </strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Account Number</strong></p></td>
        <td> <p><strong> 
            <input name="account_number" type="text" value="<?=$admin->account_number?>" size="15">
            </strong><strong> </strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td colspan="2" bgcolor="#CCCCCC"> <p><strong>Contact 1 - Administrator</strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Name: </strong></p></td>
        <td><strong> 
          <input name="contact1_name" type="text" value="<?=$admin->contact1_name?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Position: </strong></p></td>
        <td><strong> 
          <input name="contact1_position" type="text"  value="<?=$admin->contact1_position?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Phone No: </strong></p></td>
        <td><strong> 
          <input name="contact1_phone" type="text" value="<?=$admin->contact1_phone?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Fax No: </strong></p></td>
        <td><strong> 
          <input name="contact1_fax" type="text" value="<?=$admin->contact1_fax?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Email: </strong></p></td>
        <td><strong> 
          <input name="contact1_email" type="text" value="<?=$admin->contact1_email?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td colspan="2" bgcolor="#CCCCCC"> <p><strong>Contact 2 </strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Name: </strong></p></td>
        <td><strong> 
          <input name="contact2_name" type="text" value="<?=$admin->contact2_name?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Position: </strong></p></td>
        <td><strong> 
          <input name="contact2_position" type="text" value="<?=$admin->contact2_position?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Phone No: </strong></p></td>
        <td><strong> 
          <input name="contact2_phone" type="text" value="<?=$admin->contact2_phone?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Fax No: </strong></p></td>
        <td><strong> 
          <input name="contact2_fax" type="text" value="<?=$admin->contact2_fax?>"  size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Email: </strong></p></td>
        <td><strong> 
          <input name="contact2_email" type="text" value="<?=$admin->contact2_email?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td colspan="2" bgcolor="#CCCCCC"> <p><strong>Contact 3</strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Name: </strong></p></td>
        <td><strong> 
          <input name="contact3_name" type="text" size="30" value="<?=$admin->contact3_name?>">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Position: </strong></p></td>
        <td><strong> 
          <input name="contact3_position" type="text" size="30" value="<?=$admin->contact3_position?>">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Phone No: </strong></p></td>
        <td><strong> 
          <input name="contact3_phone" type="text" size="30" value="<?=$admin->contact3_phone?>">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Fax No: </strong></p></td>
        <td><strong> 
          <input name="contact3_fax" type="text" size="30" value="<?=$admin->contact3_fax?>">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td> <p><strong>Email: </strong></p></td>
        <td><strong> 
          <input name="contact3_email" type="text" value="<?=$admin->contact3_email?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#CCCCCC"> 
        <td colspan="2"> <p><strong>Change Password</strong></p></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td><p><strong>Current Password</strong></p></td>
        <td><strong> 
          <input name="password" type="text" value="<?=$admin->password?>" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td><p><strong>New Password</strong></p></td>
        <td><strong> 
          <input name="new_password" type="text" size="30">
          </strong></td>
      </tr>
      <tr bgcolor="#E5E5E5"> 
        <td colspan="2"><input type="hidden" name="form_action" id="form_action" value="EditAdministrator"><input name="Submit2" type="submit" value="Update Details"> 
        </td>
      </tr>
    </table>
                    <p><a href="#" class="programmerLinks" onClick="MM_popupMsg('That password exists already. Please try again')">password 
                      exists message</a> </p>
                  </td></form>
