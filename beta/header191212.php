<? 
session_start();

  if(!isset($_COOKIE["currency"])){
  setcookie("currency", 1, 0, "/");
   header("location: ".$_SERVER['REQUEST_URI']);    
  }
  
  require_once("useractions.php");
  header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
 // header("Cache-control: private");
  
  linkme();

  $page_title = 	"Labels, name tags, fund raising - identi Kid online";
  $row = false;

  $this_file_name = $_SERVER['PHP_SELF'];
  if (strpos($this_file_name,"/multiple_pages.php")) 
  {
    $pageid = -222;
	 $page_title 	= "Page Results";
	 $breadcrumb = 'Page Results';
  }
  else
  {
     if(!$pageid) {
	   $pageid = (int)$_GET['page'];
     }
     
     $sql = " SELECT * FROM site_pages WHERE page_id ='$pageid'";
     $result = db_query($sql);
     $row = mysql_fetch_assoc($result);
     $page_name 	= $row['page'];
     $page_title = $row['page_title']!=''?$row['page_title']:($page_name!=''?$page_name:$page_title);
     $breadcrumb = false;
    
  }
  
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Identikid - <?=$page_title?></title>
	<meta name="keyword" content="Labels, name tags, fund raising, label, clothing tag, personal labels, iron-on tags, school bag,  easy fundraising, pencil, labels, vinyl label, allergy, gift cards, identikid">
	<meta name="description" content="Labels & name tags for everything supplied by Identi Kid. Hassle-free fund raising with personalised labels from Identi Kid.  Quality name tags in clothing can help reduce the loss of personal property. Put labels onto anything leaving the house.">
	<META NAME="expires" CONTENT="">
	<META NAME="language" CONTENT="english">
	<META NAME="charset" CONTENT="ISO-8859-1">
	<META NAME="distribution" CONTENT="Global">
	<META NAME="robots" CONTENT="INDEX,FOLLOW">
	<META NAME="email" CONTENT="">
	<meta name="author" content="echidnaweb">
	<META NAME="publisher" CONTENT="identiKid">
	<META NAME="copyright" CONTENT="Copyright �2008 - identiKid">
	<base href="http://<?php echo $_SERVER['HTTP_HOST']; ?>" />
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"> 
	
<script src="<?php print SITE_URL;?>js/AC_OETags.js" language="javascript"></script>
<script language="JavaScript" type="text/javascript">
<!--
// -----------------------------------------------------------------------------
// Globals
// Major version of Flash required
var requiredMajorVersion = 7;
// Minor version of Flash required
var requiredMinorVersion = 0;
// Minor version of Flash required
var requiredRevision = 0;
// -----------------------------------------------------------------------------
// -->
</script>
</head>

<script type="text/javascript">
<!--
	var fileLoadingImage = '<?php print SITE_URL;?>images/gen/loading.gif';
	var fileBottomNavCloseImage = '<?php print SITE_URL;?>images/gen/closelabel.gif';
	var resizeSpeed = 5;
	var 	borderSize = 10;
	var animate = true;
	var overlayOpacity = 0.8;
//-->
</script>

<script type="text/javascript" src="<?php print SITE_URL;?>js/jquery-1.2.6.js"></script>
<script type="text/javascript" src="<?php print SITE_URL;?>js/pos.js"></script>	
<!--<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/effects.js"></script>
<script type="text/javascript" src="js/lightbox.js"></script>-->
<script type="text/javascript" src="<?php print SITE_URL;?>js/jquery.blockUI.js"></script>	
<script type="text/javascript" src="<?php print SITE_URL;?>js/interface.js"></script>
<script type="text/javascript" src="<?php print SITE_URL;?>js/menu_data.js"></script>	
<script type="text/javascript" src="<?php print SITE_URL;?>js/maps.js"></script>	
<script type="text/javascript" src="<?php print SITE_URL;?>js/validate.js"></script>	
<script type="text/javascript" src="<?php print SITE_URL;?>js/auto_iframe.js"></script>
<script type="text/javascript" src="<?php print SITE_URL;?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php print SITE_URL;?>js/jquery.dimensions.js"></script>
<script type="text/javascript" src="<?php print SITE_URL;?>js/ienoscript.js"></script>
<script type="text/javascript" src="<?php print SITE_URL;?>js/jquery.lightbox.js"></script>

<script type="text/javascript" src="<?php print SITE_URL;?>js/milonic_src.js"></script>	
<!-- <noscript><a href="http://www.milonic.com/">DHTML JavaScript Website Pull Down Navigation Menu By Milonic</a></noscript> -->
<script type="text/javascript">
if(ns4)_d.write("<scr"+"ipt type=text/javascript src=<?php print SITE_URL;?>js/mmenuns4.js><\/scr"+"ipt>");		
  else _d.write("<scr"+"ipt type=text/javascript src=<?php print SITE_URL;?>js/mmenudom.js><\/scr"+"ipt>"); 
</script>
<script type="text/javascript">

  var init_curr = <?=$_COOKIE["currency"];?>;
  var cart_down = false;
  var cart_loading = false;
  
  $(document).ready(
    function() {
      $('a[rel="lightbox"]').lightbox();
      init();
      $(window).resize(
        function(){
          if($("#shopping_cart").css('display') != 'none'){
					 view_link_pos = findPos("view_order_marker");
                $("#view_order").css('position','absolute');
                $("#view_order").css('left',view_link_pos[0]+'px');
                $("#view_order").css('top', (view_link_pos[1]+1)+'px');
                $("#view_order").css('z-index', '2');
                $("#shopping_cart").css('position','absolute');
                $("#shopping_cart").css('left', (view_link_pos[0]+14)+'px');
                $("#shopping_cart").css('top', (view_link_pos[1]+22)+'px');
          }
        }
      );
      
      $("#view_order").click(shopping_cart);
      $("#view_order").mouseover(shopping_cart_mouse_over);
      $("#view_order").mouseout(shopping_cart_mouse_out);
      $("#shopping_cart").mouseover(shopping_cart_mouse_over);
      $("#shopping_cart").mouseout(shopping_cart_mouse_out);
     }
    );
    
    var shopping_cart_timeout = 0;
    
    var shopping_cart_mouse_out = function() {
      if($("#shopping_cart").css('display') != 'none' && cart_down == true){
        shopping_cart_timeout=setTimeout(shopping_cart,1500);
      }
    }
    
    var shopping_cart_mouse_over = function() {
      if(shopping_cart_timeout != 0){
        clearTimeout(shopping_cart_timeout);
        shopping_cart_timeout = 0;
      }
    }
    
    var shopping_cart = function() {
          if($("#shopping_cart").css('display') != 'none'){
            clearTimeout(shopping_cart_timeout);
            shopping_cart_timeout = 0;
            cart_down = false;
            $("#shopping_cart").css('display', 'none');
            $("#shopping_cart").slideUp('slow',
              function() {
                $("#shopping_cart").css('display', 'none');
                cart_loading = false;
              }
            ); 
          }
          else if(cart_loading != true)
          { 
            cart_loading = true;
            $("#shopping_cart").load("beta/shopping_cart.php",
              function() {
                view_link_pos = findPos("view_order_marker");
                $("#view_order").css('position','absolute');
                $("#view_order").css('left',view_link_pos[0]+'px');
                $("#view_order").css('top', (view_link_pos[1]+1)+'px');
                $("#view_order").css('z-index', '2');
                $("#shopping_cart").css('position','absolute');
                $("#shopping_cart").css('left', (view_link_pos[0]+14)+'px');
                $("#shopping_cart").css('top', (view_link_pos[1]+22)+'px');
                $("#shopping_cart").css('z-index', '1');
					 $("#shopping_cart").css('display', 'none');
                $("#shopping_cart").slideDown('slow', function() {
                   cart_loading = false;
                });  
                cart_down = true;
              }
            ); 
          }
     }
     
     function update_curr() {
       var new_curr = $("#curr_select").val();
       if(confirm("You have selected a new currency,\n Do you wish to continue?")) {
       $.ajax({
         type: "POST",
         url: "set_currency.php",
         data: "currency="+new_curr,
         success: function(msg){
           switch(msg) {
             case "confirm":
                if(confirm("To change currency your order must be reset,\n Do you wish to continue?")) {
                  $.ajax({
                    type: "POST",

                    url: "set_currency.php",
                    data: "currency="+new_curr+"&reset=true",
                    success: function(msg2){
                      if(msg2=="true") {
             			   init_curr = new_curr;
             			   window.location = "<?=$_SERVER['REQUEST_URI']?>";
           				 } else{
                        noCurrChange();
                        alert("Unable to change currency");
                      } 
                    }
                  });
                } else {
                  noCurrChange();
                }
                break;
             case "true":
                init_curr = new_curr;
                window.location = "<?=$_SERVER['REQUEST_URI']?>";
                break;
				 case "false" :
				   noCurrChange();
               alert("Unable to change currency");
               break;	 
				 default:
				   noCurrChange();
               alert("Unable to change currency");
               break;
           }
         }
       });
       }
     }
     
     function noCurrChange() {
       $("#curr_select")[0].selectedIndex = (init_curr-1);
     }
 
</script>

<SCRIPT language=JavaScript type=text/JavaScript>

$(document).ready(function() { 

  $('#loyalty').ajaxForm({beforeSubmit: validateForm, success: updateForm1 } );  
  
}); 


function validateForm(){
   var emailVal=document.loyalty.emailadd.value;
    
   if(document.loyalty.username.value==""){
		alert('Please enter a Name');
		return false;
	}else if(emailVal.indexOf('@')==-1 || emailVal.indexOf('@')==emailVal.length-1 || emailVal.indexOf('.')==-1 || emailVal.indexOf('.')==emailVal.length-1){
		alert('Please enter a valid email address');
      return false;
	}else if(document.loyalty.phonenumber .value==""){
		alert('Please enter a Phone number');
		return false;
	}else{
		return true;
	}
}

function updateForm1() {
  $("#loyaltyDiv").fadeOut("fast", 
    function() {
      $("#loyaltyDiv").html("<table height='100%' width='100%'><tr><td valign='middle' align='center'><b><p>Thank You</p><p>Your loyalty program request has been received. </p></b></td></tr></table>");
      $("#loyaltyDiv").fadeIn("fast");
    }
  );
}

</SCRIPT>
	
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php print SITE_URL;?>js/menu_data.js"></script>	
<body>

<script>

var price = 0;
var symbol = '';
var productName = '';
var args = '';

function arrayCompare(a1, a2) {
    if (a1.length != a2.length) return false;
    var length = a2.length;
    for (var i = 0; i < length; i++) {
        if (a1[i] !== a2[i]) return false;
    }
    return true;
}

function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(typeof haystack[i] == 'object') {
            if(arrayCompare(haystack[i], needle)) return true;
        } else {
            if(haystack[i] == needle) return true;
        }
    }
    return false;
}



function addtooderPOPUP() {

  if(!(productId!="")) return false;

  args = addtooderPOPUP.arguments;

  $.ajax({ type: "POST", data:"id="+productId,url: "product_info.php",  dataType: "xml", success: addtoorderproccess });

}

function checkImgSize(imgId){
   
	if(document.getElementById(imgId).width > 350){
	  if(document.getElementById(imgId).height > 200){
	   document.getElementById(imgId).height = 200;
	  } else {
		document.getElementById(imgId).width = 350;
     }
	} else if(document.getElementById(imgId).height > 200){
	   document.getElementById(imgId).height = 200;
	}
}

function addtoorderproccess(xml) {


  var product = $('product', xml);
  price = new String(product.find('price').text());
  symbol = new String(product.find('symbol').text());
  productName = new String(product.find('productName').text());

  var popup_html = '<form name="addorder" method="POST" action="demo/addtoorder.php">';
  popup_html+='<input type="hidden" name="type" value="'+productId+'">';
  popup_html+='<input type="hidden" name="typedetail" value="">';
  popup_html+='<input type="hidden" name="quantdesc" value="">';
  popup_html+='<input type="hidden" name="price" value="">';
  popup_html+='<input type="hidden" name="design" value="'+productDesign+'">';
  popup_html+='<table width="100%" border="0" >';
  if(picture!=""){
  popup_html+='<tr><td colspan="2" align="center" ><br><img id="popupImg" src="images/'+picture+'" alt="identiKid Products"  border="0"><br><br></td></tr>';
  }
  if(inArray('name', args)){
    popup_html+='<tr><td align="right" width="45%" >Name: </td><td><input type="text" name="name"></td></tr>';
  }
  
  if(typeof(msg) !== 'undefined'){
     popup_html+='<input type="hidden" name="msg_name" value="'+msg[0]+'">';
     var limit = "";
     if(msg[1]!= undefined) {
       limit = '<br><small>( '+msg[1]+' Words )</small>'; 
       popup_html+='<input type="hidden" name="msg_limit" value="'+msg[1]+'">';
     }
     popup_html+='<tr><td align="right" width="45%" >'+msg[0]+': '+limit+' </td><td> <textarea name="msg"></textarea></td></tr>';
  }
  
  if(typeof(colour) !== 'undefined'){
    popup_html+='<tr><td align="right" width="45%" >Colour: </td><td><select name="colour" id="colour">';
    for(var i=0; i<colour.length; i++){
      popup_html+='<option value="'+colour[i]+'">'+colour[i]+'</option>';
    }
    popup_html+='</select></td></tr>';
  }
  if(typeof(material) !== 'undefined'){
    popup_html+='<tr><td align="right" width="45%" >Material: </td><td><select name="material" id="material">';
    for(var i=0; i<material.length; i++){
      popup_html+='<option value="'+material[i]+'">'+material[i]+'</option>';
    }
    popup_html+='</select></td></tr>';
  }
  if(typeof(qty) !== 'undefined'){
    popup_html+='<tr><td align="right" width="45%" >Qty: </td><td><select name="qty" id="qty">';
    for(var i=0; i<qty.length; i++){
      popup_html+='<option value="'+qty[i]+'">'+qty[i]+'</option>';
    }
    popup_html+='</select></td></tr>';
  } 
  
  if(typeof(finePrint) !== 'undefined'){
    popup_html+='<tr><td align="center" colspan="2" ><br>* '+finePrint+'</td></tr>';
  } 
  
  popup_html+='</table>';
  popup_html+='<br><img id="cancelPopup"  src="images/nav/n_back.gif" alt="identi Kid Products - Back" width="58" height="22" style="cursor:pointer;" border="0">';
  popup_html+='&nbsp;&nbsp;<img style="cursor:pointer;" id="addToOrderPopUpButton" src="images/nav/n_add_to_order.gif" alt="identi Kid Products - Add to Order" width="101" height="22" border="0"><br><br>';
  popup_html+='</form>';
  

  $('#popup_product_display').html(popup_html);
  $.blockUI({ 
            message: $('#popup_product_display'), 
            css: { top: '20%' } 
            
  });  
  
  $('#cancelPopup').click($.unblockUI); 
  $('#addToOrderPopUpButton').click(submitProductOPopup); 
  
  checkImgSize("popupImg");
  
  $('#popup_product_display').keypress(function(event) {
	if (event.which == '13') {
		alert("To add this item to the order, click the 'add to order' button");
		event.preventDefault();
	}
	});  
}

function submitProductOPopup()
{

  var qty = document.addorder.qty.value>=1?document.addorder.qty.value:1;
  document.addorder.price.value = (price*qty);
  document.addorder.quantdesc.value = qty+' '+document.addorder.design.value+ ' ' + productName + ' for '+ symbol + (price*qty);
  document.addorder.submit();

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
<div id="popup_product_display" name="popup_product_display" style="display:none;"></div>

<? //include('msg_box.php'); ?> 
<table border="0" cellspacing="0" cellpadding="0" width="998" align="center">
	<tr>
		<td style="width:998;height:239;">
		 <?
		   $header_list = array();
		   if ($handle = opendir('images/heads/'))
		   {
           while (false !== ($file = readdir($handle)))
           {
             if ($file != "." && $file != "..")
             {
               $header_list[] = $file;
             }
           }
         }
         
         if(($num_headers = sizeof($header_list)) > 0) {
           echo('<img src="images/heads/'.$header_list[rand(0,($num_headers-1))].'" width="998" height="239" alt="">');   
         } else {
           echo('<img src="images/heads/header_home.gif" width="998" height="239" alt="">');        
         }
         
       ?>
	  </td>
	</tr>
	<tr>
		<td height="44" bgcolor="#ffffff"><SCRIPT type="text/javascript" src="<?php print SITE_URL;?>js/embed_menu.js"></SCRIPT></td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" width="998">
	<tr>
		<td width="50"><img src="images/gen/spacer.gif" width="50" height="500" alt=""><br></td>
		<td valign="top" width="898">
		  <img src="images/gen/spacer.gif" width="1" height="25" alt=""><br>		
		  <table border="0" cellspacing="0" cellpadding="0" width="898">
		    <tr>
			   <td width="647">
				  <?php 
	  	          
	  	          if($breadcrumb!=false) {
	  	            print $breadcrumb;
	  	          }
	  	          
	             else if ($row!=false){
		    			$parent_id = $row['section_id'];
		    			$parents = array(); 
		      
		    			while(($parent_id != '0') && ($parent_id != 'NULL')) {
		     			 $sql = "SELECT section_id, parent_id, name, default_page FROM site_sections WHERE section_id = '{$parent_id}' ";
		      		 $result = mysql_query($sql);
		      		 if(mysql_num_rows($result) > 0){ 
		        		   $parent_row = mysql_fetch_array($result);
		               $parent_id = $parent_row['parent_id'];
		               if(strtolower($parent_row['name'])== 'pages'){
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
			        
			        krsort($parents);
			        
			        print('<table border="0" cellspacing="-1" cellpadding="-1"  height="39px" align="top"><tr>');
			        $i=0;
			        foreach($parents as $parent){
			          //Custom Exclution For Home Menu Identikid 
			          if($parent['section_id']!=125) {
			          $print_str = '<td><table border="0" cellspacing="0" cellpadding="0"  height="38px"><tr><td height="30px"><a href="';
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
			          $print_str.= "\" onMouseOut=\"MM_swapImgRestore();$('#underline_{$parent_parent['section_id']}').attr('src','images/gen/spacer.gif');\" onMouseOver=\"MM_swapImage('bread_{$parent_parent['section_id']}','','font.php?size=15&text={{$parent['name']}}&textColour=365d9c&bgColour=ffffff',1);$('#underline_{$parent_parent['section_id']}').attr('src','images/bread/underline.jpg');\" class=\"breadlink\">
			                           <img id=\"bread_{$parent_parent['section_id']}\" name=\"bread_{$parent_parent['section_id']}\" border=\"0\" src=\"font.php?size=15&text={{$parent['name']}}&textColour=5c80ba&bgColour=ffffff\"  alt=\"{$parent['name']}\"></a> 
			                         </td>
			                       </tr>
			                       <tr>
			                         <td height=\"8px\" align=\"center\" >
			                           <img width=\"60px\" height=\"8px\" id=\"underline_{$parent_parent['section_id']}\" name=\"underline_{$parent_parent['section_id']}\" src=\"images/gen/spacer.gif\" alt=\"\"  border=\"0\">
			                         </td>
			                       </tr>
			                     </table>
			                   </td>
			                   <td align=\"top\" ><img src=\"images/bread/divider.gif\" alt=\"&gt;\" width=\"41\" height=\"38\" border=\"0\"></td>";  
			          print($print_str);
			          $i++;
			          }
			        }	
                              
			        echo " <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"  height=\"38px\"><tr><td height=\"30px\"><img src=\"font.php?size=15&text={{$row['page']}}&textColour=5c80ba&bgColour=ffffff\"  alt=\"{$row['page']}\"></td></tr><tr><td  height=\"8px\" ><img src=\"images/gen/spacer.gif\" alt=\"\"  height=\"8\" width=\"1\" border=\"0\"></td></tr></table>";   
		           print('</td></tr></table>');
	  	         }
	  	       ?>	
				  </td>
				  <td width="151px" height="43px" align="right" v-align="top" >
				    <div id="view_order_marker" style="width:151px;height:43px;cursor:pointer;text-align:rght;vertical-align:top;">
				      <img onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('view_order','','images/bread/n_view_order_x.gif',1);" src="images/bread/n_view_order_o.gif" alt="identi Kid Products - View My Order" name="view_order" id="view_order" width="151" height="43">			    
				 	 </div>
				    <div style="display:none;width:137px;text-align:right;position:absolute;left:0px;top:0px;" id="shopping_cart" name="shopping_cart" ></div>
				  </td>
				  <td width="100px" height="43px" align="right" style="background-image:url(images/bread/n_curr.gif); background-repeat:no-repeat;">
				    <!--<img  border="0" src="font.php?size=15&text=AU    &textColour=ffffff&bgColour=5b7fbb"  alt="AU    ">-->
				    <select id="curr_select" onChange="update_curr();">
				      <option value="1" <?=$_COOKIE["currency"]==1?"selected":""?> >AU$</option>
				      <option value="2" <?=$_COOKIE["currency"]==2?"selected":""?> >US$</option>
				      <option value="3" <?=$_COOKIE["currency"]==3?"selected":""?> >EU&euro;</option>
				      <option value="5" <?=$_COOKIE["currency"]==5?"selected":""?> >NZ$</option>
				    </select>&nbsp;
				  </td>
				</tr>
			</table>	
			<img src="images/gen/spacer.gif" width="1" height="7" alt=""><br>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <?

				    if($row['section_id'] != '0' && $row['section_id'] != '1' && $row['section_id'] != '2' &&
				       $row['section_id'] != '125' && ($pageid != 5) && $pageid > 0 ) {  
				    
				      $pages = array();
				      
				      $sql = "SELECT `site_pages`.`page_id`, `site_pages`.`sort_order` FROM `site_pages`
				        WHERE `site_pages`.`section_id` = {$row['section_id']} AND  page_id!='308'";
				      $result = mysql_query($sql);
				      while($pages_row = mysql_fetch_array($result)) {
				        $pages[$pages_row['sort_order']] = $pages_row['page_id'];
				      }
				    
				      $sql = "SELECT `site_sections`.`default_page`, `site_sections`.`sort_index` FROM `site_sections`
				        WHERE `site_sections`.`parent_id` = {$row['section_id']} ";
				      $result = mysql_query($sql);
				      while($pages_row = mysql_fetch_array($result)) {
				        $pages[$pages_row['sort_index']] = $pages_row['default_page'];
				      }  
				    
				      $numPages = sizeof($pages);
				     
				      if($numPages > 2) {
				      
				        if($pages[0]!= '') $pages[0]=''; 
				        ksort($pages);
				    
				        $i = 2;
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
			        
			               krsort($parents);
                           $print_str = '<td class="breadlink"  ><a href="beta/';
			               foreach($parents as $parent_parent) {
			                 $print_str.= str_replace(" ", "_", $parent_parent['name']);
			                 $print_str.= "/";
			               }
			               $print_str.= str_replace(" ", "_", $row['page'])."\" class=\"breadlink\" >{$row['page']}</a></td>";  
			               $print_str.=$i<$numPages?"<td><img src=\"images/bread/sn_divider.gif\" alt=\"\" width=\"19\" height=\"28\" border=\"0\"></td>":"";
			               print($print_str);
		                  $i++;
	  	                }			
                    } 
                  }
                }
			        
				  ?>
				</tr>
			</table>	
			<img src="images/gen/spacer.gif" width="1" height="30" alt=""><br>
			<table border="0" cellspacing="0" cellpadding="0" width="890">
				<tr>
					<td align="left" valign="top">