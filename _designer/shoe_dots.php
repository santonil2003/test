<?php
require_once '../common_db.php';
require_once 'include.php';
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

$type = 19;
echo "_type = $type;\n";
$getPrice = mysql_query("SELECT * FROM prices WHERE productId = '$type' AND currencyInt='1'");
while ($row = mysql_fetch_array($getPrice)) {
    echo "var _price = '" . $row['price'] . "';\n";
    $price = $row['price'];
}
?>
</script>
<script src="http://css-tricks.com/examples/BlurredText/js/jquery.lettering.js"></script>
<link type="text/css" rel="Stylesheet" href="css/curve.css" />
<link type="text/css" rel="Stylesheet" href="css/shoe_dots.css" />
<script src="js/shoe_dots.js"></script>

<style>
    .badge {
        position: relative;
        width: 400px;
        border-radius: 50%;
        -webkit-transform: rotate(-50deg);
        -moz-transform: rotate(-50deg);
        -ms-transform: rotate(-50deg);
        -o-transform: rotate(-50deg);
        transform: rotate(-50deg);
    }

    h1 span {
        font: 26px Monaco, MonoSpace;
        height: 200px;
        position: absolute;
        width: 20px;
        left: 0;
        top: 0;
        -webkit-transform-origin: bottom center;
        -moz-transform-origin: bottom center;
        -ms-transform-origin: bottom center;
        -o-transform-origin: bottom center;
        transform-origin: bottom center;
    }

    .char1 {
        -webkit-transform: rotate(-6deg);
        -moz-transform: rotate(-6deg);
        -ms-transform: rotate(-6deg);
        -o-transform: rotate(-6deg);
        transform: rotate(-6deg);
    }

    .char2 {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    .char3 {
        -webkit-transform: rotate(6deg);
        -moz-transform: rotate(6deg);
        -ms-transform: rotate(6deg);
        -o-transform: rotate(6deg);
        transform: rotate(6deg);
    }

    .char4 {
        -webkit-transform: rotate(12deg);
        -moz-transform: rotate(12deg);
        -ms-transform: rotate(12deg);
        -o-transform: rotate(12deg);
        transform: rotate(12deg);
    }

    .char5 {
        -webkit-transform: rotate(18deg);
        -moz-transform: rotate(18deg);
        -ms-transform: rotate(18deg);
        -o-transform: rotate(18deg);
        transform: rotate(18deg);
    }

    .char6 {
        -webkit-transform: rotate(24deg);
        -moz-transform: rotate(24deg);
        -ms-transform: rotate(24deg);
        -o-transform: rotate(24deg);
        transform: rotate(24deg);
    }

    .char7 {
        -webkit-transform: rotate(30deg);
        -moz-transform: rotate(30deg);
        -ms-transform: rotate(30deg);
        -o-transform: rotate(30deg);
        transform: rotate(30deg);
    }

    .char8 {
        -webkit-transform: rotate(36deg);
        -moz-transform: rotate(36deg);
        -ms-transform: rotate(36deg);
        -o-transform: rotate(36deg);
        transform: rotate(36deg);
    }

    .char9 {
        -webkit-transform: rotate(42deg);
        -moz-transform: rotate(42deg);
        -ms-transform: rotate(42deg);
        -o-transform: rotate(42deg);
        transform: rotate(42deg);
    }

    .char10 {
        -webkit-transform: rotate(48deg);
        -moz-transform: rotate(48deg);
        -ms-transform: rotate(48deg);
        -o-transform: rotate(48deg);
        transform: rotate(48deg);
    }

    .char11 {
        -webkit-transform: rotate(54deg);
        -moz-transform: rotate(54deg);
        -ms-transform: rotate(54deg);
        -o-transform: rotate(54deg);
        transform: rotate(54deg);
    }

    .char12 {
        -webkit-transform: rotate(60deg);
        -moz-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
        -o-transform: rotate(60deg);
        transform: rotate(60deg);
    }

    .char13 {
        -webkit-transform: rotate(66deg);
        -moz-transform: rotate(66deg);
        -ms-transform: rotate(66deg);
        -o-transform: rotate(66deg);
        transform: rotate(66deg);
    }

    .char14 {
        -webkit-transform: rotate(72deg);
        -moz-transform: rotate(72deg);
        -ms-transform: rotate(72deg);
        -o-transform: rotate(72deg);
        transform: rotate(72deg);
    }

    .char15 {
        -webkit-transform: rotate(78deg);
        -moz-transform: rotate(78deg);
        -ms-transform: rotate(78deg);
        -o-transform: rotate(78deg);
        transform: rotate(78deg);
    }

    .char16 {
        -webkit-transform: rotate(84deg);
        -moz-transform: rotate(84deg);
        -ms-transform: rotate(84deg);
        -o-transform: rotate(84deg);
        transform: rotate(84deg);
    }

    .char17 {
        -webkit-transform: rotate(92deg);
        -moz-transform: rotate(92deg);
        -ms-transform: rotate(92deg);
        -o-transform: rotate(92deg);
        transform: rotate(92deg);
    }

    .char18 {
        -webkit-transform: rotate(98deg);
        -moz-transform: rotate(98deg);
        -ms-transform: rotate(98deg);
        -o-transform: rotate(98deg);
        transform: rotate(98deg);
    }

    .char19 {
        -webkit-transform: rotate(104deg);
        -moz-transform: rotate(104deg);
        -ms-transform: rotate(104deg);
        -o-transform: rotate(104deg);
        transform: rotate(104deg);
    }

    .char20 {
        -webkit-transform: rotate(110deg);
        -moz-transform: rotate(110deg);
        -ms-transform: rotate(110deg);
        -o-transform: rotate(110deg);
        transform: rotate(110deg);
    }

    .char21 {
        -webkit-transform: rotate(116deg);
        -moz-transform: rotate(116deg);
        -ms-transform: rotate(116deg);
        -o-transform: rotate(116deg);
        transform: rotate(116deg);
    }

    .char22 {
        -webkit-transform: rotate(122deg);
        -moz-transform: rotate(122deg);
        -ms-transform: rotate(122deg);
        -o-transform: rotate(122deg);
        transform: rotate(122deg);
    }

    .char23 {
        -webkit-transform: rotate(128deg);
        -moz-transform: rotate(128deg);
        -ms-transform: rotate(128deg);
        -o-transform: rotate(128deg);
        transform: rotate(128deg);
    }

    .char24 {
        -webkit-transform: rotate(134deg);
        -moz-transform: rotate(134deg);
        -ms-transform: rotate(134deg);
        -o-transform: rotate(134deg);
        transform: rotate(134deg);
    }

</style>

<script>
	$(function() {
		$(".badge h1").lettering();
	});
</script>

<form action="/addtoorder.php" method="post" target="_top" id="permanent-iron-ons">

    <input type="hidden" name="background_colour" value="1" id="background_colour"/>
    <input type="hidden" name="font" value="3" id="font"/>
    <input type="hidden" name="font_colour" value="1" id="font_colour"/>
    <input type="hidden" name="split" value="1" id="split"/>
    <input type="hidden" name="pic" value="1" id="pic"/>
    <input type="hidden" name="picon" value="1" id="picon"/>
    <!--<input type="hidden" name="text1" value="" id="text1"/>-->


    <input type="hidden" name="identitag_code" value="" id="identitag_code"/>
    <input type="hidden" name="identitagReserve" value="0" id="identitagReserve"/>
    <input type="hidden" name="ironon_colour" value="" id="ironon_colour"/>

    <input type="hidden" name="chosenLabel" value="1" id="chosenLabel"/>
    <input type="hidden" name="price" value="<?php echo $price; ?>" id="price"/>
    <input type="hidden" name="type" value="<?php echo $type; ?>" id="type"/>
    <input type="hidden" name="quantdesc" value="1" id="quantdesc"/>

    <input type="hidden" name="submit" value="Submit"/>








    <div id="designer_container">
        
        
        <div class="badge">
		  <h1 class="preview_text">12345678901234567890</h1>
        </div>
        
        
        
        <?php if(1==2):?>
        
        <div id="designer_preview_text">
            Format will be improved prior to Print.<br />
            This is just a idea of how the label font,colours and pic look.<br />
            Actual label size L 50mm  H 16mm
        </div>

        <div id="designer_preview" class="individual_preivew" style="background: url(images/mini_vinyls/1.png) no-repeat scroll 30px 54px transparent;">
            <span class="preview_image" ></span>
            <span class="preview_text" >Preview Text</span>
            <span class="preview_phone" >000 000 000</span>
        </div>
        <?php endif;?>


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
                    <span class="font_colour_white"></span>
                </div>

                <div id="designer_options_colours">
                    <strong>Choose a colour set:</strong>
                    <?php
                    $query = mysql_query("SELECT * FROM designer_colour_sets WHERE colourSetName='Individual'");
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
                        echo "</div><input style='float:left' type='radio' name='colour[]' value='" . $colourName . "' class='" . $colourName . "' id='$id' checked='checked'>";
                        $colours = explode(",", $colourSet);
                        foreach ($colours as $colour) {
                            $class = str_replace('#', '', $colour);
                            echo "<span style='background:" . $colour . "' class='" . $colour . " " . $class . "' onclick=checkradio('$id')></span>";
                        }
                        echo "</li>";
                    }

                    echo "</ul>";
                    ?>
                </div>
            </div>
        </div>
        <div class='box' style='text-align:center;'>
            <div id="designer_options_quantity">
                <strong>Quantity:</strong>
                <select id='order_quantity'>
                    <?php
                    echo "<option value='1'>60 Permanent Iron Ons for AU$ " . $price . "</option>";
                    echo "<option value='2'>120 Permanent Iron Ons for AU$ " . ($price * 2) . "</option>";
                    echo "<option value='3'>180 Permanent Iron Ons for AU$ " . ($price * 3) . "</option>";
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

