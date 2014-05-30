
<?

require_once('_common/_constants.php');

//db setup - configure & set up db connection
require_once(SITE_DIR.'_common/_connection.php');
$cfg = new Config();
$db = new DbConnect($cfg);
$db->connectDb();
//end db setup
?>
</div>
</td>

					<td valign="top" width="138" height="91">
					<img src="images/bg/b_right.gif" width="138" height="91" alt=""><br>
					</td>
				</tr>
				<tr>
					<td valign="top" width="28" height="211">
					<img src="images/gen/white.gif" width="28" height="1" alt=""><br>
					<img src="images/gen/spacer.gif" width="28" height="210" alt=""><br></td>
					<td width="734" valign="top" height="211" style="background: url(images/bg/b_text.gif) no-repeat bottom left;">

					<img src="images/gen/white.gif" width="734" height="1" alt=""><br>
						<table border="0" cellspacing="0" cellpadding="0" width="595">
						   <?
						     $sections = array();
						     $sql="SELECT name, section_id, default_page FROM site_sections WHERE parent_id = '4' ORDER BY sort_index";
						     $result = mysql_query($sql);
						     $num_rows = mysql_num_rows($result);
						     if(mysql_num_rows($result) !== false) {
						       while($row = mysql_fetch_array($result)){
						         $sql_pages = "SELECT name , page FROM site_pages WHERE section_id='{$row['section_id']}' ORDER BY sort_order ";
						         $result_pages = mysql_query($sql_pages);
						         if(mysql_num_rows($result_pages) > 0) {
						           while($row_pages = mysql_fetch_array($result_pages)){
						             $sections[$row['name']][] = $row_pages;
						           }
						         }
							    }
						     } 
						   ?>
							<tr>
								<td width="73"><a href="retail" onclick="updateSection('retail');return false;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('port_retail','','images/nav/n_port_retail_x.gif',1)"><img src="images/nav/n_port_retail_o.gif" alt="Retail - Portfolio - Urbani Leyton Design" name="port_retail" id="port_retail" width="31" height="24" border="0"></a><br></td>
								<td width="102"><a href="hospitality" onclick="updateSection('hospitality');return false;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('port_hosp','','images/nav/n_port_hosp_x.gif',1)"><img src="images/nav/n_port_hosp_o.gif" alt="Hospitality - Portfolio - Urbani Leyton Design" name="port_hosp" id="port_hosp" width="60" height="24" border="0"></a><br></td>
								<td width="102"><a href="corporate"  onclick="updateSection('corporate');return false;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('port_corp','','images/nav/n_port_corporate_x.gif',1)"><img src="images/nav/n_port_corporate_o.gif" alt="Corporate - Portfolio - Urbani Leyton Design" name="port_corp" id="port_corp" width="60" height="24" border="0"></a><br></td>
								<td width="104"><a href="residential" onclick="updateSection('residential');return false;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('port_res','','images/nav/n_port_res_x.gif',1)"><img src="images/nav/n_port_res_o.gif" alt="Residential - Portfolio - Urbani Leyton Design" name="port_res" id="port_res" width="62" height="24" border="0"></a><br></td>
								<td width="214"><a href="developments" onclick="updateSection('developments');return false;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('port_dev','','images/nav/n_port_developments_x.gif',1)"><img src="images/nav/n_port_developments_o.gif" alt="Developments - Portfolio - Urbani Leyton Design" name="port_dev" id="port_dev" width="84" height="24" border="0"></a><br></td>
							</tr>

							<tr>
							  <?  
							    foreach($sections as $sec_name => $section) {
							    print("<td nowrap><div id='{$sec_name}' class='port_menus' style='display:none;'>"); 
				
							      foreach($section as $page) {
							        print("<a href='{$page['page']}' onclick='updatePage('{$page['name']}');return false;' >{$page['page']}</a><br>");
							      
							      }
							    print("</div></td>");
							    }
							  ?>
							</tr>
						</table>
					</td>
					<td valign="top" width="138" height="211">
					<img src="images/gen/white.gif" width="138" height="1" alt=""><br>
					<img src="images/bg/b_right.gif" width="138" height="210" alt=""><br></td>
				</tr>
			</table>
		</td>

	</tr>
</table>
<script type="text/javascript">

function updateSection(name){
  $("port_menus").slideUp("fast" , 
    function() {
      $("#"+name).slideDown("slow");
    }
  );
  return false;
}

function updatePage(name){
  return false;
}

</script>
</body>			
</html>