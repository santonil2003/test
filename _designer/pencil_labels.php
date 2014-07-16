<link type="text/css" rel="Stylesheet" href="css/pencil_labels.css" />
<?php
require_once '../common_db.php';
require_once 'include.php';
linkme();
?>
<script src="js/pencil_labels.js"></script>
<script>
    var _colourArray = new Array();
<?php
$getColourArray = mysql_query("SELECT * FROM designer_colours");
while ($row = mysql_fetch_array($getColourArray)) {
    echo "_colourArray[" . $row['colour_id'] . "] = '" . $row['hex'] . "';\n";
}

$type = 5;
echo "_type = $type;\n";
$getPrice = mysql_query("SELECT * FROM prices WHERE productId = '$type' AND currencyInt='1'");
while ($row = mysql_fetch_array($getPrice)) {
    echo "var _price = '" . $row['price'] . "';\n";
    $price = $row['price'];
}
?>
</script>
<form action="/addtoorder.php" method="post" target="_top" id="pencil_labels">

    <input type="hidden" name="background_colour" value="9" id="background_colour"/>
    <input type="hidden" name="font" value="3" id="font"/>
    <input type="hidden" name="font_colour" value="1" id="font_colour"/>
    <input type="hidden" name="text1" value="" id="text1"/>

    <input type="hidden" name="pic" value="0" id="pic"/>
    <input type="hidden" name="identitag_code" value="" id="identitag_code"/>
    <input type="hidden" name="identitagReserve" value="0" id="identitagReserve"/>
    <input type="hidden" name="ironon_colour" value="" id="ironon_colour"/>
    <input type="hidden" name="text2" value="" id="text2"/>
    <input type="hidden" name="chosenLabel" value="1" id="chosenLabel"/>
    <input type="hidden" name="price" value="<?php echo $price; ?>" id="price"/>
    <input type="hidden" name="type" value="<?php echo $type; ?>" id="type"/>
    <input type="hidden" name="quantdesc" value="60 Pencil Labels for AU$ <?php echo $price; ?>" id="quantdesc"/>
    <input type="hidden" name="picon" value="0" id="picon"/>
    <input type="hidden" name="colours" value="3" id=""/>
    <input type="hidden" name="submit" value="Submit"/>



    <div id="designer_container">
        <div class="fixed_preview">
            <div id="designer_preview_text">
                Format will be improved prior to Print.<br />
                This is just a idea of how the label font,colours and pic look.<br />
                Actual label size L 50mm  H 9mm
            </div>


            <div id="designer_preview" class="designer_preview_rainbow_a">
                <span class="preview_text" >Preview Text</span>
            </div>
        </div>
        <div style="width:800px; height:110px;overflow:hidden;"></div>
        <div class="designer-options">
            <p style="color:red;" class="browser-incompactible">
                Identikid interactive preview may not be compatible with Internet Explorer , Please use Firefox or chrome for best user experience. However your labels will still be printed correctly if you continue to place order on IE. Thanks
            </p>
            <div class="box">
                <div id="designer_options_details">
                    <p>
                        <label class="detial_text_label">Name : </label> 
                        <input type="text" class="details_text_name" placeholder="Preview Text" style="width: 160px; height: 32px;"/> 
                    </p>
                    <p class="error-msg"></p>
                </div>
            </div>
            <br/>
            <div class="box">
                <div id="designer_options_font">
                    <strong>Font:</strong>
                    <?php
                    $sql = mysql_query("SELECT * FROM designer_fonts WHERE fontValue = '4' ORDER BY fontValue");
                    if (mysql_num_rows($sql) > 0) {
                        while ($val = mysql_fetch_array($sql)) {
                            $fonts[$val['fontName']] = $val['fontValue'];
                        }
                    }
                    echo "<ol>";
                    foreach ($fonts as $fontName => $fontFile) {
                        echo "<li class='" . $fontFile . "' style='font-family:" . $fontName . ";'>Ginger Meggs</li>";
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
                    $query = mysql_query("SELECT * FROM designer_colour_sets");
                    if (mysql_num_rows($query) > 0) {
                        while ($val = mysql_fetch_array($query)) {
                            $colourSets[$val['colourSetName']] = $val['colourArray'];
                        }
                    }

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
        <div class='box-1' style='text-align:center;'>
            <span class="scroll-down">Scroll to view all available options</span>
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
                <input type="submit" Value="Continue >" class='btn'/>
            </div>
        </div>
    </div>
</form>

