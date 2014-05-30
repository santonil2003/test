<?php

include("../common_db.php");
linkme();

session_start();
$user_section_id = 4;
require_once("./security.php");
check_access($user_section_id);


//echo '<pre>';
//print_r($_GET);
//print_r($_POST);
//echo '</pre>';
	
	function sendHtmlEmail($text, $html, $from, $to, $title){
		 include('../common/htmlMimeMail.php');
		 
		 $mail = new htmlMimeMail();
		 
		 $mail->setHtml($html, $text);
		 
		 $mail->setReturnPath($from);
		 
		 $mail->setFrom($from);
		 
		 $mail->setSubject($title);
		 
		 $mail->setHeader('X-Mailer', 'HTML Mime mail class (http://www.phpguru.org)');
		 
		 $result = $mail->send(array($to), 'smtp');
	}

	//$link = mysql_connect('localhost','root','') or exit(mysql_error());
	$link = mysql_connect('mysql.globaldial.com','identiki','IdentiK1') or exit(mysql_error());
	mysql_select_db('identiki_data', $link) or exit(mysql_error());
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>identi Kid - Admin Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="admin_stylesheet.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><table cellpadding="0" cellspacing="0" border="0">
        <tr bgcolor="#FFFFFF"> 
          <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        </tr>
        <tr> 
          <td><img src="../images/admin_header.gif" height="38" width="884" border="0"></td>
        </tr>
        <tr> 
          <td class="maintext"></td>
        </tr>
        <tr> 
          <td valign="top" class="maintext"> <table width="100%" height="100%" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="99%" valign="top" class="maintext">&nbsp;</td>
              </tr>
              <tr> 
                <td valign="top" class="whitetext"><form name="form1" method="post" action="newsletter.php?file=<?= $file ?>&action=Save">
                    <table width="100%" border="0" cellpadding="5">
                      <tr bgcolor="#EE007B"> 
                        <td> <p><strong><font color="#FFFFFF"> Email Newsletter</font></strong></p></td>
                      </tr>
                      <tr><td><img src="../images/spacer_trans.gif" height="3" width="1" border="0"></td></tr>
					  <tr> 
                        <td>
							<table width="100%" height="100%" border="0" cellpadding="5">
								  <tr bgcolor="#E5E5E5">
									<td>
									<?php
										//$start_time = time();
										$newsletter_sql = "SELECT DISTINCT volume, issue, date, title, file FROM newsletter WHERE (newsletter.archived LIKE '%no%')";
										$newsletter_result = mysql_query($newsletter_sql, $link) or exit(mysql_error);
										//Determine the number of results found
										$newsletter_num_rows = mysql_num_rows($newsletter_result);
										//Has the query found only a single valid newsletter in the database?
										if ($newsletter_num_rows == 1){
											$newsletter_rs = mysql_fetch_assoc($newsletter_result);
											$newsletter_file = "../newsletter/" . $newsletter_rs["file"];
											//Does the newsletter file exist?
											if (file_exists($newsletter_file)){
												//Did the newsletter file contain any information?
												if (filesize($newsletter_file) > 0){
													$newsletter_handle = fopen ($newsletter_file, "r"); 
													$newsletter_contents = fread ($newsletter_handle, filesize ($newsletter_file)); 
													fclose ($newsletter_handle);
												//if (strlen($newsletter_contents) > 0){
													$subscriber_sql = "SELECT DISTINCT firstname, surname, emailadd FROM customers WHERE ((customers.subscriber = 'Yes') AND (customers.emailadd <> '')) ORDER BY surname ASC, firstname ASC";
													$subscriber_result = mysql_query($subscriber_sql, $link) or exit(mysql_error);
													//Determine the number of results found
													$subscriber_num_rows = mysql_num_rows($subscriber_result);
													//Has the query found any valid subscribers?
													if ($subscriber_num_rows > 0){
														$sender = "info@identikid.com.au";
														//$subject = "Oops! New identiKid Newsletter!";
														$subject = "New identiKid Newsletter!";
														//Email body for those that cannot receive HTML formatted emails.
														//$text_body = "Dear identiKid Customer,/n/n";
														$text_message = "Thank you for choosing one of our products. If you are interested in finding out more about what's going on at identiKid at the moment visit us at  http://www.identikid.com.au/newsletter.php.\n\n";
														$text_message .= "If you do not wish to receive notification of our newsletter in future please send an email to info@identikid.com.au with the subject heading 'Please Remove Me From Your Mailing List'.\n\n";
														$text_message .= "With kindest regards,\n\n";
														$text_message .= "identiKid.\n\n";
														echo '<strong>Emailing subscribers...</strong><br>';
														flush();
														//Email the newsletter to each valid subscriber
														while($subscriber_rs = mysql_fetch_assoc($subscriber_result)){
															$first_name = $subscriber_rs['firstname'];
															//$first_name = 'Simon';
															$last_name = $subscriber_rs['surname'];
															//$last_name = 'Gare';
															$recipient = $subscriber_rs['emailadd'];
															//$recipient = 'xyz@echidnaweb.com.au';
										
															$text_body = "Dear " . $first_name . " " . $last_name . ",\n\n" . $text_message;
															$html_body = $newsletter_contents;
															
															//echo $last_name . ', ' . $first_name . '<br>';
															
															sendHtmlEmail($text_body, $html_body, $sender, $recipient, $subject);
															
															//$text_body = "";
														}
														echo '<br><strong>...finished emailing subscribers.</strong>';
													//No valid subscribers were found in the database!	
													}else{
														echo '<strong>No valid subscribers could be found.</strong>';
													}
												//The newsletter file from the query does not seem to contain any information!
												}else{
													echo '<strong>The Newsletter file does not seem to contain any information.</strong>';
												}
											//The newsletter file referred to in the query result does not seem to exist!
											}else{
												echo '<strong>The Newsletter file does not seem to exist.</strong>';
											}
										//Either no, or more than one, valid newsletter was found in the database!
										}else{
											echo '<strong>Either no, or multiple, Newsletters were found. Please ensure that only one Newsletter is available at any one time.</strong>';
										}
										//echo '<br>' . date("G:i:s",(time() - $start_time));
									?>
									</td> 
								</tr>
						  </table>
                        </td>
                      </tr>
                    </table>
                  </form>
				  </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>