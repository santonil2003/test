<?php
include_once("_common/_connection.php");
require_once("_common/_database.php");
require_once("_common/_constants.php");

linkme();
function get_section($section_id,$section_name = '',$result)
{
	$query  = "SELECT parent_id,name FROM site_sections WHERE section_id = '$section_id'";
	$query	= mysql_query($query);
	$row 	= mysql_fetch_assoc($query);
	if($row['parent_id'] == '0'){
		if($result['page'] == $row['name'])
		{
			$section = trim($row['name']);
			$section = '/'.str_replace(' ','_',$section);
		}
		else
		{
			$section = trim($row['name']);
			$section = '/'.str_replace(' ','_',$section);
			$section = $section.'/'.str_replace(' ','_',$result['page']);
		}
		if($section_name != ''){
			$section = $section.$section_name;
		}
		return $section;
	}
	else{
		$section_id = $row['parent_id'];
		$section 	= trim($row['name']);
		$section 	= '/'.str_replace(' ','_',$section);
		if($section_name != ''){
			$section = $section.$section_name;
		}
		
		$section = get_section($section_id,$section,$result);
	}
	return $section;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Kids Labels, Name Labels, Clothing labels, Name tags, Personalised Gifts, Fundraising, Special Family Gifts.
identikids High Quality name labels and Unique Gift ideas for the whole family will put a smile on anyones face.identikid will make any childs World more personal and make them feel very special. Let us help you get organised.</title>
<meta name="keyword" content="labels, name tags, fundraising, name labels, clothing labels, bagtags, iron on labels, school fundraising ideas, school labels,fundraising, pencil labels, kids birthdays ideas, kids bags, personalised gifts, kids gifts, xmas gifts, kids wallets, santa sacks, christmas sacks, coin purses, pencil cases, insulated lunchboxes, drink bottle covers, mugs , personalised gifts, kindergarten bags, library bags, shoulder bags, personalised, swimming bags,special occasion gifts, unique gifts, toilet bags, cosmetic bags, aprons, mothers day gift ideas, fathers day gifts, xmas gifts, identikid, baby gift ideas and personalised organic clothing.">
<meta name="description" content="High Quality Name Labels and name tags for labelling everything a child uses. identikid's has quality labels and unique personalised gift ideas that every child will love. No fuss fundraising with name labels and personalised gifts for birthdays, xmas and special occasions. Quality iron-on labels for clothing can help reduce the amount of lost property and assist school fundraising. Identikids easy to use website makes labelling and gift buying simple.">
<META NAME="expires" CONTENT="">
<META NAME="language" CONTENT="english">
<META NAME="charset" CONTENT="ISO-8859-1">
<META NAME="distribution" CONTENT="Global">
<META NAME="robots" CONTENT="INDEX,FOLLOW">
<META NAME="email" CONTENT="">
<meta name="author" content="pete">
<META NAME="publisher" CONTENT="identiKid">
<META NAME="copyright" CONTENT="Copyright ©2008 - identiKid">
</head>
<script type="text/javascript" src="js/milonic_src.js"></script>
<!-- <noscript><a href="http://www.milonic.com/">DHTML JavaScript Website Pull Down Navigation Menu By Milonic</a></noscript> -->
<script type="text/javascript">
if(ns4)_d.write("<scr"+"ipt type=text/javascript src=js/mmenuns4.js><\/scr"+"ipt>");		
  else _d.write("<scr"+"ipt type=text/javascript src=js/mmenudom.js><\/scr"+"ipt>"); 
</script>
<script type="text/javascript" src="js/menu_data.js"></script>
<script type="text/javascript" src="js/ienoscript.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<body>
<table border="0" cellspacing="0" cellpadding="0" width="998" align="center">
	<tr>
		<td style="background-image: url('images/gen/header_home.gif'); width:998; height:239; " ><script type="text/javascript">startIeFix();</script>
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="998" height="239" id="header" align="middle">
				<param name="allowScriptAccess" value="sameDomain" />
				<param name="allowFullScreen" value="false" />
				<param name="movie" value="flash/header.swf" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffffff" />
				<embed src="flash/header.swf" quality="high" bgcolor="#ffffff" width="998" height="239" name="header" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>
			<!--[if gte IE 6]></noscript><![endif]-->
			<script type="text/javascript">endIeFix();</script>
			<!--<a href="index.php"><img src="images/gen/header_home.gif" width="998" height="239" alt="identi Kid, Identikid, Labels, Name Tags, Fundraising" border="0"></a>--></td>
	</tr>
	<tr>
		<td height="44" bgcolor="#ffffff"><SCRIPT type="text/javascript" src="js/embed_menu.js"></SCRIPT></td>
	</tr>
	<tr>
		<td align="right" bgcolor="#FFFFFF" style="padding-top:10px;padding-right:5px"><?php include('search.php'); ?></td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="998" bgcolor="#ffffff">
	<tr>
		<td style="padding-left:20px;">
			<?php
				if(trim($_POST['submit']) == 'Search' && trim($_POST['search']) != '')
				{
					$searchKeyword	= trim($_POST['search']);
					echo "<table><tr>";
					echo "<td valign=\"top\"><img alt=\"$searchKeyword\" src=\"font.php?size=15&amp;text={Search Result For}&amp;textColour=5c80ba&amp;bgColour=ffffff\"></td>";
					echo "<td valign=\"top\">&nbsp;&nbsp;<img width=\"41\" height=\"38\" border=\"0\" alt=\"&gt;\" src=\"images/bread/divider.gif\">&nbsp;&nbsp;</td>";
					echo "<td valign=\"top\"><img alt=\"$searchKeyword\" src=\"font.php?size=15&amp;text={$searchKeyword}&amp;textColour=5c80ba&amp;bgColour=ffffff\"></td>";
					echo "</tr></table>";
					$searhQuery 	= "SELECT * FROM site_pages AS SP LEFT JOIN site_sections AS SS ON SS.section_id = SP.section_id WHERE SP.page LIKE '%".$searchKeyword."%' AND SS.active = '1'";			
					$result = mysql_query($searhQuery);
					if (!$result) {
						echo "Could not successfully run query ($searhQuery) from DB: " . mysql_error();
					}
					else {
						$totalRow = mysql_num_rows($result);
						if($totalRow > 0){
							echo "<ul class=\"srchresult\">";
							while ($row = mysql_fetch_assoc($result)) {
								$link 	= get_section($row['section_id'],'',$row);
								if($row['page_title'] != ''){
									$title = trim($row['page_title']);
								}
								else{
									$title 	= str_replace("_"," ",$link);
									$title 	= implode(" ",explode("/",$title));
								}
								echo "<li>";
								echo "<span class=\"stitle\">". $title ."</span><br />";
								echo "<span class=\"slink\" style=\"padding-left:10px;\"><a href=\"".$link."\" target=\"_blank\">".$row['page']."</a></span><br />";
							}
							echo "<ul>";
						}
						else{
							echo "No result found for ".$searchKeyword;
						}
					}
					mysql_free_result($result);
					

				}
			?>
		</td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="998">
	<tr>
		<td bgcolor="#ffffff"><img src="images/gen/spacer.gif" width="1" height="30" alt=""><br></td>
	</tr>
	<tr>
		<td><img src="images/gen/footer.gif" alt="" width="998" height="51" border="0" usemap="#map"><br>
			<map name="map">
				<area shape="rect" coords="0,0,86,51" href="index.php" />
				<area shape="rect" coords="87,0,753,51" href="Contact_Us" />
				<area shape="rect" coords="853,0,998,51" href="Fundraisers" />
				<area shape="rect" coords="754,0,852,51" href="Shipping" />
			</map></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#5b7fbb"><img src="images/gen/spacer.gif" width="1" height="4" alt=""><br>
			<table border="0" cellspacing="0" cellpadding="0" width="960">
				<tr>
					<td class="footer"><a href="index.php">Home</a>&nbsp;|&nbsp;<a href="Products">Products</a>&nbsp;|&nbsp;<a href="Home/Order_Form">Order Form</a>&nbsp;|&nbsp;<a href="Home/How_To_Order">How to Order</a>&nbsp;|&nbsp;<a href="my_order.php">My Order</a>&nbsp;|&nbsp;<a href="Home/Fonts_&_Pics">Font &amp; Pics</a>&nbsp;|&nbsp;<a href="Fundraisers">Fundraisers</a>&nbsp;|&nbsp;<a href="Home/About_Us">About Us</a><br>
						<a href="Contact_Us">Contact Us</a>&nbsp;|&nbsp;<a href="Home/Send_to_a_Friend">Send to a Friend</a>&nbsp;|&nbsp;<a href="Feedback">Feedback</a>&nbsp;|&nbsp;<a href="Home/Links">Links</a>&nbsp;|&nbsp;<a href="Home/Competition">Competition</a>&nbsp;|&nbsp;<a href="Home/Privacy_Policy">Privacy Policy</a>&nbsp;|&nbsp;<a href="Home/Site_Map">Sitemap</a><br></td>
					<!--<td align="right">
					<div style="font:11px verdana, verdana, arial, helvetica, sans-serif; font-weight:normal; color: #ffffff; line-height:15px; text-align: right;">International Phone: +61 2 6971 0969&nbsp;<br>International Fax: +61 2 6971 0492&nbsp;<br></div>
					</td>-->
				</tr>
			</table>
			<img src="images/gen/spacer.gif" width="1" height="15" alt=""><br></td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="998">
	<tr>
		<td colspan="3"><img src="images/gen/home_text_top.gif" alt="" width="998" height="164" border="0"><br></td>
	</tr>
	<tr>
		<td valign="bottom" background="images/gen/b_home_text_left.gif" width="209"><img src="images/gen/home_text_left.gif" width="209" height="617" alt=""></td>
		<td width="568" bgcolor="#8bc63f" class="white"><? include("_user_pages/home_page_content_-_footer_keywords.php"); ?></td>
		<td valign="bottom" background="images/gen/b_home_text_right.gif" width="221"><img src="images/gen/home_text_right.gif" width="221" height="617" alt=""></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/gen/home_text_foot.gif" alt="" width="998" height="79" border="0"><br></td>
	</tr>
</table>
</body>
</html>
