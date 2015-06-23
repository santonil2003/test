<link type="text/css" rel="Stylesheet" href="css/starter_pack.css" />
<?php
require_once 'include.php';
if (isset($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR'] == '127.0.0.1') {
            $dbhost='localhost';
            $dbuser='root';
            $dbpass='';
            $dbname='identikid';
        } else {
            $dbhost='localhost';
            $dbuser='identiki';
            $dbpass='id4$cTe';
            $dbname='identikid';
        }

mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
require_once 'helper.php';
$productId = 10;
$reverse_print_charge = 4.00;
?>
        <script type="text/javascript">
        $(document).ready(function(){
           var _colourArray = new Array();
           <?php
                
                $getColourArray = mysql_query("SELECT * FROM designer_colours");
                while( $row = mysql_fetch_array($getColourArray) ){
                    echo "_colourArray[".$row['colour_id']."] = '".$row['hex']."';\n";
                }
           ?>
           
           var _type = eval('<?php echo $productId;?>');
           <?php
                
                $getPrice = mysql_query("SELECT * FROM prices WHERE productId = '$productId' AND currencyInt='1'");
                while( $row = mysql_fetch_array($getPrice) ){
                    echo "var _price = '".$row['price']."';\n";
                    $price = $row['price'];
                }
           ?>
           
           
           var _bwImage = "";
           var _showName = 1;
           var _showPhone = 1;
           var _showImage = 1;
           var _name = null;
           var _phone = "";
           var _font = 3;
           var _fontColor = 2;
           var _colorPack = null;
           var _label = null;
           var _iron_colour = null;
           var _identiTAG = null;
           var _reversePrint = 0;
           var _quantity = null;
           
           var imgfol = "bwl2";
           
           //init
           if(_colorPack==null){
               $("input.Rainbow_A").prop("selected","selected");
               for(var i=0;i<_colourArray.length;i++){
                   var col = $("input.Rainbow_A").prop("class");
                   
                   if(col.replace("_"," ")==_colourArray[i]){
                       _colorPack = i;
                       $('#designer_preview').css('background','url(images/preview/'+i+'.png) no-repeat');
                    }
                }
         }
         
         if(_fontColor==2){
             $(".preview_text").css('color','#FFFFFF');
             $(".preview_phone").css('color','#FFFFFF');     
         }
         
         if(_bwImage==""){
           _bwImage = 1;
           $(".preview_image_set").show();
           $(".preview_image_set").css("background-image","url(images/"+imgfol+"/"+_bwImage+".png)");
         }
         
         $(".font_colour_white").addClass("selected");
<?php
$ver = $_SERVER['HTTP_USER_AGENT'];
if(strpos($ver,'Chrome') || strpos($ver,'Firefox')){ ?>
        $(".1","#designer_options_font").css('padding','5px 0 5px 0');
        $(".4","#designer_options_font").css('padding','5px 0 5px 0');
        $(".3","#designer_options_font").css('padding-bottom','20px');   
<? }else{ ?>
        $(".3","#designer_options_font").css('padding','10px 0 10px 0');
        $(".3","#designer_options_font").css('margin-top','5px');
        $(".1","#designer_options_font").css('padding-bottom','20px');
        $(".4","#designer_options_font").css('padding','0px');
 <? } ?>
        if(_font==3){
            $(".3","#designer_options_font").addClass('selected');
            var fontset = $(".3","#designer_options_font").css('font-family');
            $('.preview_text').css('font-family',fontset);
            $('.preview_phone').css('font-family',fontset);
            $('.preview_text').css('top','4px');
            $('.preview_text').css('left','0px');
            $('.preview_phone').css('top','50px');
            $('.preview_phone').css('left','0px');
        } 
         
           //Details
           $(".details_checkbox_name").click(function(){
               if($(this).prop("checked")){
                   $(".preview_text").show();
                   _showName = 1;
               }else{
                   $(".preview_text").hide();
                   _showName = 0;
               }
           });
           
           var temp_phone = '';
           
           $(".details_checkbox_phone").click(function(){
               if($(this).prop("checked")){
                   $(".preview_phone").show();
                   $('.details_text_phone').val(temp_phone);
                   _showPhone = 1;
                   if(_font==3){
                         $('.preview_text').css('top','4px');
                        }else{
                            $('.preview_text').css('top','10px');
                        }
               }else{
                   $(".preview_phone").hide();
                   _showPhone = 0;
                       temp_phone = $('.details_text_phone').val();
                   $('.details_text_phone').val('');
                   _phone = '';
                   if(_font==3){
                         $('.preview_text').css('top','10px');
                        }else{
                            $('.preview_text').css('top','20px');
                        }
               }
           });
           
           $(".details_checkbox_pic").click(function(){
               if($(this).prop("checked")){
                   $(".preview_image_set").show();
                   _showImage = 1;
               }else{
                   $(".preview_image_set").hide();
                   _showImage = 0;
                   _bwImage = "";
               }
           });
           
           $(".details_text_name").keyup(function(){
               var data = $(this).val();
              $(".preview_text").text(data); 
              _name = data;
           });
           $(".details_text_phone").keyup(function(){
               var data = $(this).val();
              $(".preview_phone").text(data); 
              _phone = data;
           });
           
           //BW Pics
          /* $("li","#designer_options_picture").hover(function(){
               $(".preview_image_set").hide();
               $(".preview_image").show();
               $(".preview_image").css("background-image",$(this).prop("rel"));
           });*/
           $("li","#designer_options_picture").click(function(){
               $(".preview_image").hide();
               $(".preview_image_set").show();
               $(".preview_image_set").css("background-image","url(images/"+imgfol+"/"+$(this).prop("class")+".png)");
               _bwImage = $(this).prop("class");
           });
           
           //Font
           $("li","#designer_options_font").click(function(){
               $("li","#designer_options_font").removeClass('selected');
               $(".preview_text").css("font-family",$(this).prop("class"));
               _font = $(this).prop("class");
               $(this).addClass('selected');
               var fontset = $(this).css('font-family');
               $('.preview_text').css('font-family',fontset);
               $('.preview_phone').css('font-family',fontset);
               if(_font==1){
                   $('.preview_text').css('top','10px');
                   $('.preview_text').css('left','0px');
                    $('.preview_phone').css('top','55px');
                    $('.preview_phone').css('left','0px');
               }else if(_font==3){
                    $('.preview_text').css('top','4px');
                   $('.preview_text').css('left','0px');
                    $('.preview_phone').css('top','50px');
                    $('.preview_phone').css('left','0px');
                }else if(_font==4){
                    $('.preview_text').css('top','10px');
                   $('.preview_text').css('left','0px');
                    $('.preview_phone').css('top','55px');
                    $('.preview_phone').css('left','0px');
                 }
                 if( $(".details_checkbox_phone").prop("checked") ){
                     
                         
                         if(_font==3){
                         $('.preview_text').css('top','4px');
                        }else{
                            $('.preview_text').css('top','10px');
                        }
                    }else{
                          if(_font==3){
                         $('.preview_text').css('top','10px');
                        }else{
                            $('.preview_text').css('top','20px');
                        }
                    }
                
                
           });
           
           //Font Colour
           $("span","#designer_options_font_colour").click(function(){
               $("span","#designer_options_font_colour").removeClass('selected');
              if($(this).prop("class")=="font_colour_black"){
                  _fontColor = 1;
                  $(this).addClass('selected');
                  $(".preview_text").css('color','#000000');
                  $(".preview_phone").css('color','#000000');
                  imgfol = "bwl";
                  var bg = $(".preview_image_set").css("background-image");
                  $(".preview_image_set").css("background-image",bg.replace("/bwl2/","/bwl/"));
              }else{
                  _fontColor = 2;
                  $(this).addClass('selected');
                  $(".preview_text").css('color','#FFFFFF');
                  $(".preview_phone").css('color','#FFFFFF');
                  imgfol = "bwl2";
                  var bg = $(".preview_image_set").css("background-image");
                  $(".preview_image_set").css("background-image",bg.replace("/bwl/","/bwl2/"));
              } 
           });
           
            //Color Pack
           $("input","#designer_options_colours").click(function(){
              var col;
              $("span","#designer_options_colours").removeClass("selected");
              if($(this).prop("class")=="Individual"){ 
                  
                 
                  var parent = $(this).parent();
                 
                  col = $("span",parent).first().prop("class");
                  $("span",parent).first().addClass("selected");
                  
              }else{
                  col = $(this).prop("class"); 
              }
               
               
               for(var i=0;i<_colourArray.length;i++){
                   if(col.replace("_"," ")==_colourArray[i]){
                       _colorPack = i;
                       $('#designer_preview').css('background','url(images/preview/'+i+'.png) no-repeat');
                    }
                }
               
           });
           $("span","#designer_options_colours").click(function(){
               var parent = $(this).parent();
               var checkbox = parent.find('input');
               
               
               var col;
               if(parent.prop("class")=="Individual" && checkbox.prop("checked")){ 
                   
                   $("span","#designer_options_colours").removeClass("selected");
                   
                   
                   col = $(this).prop("class");
                  for(var i=1;i<=_colourArray.length;i++){
                   if(col==_colourArray[i]){
                       _colorPack = i;
                       $('#designer_preview').css('background','url(images/preview/'+i+'.png) no-repeat');
                    }
                }
                $(this).addClass("selected");
                 }
             });
           
           //Label
           if(_label==null){
            _label = 1;
            $("input.1","#designer_options_label").prop("checked","checked");
           
             }
           $("li","#designer_options_label").click(function(){
               
               _label = $(this).prop("class");
               
           });
           
           //Iron on Colour
           $("li","#designer_options_ironon_colour").click(function(){
               //$("li","#designer_options_ironon_colour").removeClass('selected');
               _iron_colour = $(this).prop("class");
               if(_iron_colour=='8'){
                   $(".warn").text("You have chosen 'white' for your iron-on colour. The text on the irons will be printed in 'black' only.");
                }else{
                    $(".warn").text('');
                }
               //$(this).addClass('selected');
               
           });
           
           $("li","#designer_options_identitags").click(function(){
              $("#selected_identitag").val($(this).prop("class"));
              _identiTAG = $(this).prop("class");
           });
           
           //Reverse print
           $("#reverse_print").click(function(){
               if($(this).prop("checked")){
                   _reversePrint = 1;
                   
               }else{
                   _reversePrint = 0;
               }
           });
           
           //Quantity
           
           
        
          
           $("#order_quantity").change(function(){
                _quantity = $(this).find(":selected").text();
                var multiply = $(this).find(":selected").val();
                _price = multiply;
                
           });
           
           $("#order_quantity").trigger('change');
           
           $("#submit").click(function(){
               var reverse_print_charge = eval(<?php echo $reverse_print_charge; ?>);
               console.log('test');
               if(_font==3){
                   _font=4;
                }else if(_font==4){
                    _font=3;
                }
               if(_reversePrint==1){
                   var starter_pack_price = eval($('#order_quantity').val());
                   _price = eval(starter_pack_price+reverse_print_charge);
        }

        if(_bwImage==""){
            _bwImage=0;
        }
        
         if(_showName!==0 && _name===null) {
             $('.details_text_name').addClass('error-msg').focus().click(function(){$(this).removeClass('error-msg')});
             return false;
          }
                        
          if(_showPhone!==0 && _phone===''){
              $('.details_text_phone').addClass('error-msg').focus().click(function(){$(this).removeClass('error-msg')});
              return false;
          }
          
          
          
          if(_identiTAG===null){
            $('#selected_identitag').addClass('error-msg').focus().click(function(){$(this).removeClass('error-msg')});
             return false;
          }
          
        
        if(_type!=null && 
                      _price!=null && 
                      
                        _showName!=null && 
                        _showPhone!=null && 
                        _showImage!=null && 
                        _name!=null && 
                        //_phone!=null && 
                        _font!=null && 
                        _fontColor!=null && 
                        _colorPack!=null && 
                        _label!=null && 
                        //_iron_colour!=null && 
                        _identiTAG!=null && 
                        _quantity!=null){
                    

var f = document.createElement("form");
f.setAttribute('method',"post");
f.setAttribute('target',"_top")
f.setAttribute('action',"/addtoorder.php");

var a = document.createElement("input"); //input element, text
a.setAttribute('type',"hidden");
a.setAttribute('name',"background_colour");
a.setAttribute('value',_colorPack)

var b = document.createElement("input"); //input element, text
b.setAttribute('type',"hidden");
b.setAttribute('name',"font");
b.setAttribute('value',_font);

var c = document.createElement("input"); //input element, text
c.setAttribute('type',"hidden");
c.setAttribute('name',"font_colour");
c.setAttribute('value',_fontColor);

var d = document.createElement("input"); //input element, text
d.setAttribute('type',"hidden");
d.setAttribute('name',"pic");
d.setAttribute('value',_bwImage);


var picon = document.createElement("input"); //input element, text
picon.setAttribute('type',"hidden");
picon.setAttribute('name',"picon");

ischecked = $('.details_checkbox_pic').is(':checked');

if(ischecked) {
    valpicon = '1';
} else {
   valpicon = '0';
}
picon.setAttribute('value',valpicon);

var e = document.createElement("input"); //input element, text
e.setAttribute('type',"hidden");
e.setAttribute('name',"text3");
e.setAttribute('value',_identiTAG);


var g = document.createElement("input"); //input element, text
g.setAttribute('type',"text");
g.setAttribute('name',"identitagReserve");
g.setAttribute('value',_reversePrint);


var h = document.createElement("input"); //input element, text
h.setAttribute('type',"hidden");
h.setAttribute('name',"typedetail");
h.setAttribute('value',1);

var i = document.createElement("input"); //input element, text
i.setAttribute('type',"hidden");
i.setAttribute('name',"text1");
i.setAttribute('value',_name);

var j = document.createElement("input"); //input element, text
j.setAttribute('type',"hidden");
j.setAttribute('name',"text2");
j.setAttribute('value',_phone);

var k = document.createElement("input"); //input element, text
k.setAttribute('type',"hidden");
k.setAttribute('name',"chosenLabel");
k.setAttribute('value',_label);

var l = document.createElement("input"); //input element, text
l.setAttribute('type',"hidden");
l.setAttribute('name',"price");
l.setAttribute('value',_price);

var m = document.createElement("input"); //input element, text
m.setAttribute('type',"hidden");
m.setAttribute('name',"type");
m.setAttribute('value',_type);

var n = document.createElement("input");
n.setAttribute('type','hidden');
n.setAttribute('name','quantdesc');
n.setAttribute('value',_quantity);

var s = document.createElement("input"); //input element, Submit button
s.setAttribute('type',"submit");
s.setAttribute('value',"Submit");




f.appendChild(a);
f.appendChild(b);
f.appendChild(c);
f.appendChild(d);
f.appendChild(e);
f.appendChild(g);
f.appendChild(h);
f.appendChild(i);
f.appendChild(j);
f.appendChild(k);

f.appendChild(l);
f.appendChild(m);
f.appendChild(n);
f.appendChild(picon);
//and some more input elements here
//and dont forget to add a submit button

document.getElementsByTagName('body')[0].appendChild(f);
document.getElementsByTagName('form')[0].submit();

                    }else{
                        if($('.details_text_name').val()==='') {
                            $('.details_text_name').addClass('error-msg').focus().click(function(){$(this).removeClass('error-msg')});
                        }
                        
                        if($('.details_text_phone').val()===''){
                            $('.details_text_phone').addClass('error-msg').focus().click(function(){$(this).removeClass('error-msg')});
                        }
                        
                    //alert("Please complete all options");
                    }
        
        
        
        
        
           });
           
        });    
        </script>
       
        <!--[if IE]>
<style type=\"text/css\">

#designer_options_font ol lo.3{
    margin-top:5px;
    padding-bottom:10px;
    padding-top:10px;
}
#designer_options_font ol li.4{
    padding:0;
}

</style>
<![endif]-->
        <div id="starter-pack">
        <div id="designer_container" style="width:960px;">
             <div class="fixed_preview" style="width:930px;">
            <div id="designer_preview_text">
                Format will be improved prior to Print.
                This is just a idea of how the label font, colours and pic look together.
                One label is shown for demonstration . However this pack comes with a variety of labels as shown in more info including irons, shoe dots and various other stickon labels.
            </div>
            <div id="designer_preview">
                <span class="preview_text">Preview Text</span>
                <span class="preview_phone">0000 000 000</span>
                <span class="preview_image"></span>
                <span class="preview_image_set"></span>
            </div>
             </div>
            <div class="designer-options">
<div class="box">
            <div id="designer_options_details">
                
                <p><strong>Include: </strong>
                    <span><input type="checkbox" checked="checked" name="details_checkbox_name" class="details_checkbox_name" /> Line 1</span>
                    <span><input type="checkbox" checked="checked" name="details_checkbox_phone" class="details_checkbox_phone" /> Line 2</span>
                    <span><input type="checkbox" checked="checked" name="details_checkbox_pic" class="details_checkbox_pic" /> Pic</span>
                </p>
                <p>
                    <strong>Line 1:</strong> <input type="text" class="details_text_name" maxlength="20"/> 
                    <strong>Line 2:</strong> <input type="text" class="details_text_phone" maxlength="22"/> 
                </p>
            </div>
</div>
            <div class="box">
            <div id="designer_options_picture">
                <strong>Choose a picture by clicking on an icon:</strong>
                <div>
                    <?php
                        //pull images from DB here
                    $query = mysql_query("SELECT * FROM designer_bwimages");
                    if(mysql_num_rows($query)>0){
                        while($val = mysql_fetch_array($query)){
                            $pictures[$val['id']]=$val['image'];
                        }
                    }
                /* designer_bwimages
                 * 
                 * id
                 * imageName
                 * image
                 */
                    echo "<ul>";
                    $skip = array(44);
                        foreach( $pictures as $ref => $picture ){
                            if(in_array($ref, $skip)){
                                continue;
                            }
                            echo "<li class='".$ref."' rel='".$picture."' style='background-image:url(http://identikid.com.au/_designer/".str_replace("bw","bwl",$picture).")'></li>";
                            
                        }
                    
                    echo "</ul>";
                    echo "<div style='clear:both'></div>";
                    ?>
                </div>
            </div>
            </div>
            
            <div class="box">
            <div id="designer_options_font">
                
                <strong>Font:</strong>
                <?php
                    //pulll fonts from DB here
                    $query = mysql_query("SELECT * FROM designer_fonts WHERE fontValue = '1' OR fontValue = '3' OR fontValue='4'");
                    if(mysql_num_rows($query)>0){
                        while($val = mysql_fetch_array($query)){
                            $fonts[$val['fontName']]=$val['fontValue'];
                        }
                    }                
                /* designer_fonts
                 * 
                 * id
                 * fontName
                 * fontFile
                 * 
                 */
                    echo "<ol>";
                    
                        foreach( $fonts as $fontName=>$fontFile ){
                            if($fontFile!='3'){
                                echo "<li class='".$fontFile."' style='font-family:".$fontName.";'>Ginger Meggs</li>";
                            }else{
                                echo "<li class='".$fontFile."' style='font-family:".$fontName.";'>Ginger Meggs</li>";
                            }
                            
                            
                        }
                    
                    echo "</ol>";
                ?>
                
            </div>
            
            <div id="designer_options_font_colour">
                <strong>Font Colour:</strong>
                <span class="font_colour_black"></span>
                <span class="font_colour_white"></span>
            </div>
            
            <div id="designer_options_colours">
                <strong>Choose a colour set:</strong>
                <?php
                        //pull colour from DB here
                $query = mysql_query("SELECT * FROM designer_colour_sets");
                    if(mysql_num_rows($query)>0){
                        while($val = mysql_fetch_array($query)){
                            $colourSets[$val['colourSetName']]=$val['colourArray'];
                        }
                    } 
                /*
                 * designer_colour_sets
                 * 
                 * id
                 * colourSetName
                 * colourArray (red,green,blue)
                 * 
                 */
                    echo "<ul>";
                    
                        foreach( $colourSets as $colourName => $colourSet ){
                            $colourName = str_replace(" ", "_", $colourName);
                            
                            echo "<li class='".$colourName."'><div style='float:left;'>";
                            if($colourName=='Individual'){
                                echo "Individual (choose a colour by clicking on it)";
                            }else{
                               echo str_replace("_"," ",$colourName); 
                            }
                                    $id = uniqid();
                                    echo "</div><input style='clear:both;float:left' type='radio' name='colour[]' value='".$colourName."' class='".$colourName."' id='$id'>";
                                $colours = explode(",",$colourSet);
                                foreach($colours as $colour){
                                    echo "<span style='background:".$colour."' class='".$colour."' onclick=checkradio('$id')></span>";
                                }
                            echo "</li>";
                            
                        }
                    
                    echo "</ul>";
                    ?>
            </div>
            
            
            </div>
            
            <div class="box label-type">
                <div id="designer_options_label"> 
                    <ul>
                        <li><strong>Label Type:</strong></li>
                        <li>
                            <input type="radio" name="label_option[]" checked/>
                            30 Mini Labels
                        </li>
                        <li>
                            <input type="radio" name="label_option[]"/>
                            60 Pencil Labels
                        </li>
                        
                        <li>
                            <br>
                        </li>
                        
                        <li>
                            <div>
                                Irons ons: <input type="radio" checked name="irons_ons"/>
                                <br/>
                                <div>
                                    <img src="images/irons-ons.png"/>
                                    <div style="text-align: center;font-size: 10px;"><em>Note: Irons ons will match starter pack picture and text</em></div>
                                </div>
                            </div>
                        </li>
                    </ul> 
                    
                    
                
                
                </div>
            
            
            <div id="designer_options_identitags">
                <strong>IdentiTAG: <i>Please choose your tag by clicking on image.</i></strong>
                <?php
                    //pull identiTAG images here
                $query = mysql_query("SELECT * FROM designer_identitag")or die(mysql_error());
                    if(mysql_num_rows($query)>0){
                        while($val = mysql_fetch_array($query)){
                            $identitags[$val['tagCode']]=$val['image'];
                        }
                    }
                /* designer_identitag
                 * 
                 * id
                 * tagName
                 * image
                 * tagCode
                 */
                    echo "<ul class='tags'>";
                    
                        foreach( $identitags as $ref => $picture ){
                            
                            echo "<li class='".$ref."' style='background:url(http://identikid.com.au/".$picture.") no-repeat;width:50px;height:50px;background-size:45px 45px;border:solid 1px #ddd;'></li>";
                            
                        }
                    
                    echo "</ul>";
                    echo "<div style='clear:both'></div>";
                    echo "<input type='text' value='' id='selected_identitag' size='6' readonly='readonly' /> Selected IdentiTAG <br><span style='color:Red;padding:5px;' class='error-identitag'></span>";
                ?>
            </div>
</div>
            <div class='box' style='text-align:center;'>
            <div id="designer_options_reverse_print">
                  <input type='checkbox' id="reverse_print" /> Text printed on reverse of tag? (add AU$<?php echo $reverse_print_charge;?> to order)
            </div>
            </div>
 </div>
            <div id="designer_options_quantity">
            <span class="scroll-down">Scroll to view all available options</span>
                <strong>Quantity:</strong>
                <?php
                    //pull product quantity details here
                    
                    echo "<select id='order_quantity'>";
                        echo Helper::getExtraPriceOption($productId);
                        echo "<option value='".$price."' selected>1 Starter Pack for AU$ ".$price."</option>";
                    echo "</select>";
                ?>
            </div>
            
            
            
            
            <div id="designer_submit">
                <button id="back">< Back</button>
                <button id="submit">Continue ></button>
            </div>
       
        </div>
            </div>
        
        <script>
            
             function checkradio($id) {
                $('#'+$id).trigger('click');
               }
               
            $(document).ready(function(){
              
                $('#selected_identitag, ul.tags li').click(function(){
                        tmp = $('#selected_identitag').val();

                        $('.error-identitag').html('');
                        $('#selected_identitag').removeClass('error-msg');

                        if(tmp.length<=0) {
                            $('.error-identitag').html('Please select Identi tag from above grid');
                        }
                
                });
            
            });
            </script>
        
