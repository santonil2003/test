<?php
require_once '../common_db.php';
linkme();
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

$type = 3;
echo "_type = $type;\n";
$getPrice = mysql_query("SELECT * FROM prices WHERE productId = '$type' AND currencyInt='1'");
while ($row = mysql_fetch_array($getPrice)) {
    echo "var _price = '" . $row['price'] . "';\n";
    $price = $row['price'];
}
?>
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link type="text/css" rel="Stylesheet" href="css/flash_to_html_vinyls_mini.css" />
<script src="js/flash_to_html_vinyls_mini.js"></script>

<form action="/addtoorder.php" method="post" target="_top" id="pencil_labels">

    <input type="hidden" name="background_colour" value="9" id="background_colour"/>
    <input type="hidden" name="font" value="3" id="font"/>
    <input type="hidden" name="font_colour" value="1" id="font_colour"/>
    <input type="hidden" name="split" value="1" id="split"/>
    <input type="hidden" name="pic" value="1" id="pic"/>
    <input type="hidden" name="picon" value="1" id="picon"/>


    <input type="hidden" name="identitag_code" value="" id="identitag_code"/>
    <input type="hidden" name="identitagReserve" value="0" id="identitagReserve"/>
    <input type="hidden" name="ironon_colour" value="" id="ironon_colour"/>

    <input type="hidden" name="chosenLabel" value="1" id="chosenLabel"/>
    <input type="hidden" name="price" value="<?php echo $price; ?>" id="price"/>
    <input type="hidden" name="type" value="<?php echo $type; ?>" id="type"/>
    <input type="hidden" name="quantdesc" value="1" id="quantdesc"/>

    <input type="hidden" name="submit" value="Submit" id="Submit"/>








    <div id="designer_container">
        <div id="designer_preview_text">
            Format will be improved prior to Print.<br />
            This is just a idea of how the label font,colours and pic look.<br />
            Actual label size L 50mm  H 9mm
        </div>

        <!------preview------------->
        <div id="designer_preview" class="designer_preview_rainbow_a">
            <span class="preview_image" ></span>
            <span class="preview_text" >Preview Text</span>
            <span class="preview_phone" >000 000 000</span>
        </div>
        <!--@end of preview--------->


        <div id="designer_options_details">

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
                        $fonts[$val['fontName']] = $val['fontValue'];
                        $style[$val['fontName']] = $val['style'];
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
                    <span class="font_colour_white"></span>
                </div>

                <div id="designer_options_colours">
                    <strong>Choose a colour set:</strong>
                    <?php
                    $query = mysql_query("SELECT * FROM designer_colour_sets");
                    if (mysql_num_rows($query) > 0) {
                        while ($val = mysql_fetch_array($query)) {
                            $colourSets[$val['colourSetName']] = $val['colourArray'];
                        }
                    }

                    $colourSets['Individual'] = implode(',', $individual);

                    echo "<ul>";

                    foreach ($colourSets as $colourName => $colourSet) {
                        $colourName = str_replace(" ", "_", $colourName);

                        echo "<li class='" . $colourName . "'><div>";
                        if ($colourName == 'Individual') {
                            echo "Individual (choose a colour by clicking on it)";
                        } else {
                            echo str_replace("_", " ", $colourName);
                        }

                        $id = 'radio' . uniqid();
                        echo "</div><input style='float:left' type='radio' name='colour[]' value='" . $colourName . "' class='" . $colourName . "' id='$id'>";
                        $colours = explode(",", $colourSet);
                        foreach ($colours as $colour) {
                            echo "<span style='background:" . $colour . "' class='" . $colour . "' onclick=checkradio('$id')></span>";
                        }
                        echo "</li>";
                    }

                    echo "</ul>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class='box' style='text-align:center;'>
        <div id="designer_options_quantity">
            <strong>Quantity:</strong>
            <select id='order_quantity'>
                <?php
                echo "<option value='1'>60 Pencil Labels for AU$ " . $price . "</option>";
                echo "<option value='2'>120 Pencil Labels for AU$ " . ($price * 2) . "</option>";
                echo "<option value='3'>180 Pencil Labels for AU$ " . ($price * 3) . "</option>";
                ?>
            </select>
        </div>

        <div id="designer_submit">
            <button id="back">< Back</button>
            <button id="submit">Continue ></button>
        </div>
    </div>
</div>
</form>

