<link type="text/css" rel="Stylesheet" href="css/Semi_Permanent_Iron_Ons.css" />
<?php
require_once '../common_db.php';
require_once 'include.php';
linkme();
require_once 'helper.php';
$productId = 2;// for mini
?>  
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
<script src="js/Semi_Permanent_Iron_Ons.js"></script>

<form action="/addtoorder.php" method="post" target="_top" id="semi-permanet-irons-ons">

    <input type="hidden" name="background_colour" value="9" id="background_colour"/>
    <input type="hidden" name="font" value="3" id="font"/>
    <input type="hidden" name="font_colour" value="1" id="font_colour"/>
    <!--<input type="hidden" name="split" value="1" id="split"/>-->
    <input type="hidden" name="pic" value="1" id="pic"/>
    <input type="hidden" name="picon" value="1" id="picon"/>
    <!--<input type="hidden" name="text1" value="" id="text1"/>-->


    <input type="hidden" name="identitag_code" value="" id="identitag_code"/>
    <input type="hidden" name="identitagReserve" value="0" id="identitagReserve"/>
    <input type="hidden" name="ironon_colour" value="" id="ironon_colour"/>

    <input type="hidden" name="chosenLabel" value="1" id="chosenLabel"/>
    <input type="hidden" name="price" value="<?php echo $price; ?>" id="price"/>
    <input type="hidden" name="type" value="<?php echo $type; ?>" id="type"/>
    <input type="hidden" name="quantdesc" value="60 Mini vinyl Labels for AU$ <?php echo $price;?>" id="quantdesc"/>

    <input type="hidden" name="submit" value="Submit" id=""/>








    <div id="designer_container">
        <div class="fixed_preview">
            <div id="designer_preview_text">
                Format will be improved prior to Print.
                This is just a idea of how the label font,colours and pic look.
                Actual label size L 50mm H 9mm
            </div>

            <div id="designer_preview" class="individual_preivew">
                <span class="preview_image" ></span>
                <span class="preview_text" >Firstname Surname</span>
                <span class="preview_phone" >Ph:000 000 000</span>
            </div>
        </div>

        <div class="designer-options">
            <div id="designer_options_details">

                <p><strong>Include: </strong>
                    <span><input type="checkbox" checked="checked" name="details_checkbox_name" class="details_checkbox_name" disabled="disabled"/> Line 1</span>
                    <span><input type="checkbox" checked="checked" name="details_checkbox_phone" class="details_checkbox_phone" title="Check to enable line 2"/> Line 2</span>
                    <span><input type="checkbox" checked="checked" name="details_checkbox_pic" class="details_checkbox_pic" title="Check to enable picture"/> Pic</span>
                </p>
                <p>
                    <div class="line-1">
                        <strong>Line 1:</strong> <input type="text" class="details_text_name" name="text1"/>
                        <span class="split-lines" style="display:none;"><input type="checkbox" name="split" value="1" id="split"/> Split into 2 lines</span>
                        <strong>Line 2:</strong> <input type="text" class="details_text_phone line-2" name="text2"/></div>
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
                            echo "<li class='" . $ref . "' rel='" . $picture . "' style='background-image:url(http://identikid.com.au/_designer/" . str_replace("bw", "bwl", $picture) . ")'></li>";
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
                    $query = mysql_query("SELECT * FROM designer_fonts ORDER BY fontValue");
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
                        <strong>Font Colours:  Black & White</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class='box-1' style='text-align:center;'>
            <span class="scroll-down">Scroll to view all available options</span>
            <div id="designer_options_quantity">
                <strong>Quantity:</strong>
                <select id='order_quantity'>
                    <?php
                    echo Helper::getExtraPriceOption($productId);
                    echo "<option value='$price' selected='selected'>60 Semi-Permanent Iron Ons for AU$ " . $price . "</option>";
                    echo "<option value='".($price * 2)."'>120 Semi-Permanent Iron Ons for AU$ " . ($price * 2) . "</option>";
                    echo "<option value='" . ($price * 3) . "'>180 Semi-Permanent Iron Ons for AU$ " . ($price * 3) . "</option>";
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

