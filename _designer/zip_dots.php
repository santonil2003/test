<?php
require_once '../common_db.php';
require_once 'include.php';
linkme();
require_once 'helper.php';
$productId = 28;// qty 10 zip dots
$productId1 = 29; // qty 20 zip dots
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Zip dots</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Arctext.js - Curving text with CSS3 and jQuery" />
        <meta name="keywords" content="arc, letters, words, rotate, warp, circle, curve, along, path, jquery, css3, transform" />
        <meta name="author" content="Codrops" />
        <link type="text/css" rel="Stylesheet" href="css/curve.css" />
        <link type="text/css" rel="Stylesheet" href="css/zip_dots.css" />
        <script type="text/javascript" src="js/jquery.arctext.js"></script>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script src="js/zip_dots.js"></script>
    </head>
    <body> 
        <script>
            var _colourArray = new Array();
<?php
$individual = array();
$getColourArray = mysql_query("SELECT * FROM data_colour WHERE data_colour_background = '0'");
while ($row = mysql_fetch_array($getColourArray)) {
    echo "_colourArray[" . $row['data_colour_id'] . "] = '" . $row['hexcode'] . "';\n";
    $individual[$row['data_colour_id']] = $row['hexcode'];
}

$type = $productId;
echo "_type = $type;\n";
$getPrice = mysql_query("SELECT * FROM prices WHERE productId = '$type' AND currencyInt='1'");
while ($row = mysql_fetch_array($getPrice)) {
    echo "var _price = '" . $row['price'] . "';\n";
    $price = $row['price'];
}
?>
        </script>



        <form action="/addtoorder.php" method="post" target="_top" id="shoe-dots">

            <input type="hidden" name="background_colour" value="8" id="background_colour"/>
            <input type="hidden" name="font" value="3" id="font"/>
            <input type="hidden" name="font_colour" value="1" id="font_colour"/>
            <input type="hidden" name="split" value="1" id="split"/>
            <input type="hidden" name="pic" value="1" id="pic"/>
            <input type="hidden" name="picon" value="1" id="picon"/>
            <!--<input type="hidden" name="data_colour_id" value="8" id=""/>-->


            <input type="hidden" name="identitag_code" value="" id="identitag_code"/>
            <input type="hidden" name="identitagReserve" value="0" id="identitagReserve"/>
            <input type="hidden" name="ironon_colour" value="" id="ironon_colour"/>

            <input type="hidden" name="chosenLabel" value="1" id="chosenLabel"/>
            <input type="hidden" name="price" value="<?php echo $price; ?>" id="price"/>
            <input type="hidden" name="type" value="<?php echo $type; ?>" id="type"/>
            <input type="hidden" name="quantdesc" value="10 ZipDeDo for AU$ <?php echo $price;?>" id="quantdesc"/>

            <input type="hidden" name="submit" value="Submit"/>








            <div id="designer_container">
                <div class="fixed_preview">
                    <div id="designer_preview" class="individual_preivew" style="background: url(/_designer/images/shoedots/bnw.png) no-repeat scroll 0% 0% transparent;">
                        <div id="holder_preview_text"><span class="preview_text" >Preview Text</span></div>
                        <span class="preview_image" ></span>
                        <div id="holder_preview_phone"><span class="preview_phone" >000 000 000</span></div>
                    </div>
                </div>

                <div class="designer-options">
                    <div id="designer_options_details">
                        <p style="color:red;" class="browser-incompactible">
                            Identikid interactive preview may not be compatible with Internet Explorer , Please use Firefox or chrome for best user experience. However your labels will still be printed correctly if you continue to place order on IE. Thanks
                        </p>
                        <p><strong>Include: </strong>
                            <span><input type="checkbox" checked="checked" name="details_checkbox_name" class="details_checkbox_name" disabled="disabled"/> Line 1</span>
                            <span><input type="checkbox" checked="checked" name="details_checkbox_phone" class="details_checkbox_phone" /> Line 2</span>
                            <span><input type="checkbox" checked="checked" name="details_checkbox_pic" class="details_checkbox_pic" /> Pic</span>
                        </p>
                        <p>
                            <strong>Line 1:</strong> <input type="text" class="details_text_name" name="text1"/> 
                            <strong>Line 2:</strong> <input type="text" class="details_text_phone" name="text2"/> 
                        </p>
                        <p class="error-msg"></p>
                    </div>


                    <div class="block-box">
                        <div id="designer_options_picture">
                            <strong>Choose a picture by clicking on an icon:</strong>
                            <div>
                                <?php
                                //pull images from DB here
                                $query = mysql_query("SELECT * FROM designer_bwimages");
                                if (mysql_num_rows($query) > 0) {
                                    while ($val = mysql_fetch_array($query)) {
                                        $pictures[$val['id']] = $val['image'];
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
                                foreach ($pictures as $ref => $picture) {
                                    if (in_array($ref, $skip)) {
                                        continue;
                                    }
                                    echo "<li class='" . $ref . "' rel='" . $picture . "'><img width='40' src='http://identikid.com.au/_designer/".str_replace("bw", "bwl", $picture)."'/></li>";
                                }

                                echo "</ul>";
                                echo "<div style='clear:both'></div>";
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <br/>
                    <div class="block-box">
                        <div id="designer_options_font">

                            <strong>Font:</strong>
                            <?php
                            //pulll fonts from DB here
                            $query = mysql_query("SELECT * FROM designer_fonts Where link = 3 ORDER BY fontValue");
                            if (mysql_num_rows($query) > 0) {
                                while ($val = mysql_fetch_array($query)) {
                                    $fonts[$val['fontName']] = $val['link'];
                                }
                            }

                            echo "<ol>";

                            foreach ($fonts as $fontName => $fontFile) {
                                if ($fontFile == '3') {
                                    echo "<li class='" . $fontFile . "' style='font-size:24px;font-family:" . $fontName . ";' data='" . $fontName . "'><table border='0' height='60' width='100%'><tr><td align='center' valign='middle'>Ginger Meggs</td></tr></table></li>";
                                } else if ($fontFile == '2') {
                                    echo "<li class='" . $fontFile . "' style='font-family:" . $fontName . ";' data='" . $fontName . "'><table border='0' height='60' width='100%'><tr><td align='center' valign='middle'>Ginger Meggs</td></tr></table></li>";
                                } else if ($fontFile == '5') {
                                    echo "<li class='" . $fontFile . "' style='font-family:" . $fontName . ";' data='" . $fontName . "'><table border='0' height='60' width='100%'><tr><td align='center' valign='middle' style='font-weight:bold;'>Ginger Meggs</td></tr></table></li>";
                                } else {
                                    echo "<li class='" . $fontFile . "' style='font-family:" . $fontName . ";' data='" . $fontName . "'><table border='0' height='60' width='100%'><tr><td align='center' valign='middle'>Ginger Meggs</td></tr></table></li>";
                                }
                            }

                            echo "</ol>";
                            ?>

                        </div>

                        <div class="colour-selector">

                            <div id="designer_options_font_colour">
                                <strong>Font Colour:</strong>
                                <span class="font_colour_black"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='box-1' style='text-align:center;'>
                    <span class="scroll-down">Scroll to view all available options</span>
                    <div id="designer_options_quantity">
                        <strong>Quantity:</strong>
                        <select id='order_quantity' onchange="updateType(this.value)">
                            <?php
                            echo Helper::getExtraPriceOption($productId);
                            echo Helper::getExtraPriceOption($productId1);                            
                            ?>
                        </select>
                    </div>

                    <div id="designer_submit">
                        <button id="back">< Back</button>
                        <input type="submit" Value="Continue >" class='btn'/>
                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript">
// update product id based on amount
	    function updateType(amt){
	   	if(amt==10){
			_type = 28;
	         } else {
			_type = 29;
		 }

		$('#type').val(_type);
	    }

            var $preview_text = $('.preview_text').hide();
            var $preview_phone = $('.preview_phone').hide();

            $preview_text.show().arctext({radius: 66});
            $preview_phone.show().arctext({radius: 66, dir: -1});
            
            var w = $('.fixed_preview').width();
            var d = $(window).width();
            
            console.log(w+','+d);
            
            if(d<w){
                $('.fixed_preview').width(d);
                $('#designer_container').width(d);
            }
        </script>
    </body>
</html>

