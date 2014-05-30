<?PHP 
	include("header.php"); 
	
	/* 
	//common constants
	require_once('_common/_constants.php');
	//db setup - configure & set up db connection
	require_once(SITE_DIR.'_common/_connection.php');
	$cfg = new Config();
	$db = new DbConnect($cfg);
	$db->connectDb(); 
	 */
   $pages = split(";", substr($_GET['pages'], 0, -1));
   $num_pages = sizeof($pages);

?>
	
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td>
				<?php echo "<strong>There are ".$num_pages." pages with the name you specified please select the page you are looking for below</strong>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				<img src="images/gen/line.gif" width="634" height="1">
			</td>
		</tr>
		<tr>
	     <td>
		    <br>
		      <?php
			     foreach( $pages as $pageid ) {
			    
				    $sql = "SELECT section_id, page, page_id FROM site_pages WHERE page_id ='$pageid'";
				    $result = mysql_query($sql);
				   
	             if (mysql_num_rows($result) > 0){
		   		   $row = mysql_fetch_array($result);
		    			$parent_id = $row['section_id'];
		    			$parents = array(); 
		      
		    			while(($parent_id != '0') && ($parent_id != 'NULL')) {
		     			 $sql = "SELECT parent_id, name, default_page FROM site_sections WHERE section_id = '{$parent_id}' ";
		      		 $result = mysql_query($sql);
		      		 if(mysql_num_rows($result) > 0){ 
		        		   $parent_row = mysql_fetch_array($result);
		               $parent_id = $parent_row['parent_id'];
		               if($parent_row['name'] == 'Pages'){
		                 $offset = strpos($_SERVER['HTTP_REFERER'], 'page=') + 5;
		                 $parentPage = substr($_SERVER['HTTP_REFERER'], $offset); 
		                 $sql = "SELECT section_id, page as name, page_id as default_page FROM site_pages WHERE page_id = '{$parentPage}'";
		      	        $result = mysql_query($sql);
		      	        if(mysql_num_rows($result) > 0){ 
		      	          $parent_row = mysql_fetch_array($result);
		      	          $parent_id = $parent_row['section_id'];
		      	          $sql = "SELECT default_page FROM site_sections WHERE section_id = '{$parent_id}' ";
		      	          $result = mysql_query($sql);
		      	          if(mysql_num_rows($result) > 0){ 
		      	            $check_row = mysql_fetch_array($result);
		      	            if($parent_row ['default_page'] != $check_row['default_page'] ) {
		      	              $parents[] = $parent_row;
		      	            }
		      	          } else {
		      	            $parents[] = $parent_row;
		      	          } 
		      	        }
		               } else if(($parent_row['default_page'] != $pageid)) {
		                 $parents[] = $parent_row; 
		               } 
		             } else {
		               $parent_id = '0'; 
		             }
		           }
		           //print_r($parents);
		    
		           if( $row['page'] != 'Home') {
			          echo '<a href="Home" class="breadlink">Home</a> &gt;';
			        }
			        
			        krsort($parents);

			        $i=0;
			        foreach($parents as $parent){
			          $print_str = '<a href="';
			          $j = 0;
			          foreach($parents as $parent_parent) {
			            $print_str.= str_replace(" ", "_", $parent_parent['name']);
			            if($j<$i) {
			              $print_str.= "/";
			            } else {
			              break;
							}
			            $j++;
			          }
			          $print_str.= "\" class=\"breadlink\">{$parent['name']}</a> &gt;";  
			          print($print_str);
			          $i++;
			          //echo " <a href=\"content.php?page={$parent['default_page']}\" class=\"breadlink\">{$parent['name']}</a> &gt;";  
			        }	
                 
                 $print_str = '<a href="';
			        foreach($parents as $parent_parent) {
			          $print_str.= str_replace(" ", "_", $parent_parent['name']);
			          $print_str.= "/";
			        }
			        $print_str.= str_replace(" ", "_", $row['page'])."\" class=\"breadlink\">{$row['page']}</a><br><br>";  
			        print($print_str);
                 
			        //echo " <a href=\"'{$row['page']}\" class=\"breadlink\">{$row['page']}</a><br><br>";   
		    
	  	         }			

               }
		       ?>
		     <br>       
			</td>
		</tr>
	</table>					
				
<?PHP  include("footer.php");?>
</body>
</html>
