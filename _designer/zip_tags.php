<?php

$dbhost='localhost';
$dbuser='identiki';
$dbpass='id4$cTe';
$dbname='identikid';



mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);



?>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
           
           var _ziptags = new Array();
           <?
           $query = mysql_query("SELECT * FROM data_ziptag")or die(mysql_error());
                    if(mysql_num_rows($query)>0){
                        while($val = mysql_fetch_array($query)){
                            echo "_ziptags['".$val['data_ziptag_code']."'] = '".$val['data_ziptag_number']."';\n";
                        }
                    }        
           ?>
           var _type = 22; //23 is 5 pack options
           _price = '9';
          
           
           
            var _identiTAG = null;
        
           var _quantity = null;
           
         
           
           //init
         
           
          
           $("li","#designer_options_identitags").click(function(){
              //$("#selected_identitag").val($(this).prop("class"));
              //_identiTAG = $(this).prop("class");
              var img = $(this).prop("class");
             // _identiTAG = img;
              $(".preview_image_set").prop("src","/_designer/images/ziptags/"+img.toLowerCase()+".png");
          
          if(img.toLowerCase()=='z7'){
              $('#designer_preview').css('background','url(images/ziptag_preview-z7.png) no-repeat');
        }else{
            $('#designer_preview').css('background','url(images/ziptag_preview.png) no-repeat');
        }
          
          for(key in _ziptags){
            if(key==img){
                _identiTAG = _ziptags[key];
            }
        }
    
    });
           
          
           
           //Quantity
        
           $("#order_quantity").val('1');
           _quantity = $(this).find(":selected").text();
           
           $("#order_quantity").change(function(){
                _quantity = $(this).find(":selected").text();
                var multiply = $(this).find(":selected").val();
                if( multiply=='1' ){
                    _price = '9';
                    _type = 22;
                }else{
                    _price = '10'; 
                    _type = 23;
                }
                
                
           });
           
           $("#submit").click(function(){
               
               
             /* alert(  _type+"\n"+
                      _price+"\n"+
                      _bwImage+"\n"+
                        _showName+"\n"+
                        _showPhone+"\n"+
                        _showImage+"\n"+
                        _name+"\n"+
                        _phone+"\n"+
                        _font+"\n"+
                        _fontColor+"\n"+
                        _colorPack+"\n"+
                        _label+"\n"+
                        _iron_colour+"\n"+
                        _identiTAG+"\n"+
                        _reversePrint+"\n"+
                        _quantity+"\n" ); */
        if(_type!=null && 
                      _price!=null && 
                      
                        _identiTAG!=null && 
                        _quantity!=null){

var f = document.createElement("form");
f.setAttribute('method',"post");
f.setAttribute('target',"_top")
f.setAttribute('action',"/addtoorder.php");


var e = document.createElement("input"); //input element, text
e.setAttribute('type',"hidden");
e.setAttribute('name',"pic");
e.setAttribute('value',_identiTAG);


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




f.appendChild(e);


f.appendChild(l);
f.appendChild(m);
f.appendChild(n);
//and some more input elements here
//and dont forget to add a submit button

document.getElementsByTagName('body')[0].appendChild(f);
document.getElementsByTagName('form')[0].submit();

                    }else{
                    alert("Please complete all options");
                    }
        
        
        
        
        
           });
           
        });    
        </script>
       
        <style type="text/css">
            
            
            
            @font-face {
    font-family: 'comic_sans_msregular';
    src: url('/_designer/fnt/comic-webfont.eot');
    src: url('/_designer/fnt/comic-webfont.eot?#iefix') format('embedded-opentype'),
         url('/_designer/fnt/comic-webfont.woff') format('woff'),
         url('/_designer/fnt/comic-webfont.ttf') format('truetype'),
         url('/_designer/fnt/comic-webfont.svg#comic_sans_msregular') format('svg');
    font-weight: normal;
    font-style: normal;

}




@font-face {
    font-family: 'kidsregular';
    src: url('fnt/kidsn-webfont.eot');
    src: url('fnt/kidsn-webfont.eot?#iefix') format('embedded-opentype'),
         url('fnt/kidsn-webfont.woff') format('woff'),
         url('fnt/kidsn-webfont.ttf') format('truetype'),
         url('fnt/kidsn-webfont.svg#kidsregular') format('svg');
    font-weight: normal;
    font-style: normal;
    

}




@font-face {
    font-family: 'swis721_cn_btroman';
    src: url('fnt/swz721c-webfont.eot');
    src: url('fnt/swz721c-webfont.eot?#iefix') format('embedded-opentype'),
         url('fnt/swz721c-webfont.woff') format('woff'),
         url('fnt/swz721c-webfont.ttf') format('truetype'),
         url('fnt/swz721c-webfont.svg#swis721_cn_btroman') format('svg');
    font-weight: normal;
    font-style: normal;
    

}
 @font-face {
    font-family: 'girls_are_weirdregular';
    src: url('girlw3__-webfont.eot');
    src: url('girlw3__-webfont.eot?#iefix') format('embedded-opentype'),
         url('girlw3__-webfont.woff') format('woff'),
         url('girlw3__-webfont.ttf') format('truetype'),
         url('girlw3__-webfont.svg#girls_are_weirdregular') format('svg');
    font-weight: normal;
    font-style: normal;

}




@font-face {
    font-family: 'impress_btregular';
    src: url('impressn-webfont.eot');
    src: url('impressn-webfont.eot?#iefix') format('embedded-opentype'),
         url('impressn-webfont.woff') format('woff'),
         url('impressn-webfont.ttf') format('truetype'),
         url('impressn-webfont.svg#impress_btregular') format('svg');
    font-weight: normal;
    font-style: normal;

}




@font-face {
    font-family: 'technicalregular';
    src: url('technicn-webfont.eot');
    src: url('technicn-webfont.eot?#iefix') format('embedded-opentype'),
         url('technicn-webfont.woff') format('woff'),
         url('technicn-webfont.ttf') format('truetype'),
         url('technicn-webfont.svg#technicalregular') format('svg');
    font-weight: normal;
    font-style: normal;

}           
            
            
            body{
                font-family: arial;
                font-size:13px;
            }
            #designer_container{
                width:800px;
                margin:0 auto;
                border:solid 2px #efefef;
                position:relative;
            }
            
            
            ul,li{list-style:none;}
            li{float:left;}
            strong{display:block;clear:both;}
            #designer_preview{
                margin:0 auto;
                height:200px;
                width:320px;
                position:relative;
                background:url(images/ziptag_preview.png) no-repeat;
            }
            .preview_image_set{
                position:absolute;
                top:95px;
                left:72px;
                width:60px;
                height:60px;
                border:none;
            }
            
            .preview_phone{position:absolute;display:block;width:260px;text-align:center;font-size:18px;padding:0 0 0 10px;line-height:1;margin-top:10px;}
            .preview_text{position:absolute;display:block;width:260px;text-align:center;font-size:26px;padding:23px 0 0 10px;line-height:1;}
            
            #designer_options_picture ul li{
                width:32px;
                height:32px;
                border:solid 2px #666;
                padding:1px;
                margin:2px;
            }
            .font_colour_black,.font_colour_white{border:solid 1px #666;}
            .font_colour_black{width:20px;height:20px;background:#000000;display:inline-block;}
            .font_colour_white{width:20px;height:20px;background:#ffffff;display:inline-block;}
            
            #designer_options_picture ul li{
                width:40px;
                height:40px;
                border:solid 2px #666;
                padding:1px;
                margin:2px;
            }
            
            .preview_image{
                width:32px;
                height:32px;
            }
            
            
            #designer_options_colours ul li{float:none;height:50px;}
            #designer_options_colours ul li span{
                display:inline-block;
                width:20px;
                height:20px;
                float:left;
                margin:2px;
                border:solid 2px #666;
            }
            .selected{border:solid 2px #00B0E0 !important};
            
            
            
            #designer_options_identitags{
                display:block;
                
            }
            #designer_options_identitags ul.tags{
              
            }
            
            .box{
                position:relative;
                clear:both;
                margin-bottom:20px;
            }
            #designer_options_details strong{display:inline;clear:none;}
            #designer_options_details{text-align:center;}
            
            #designer_options_font{
float:left;
width:275px;
}
#designer_options_font li {
    font-size:28px;
}

#designer_options_font_colour{
float:left;
width:175px;
}

#designer_options_colours{
float:left;
width:350px;
}

#designer_options_label ul li{float:none;}

#designer_options_identitags{

}


#designer_options_label{
position:absolute;
top:0;
right:0;
width:320px;
}

#designer_options_ironon_colour{
position:absolute;
top:200px;
right:0;
width:320px;
}

#designer_options_ironon_colour ul li span{width:20px;height:20px;display:inline-block;border:solid 2px #666;}

button{
    color:#ffffff;
    background:#00B0E0;
    border:solid 2px #000000;
    padding:5px 10px;
    margin:5px;
}

        </style>
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
        
  
        
        <div id="designer_container">
            
            <div id="designer_preview">
                <img class="preview_image_set" src="/_designer/images/ziptags/blank.png" />
            </div>
            
            
            
            <div class="box">
              
            
            <div id="designer_options_identitags">
                <strong>Picture:</strong>
                <?php
                    //pull identiTAG images here
                $query = mysql_query("SELECT * FROM data_ziptag WHERE data_ziptag_code!='z8'")or die(mysql_error());
                    if(mysql_num_rows($query)>0){
                        while($val = mysql_fetch_array($query)){
                            $identitags[$val['data_ziptag_code']]=$val['data_ziptag_code'];
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
                            
                            echo "<li class='".$ref."' style='background:url(http://identikid.com.au/_designer/images/ziptags/".strtolower($picture).".png) no-repeat;width:68px;height:68px;border:solid 1px #ddd;'></li>";
                            
                        }
                    
                    echo "</ul>";
                    echo "<div style='clear:both'></div>";
                    //echo "<input type='text' value='' id='selected_identitag' size='6' /> Selected IdentiTAG";
                ?>
            </div>
</div>
            <div class='box' style='text-align:center;'>


            <div id="designer_options_quantity">
                <strong>Quantity:</strong>
                <?php
                    //pull product quantity details here
                    
                    echo "<select id='order_quantity'>";
                    
                    
                        echo "<option value='1'>3 for AU$9</option>";
                        echo "<option value='2'>5 for AU$10</option>";
                       
                    
                    echo "</select>";
                ?>
            </div>
            
            
            
            
            <div id="designer_submit">
                <button id="back">< Back</button>
                <button id="submit">Continue ></button>
            </div>
            </div>
        </div>
        
