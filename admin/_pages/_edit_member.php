<?
if($_GET['EeId'])
{
	require_once('../_classes/_entity/_Employee.php');
	$employee = new Employee();
	$employee->EeId = $_GET['EeId'];
	$employee->findById();
}
else
{
	trigger_error('An id must be provided to edit a member\'s details', E_USER_ERROR);
}
?> 
                <form name="form1" method="post" action="index.php?page=a4"><td>
                    <table width="394" border="0" cellpadding="5">
                      <tr bgcolor="#CC0000"> 
                        <td colspan="2"> <p><strong><font color="#FFFFFF">Change 
                            Contact Details</font></strong></p></td>
                      </tr>
                      <tr bgcolor="#CCCCCC"> 
                        <td colspan="2"><p><strong>Change Details</strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td width="32%"> <p align="left"><strong>EeID:</strong></p></td>
                        <td width="68%"> <p align="left"><strong> 
                            <input name="EeId" type="hidden" value="<?=$employee->EeId?>" size="10">
                            </strong><?=$employee->EeId?></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>Last Name:</strong></p></td>
                        <td> <p><strong> 
                            <input name="LastName" type="text" value="<?=$employee->lastName?>" size="30">
                            </strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>First Name:</strong></p></td>
                        <td> <p><strong> 
                            <input name="FirstName" type="text" value="<?=$employee->firstName?>" size="30">
                            </strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>IdDB:</strong></p></td>
                        <td> <p><strong> 
                            <input name="idDB" type="hidden" value="<?=$employee->idDB?>" size="10">
                            </strong> (not editable)</p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>Company:</strong></p></td>
                        <td> <p><strong> 
                            <input name="ErName" type="text" value="<?=$employee->erName?>" size="30">
                            </strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>Street Address:</strong></p></td>
                        <td> <p><strong> 
                            <input name="PostalAddress1" type="text" value="<?=$employee->postal1?>" size="30">
                            </strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>Street Address 2:</strong></p></td>
                        <td> <p><strong> 
                            <input name="PostalAddress2" type="text" value="<?=$employee->postal2?>" size="30">
                            </strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>Street Address 3:</strong></p></td>
                        <td> <p><strong> 
                            <input name="PostalAddress3" type="text" value="<?=$employee->postal3?>" size="30">
                            </strong></p></td>
                      </tr>

                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>Suburb:</strong></p></td>
                        <td> <p><strong> 
                            <input name="PostalCity" type="text" value="<?=$employee->postalCity?>" size="30">
                            </strong><strong> </strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>State: </strong></p></td>
                        <td><strong> 
                          <input name="PostalState" type="text" value="<?=$employee->postalState?>" size="10">
                          </strong></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>Post Code: </strong></p></td>
                        <td><strong> 
                          <input name="PostalPostCode" type="text" value="<?=$employee->postalPostcode?>" size="10">
                          </strong></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>Phone:</strong></p></td>
                        <td> <p><strong> 
                            <input name="Phone" type="text" value="<?=$employee->phone?>" size="30">
                            </strong><strong> </strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>Fax:</strong></p></td>
                        <td> <p><strong> 
                            <input name="Fax" type="text" value="<?=$employee->fax?>" size="30">
                            </strong><strong> </strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td> <p><strong>Email Address:</strong></p></td>
                        <td> <p><strong> 
                            <input name="Email" type="text" value="<?=$employee->email?>" size="40">
                            </strong><strong> </strong></p></td>
                      </tr>
                      <tr bgcolor="#CCCCCC"> 
                        <td colspan="2"> <p><strong>Change Password</strong></p></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td><p><strong>Current Password</strong></p></td>
                        <td><strong> 
                          <input name="old_password" type="text" value="<?=$employee->password?>" size="30">
                          </strong></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td><p><strong>New Password</strong></p></td>
                        <td><strong> 
                          <input name="new_password" type="text" size="30">
                          </strong></td>
                      </tr>
                      <tr bgcolor="#E5E5E5"> 
                        <td colspan="2"><input type="hidden" name="form_action" id="form_action" value="EditEmployee"><input name="Submit2" type="submit" value="Update Details"> 
                        </td>
                      </tr>
                    </table>
                    <p><a href="#" class="programmerLinks" onClick="MM_popupMsg('That password exists already. Please try again')">password 
                      exists message</a> </p>
                  </td></form>