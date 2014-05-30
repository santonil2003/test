<?PHP
	require_once('../_common/_connection.php');
	require_once('../_common/_constants.php');
	require_once('../_common/_database.php');
	require_once('../_common/_functions.php');
	$cfg = new Config();
	$db = new DbConnect($cfg);
	$db->connectDb();
?>
<? require_once("header_new.php"); ?>

<td valign="top">
<table width="630px" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td><strong><font size="4"><br>
        Subscription Listing<br>
        </font></strong> <hr noshade> 
        
      </td>
    </tr>
    <tr> 
      <td width="630px">
        <div style="width:630px;word-wrap:break-word;overflow:visible;" >
	      <?php 
			$sql = "SELECT * FROM email_list";
			$result = mysql_query($sql);
			while ($rows = mysql_fetch_assoc($result))
			{
				echo ";".$rows['email'];
			}
			echo ";";	
		?>
	  </div>
	  </td>
    </tr>

  </table>
</td>
<? include("footer_new.php"); ?>
