<link type="text/css" rel="Stylesheet" href="css/book_labels.css" />
<?php
require_once '../common_db.php';
require_once 'include.php';
linkme();
require_once 'helper.php';
$productId = 33; // for mini
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
<script src="js/book_labels.js"></script>
<?php
if ($_SERVER['HTTP_HOST'] == "www.anne.com") {
    $action = '/addtoorder.local.php';
} else {
    $action = '/addtoorder.php';
}
?>

<form action="<?php echo $action;?>" method="post" target="_top" id="books-label">

    <input type="hidden" name="background_colour" value="9" id="background_colour"/><!-- data_colour_id || colours = 9 and 10 -->
    <input type="hidden" name="font" value="3" id="font"/>
    <input type="hidden" name="font_colour" value="1" id="font_colour"/>
    <input type="hidden" name="chosenQuant" value="0" id="chosenQuant"/>
    <input type="hidden" name="chosenPic" value="1" id="pic"/>
    <input type="hidden" name="picon" value="1" id="picon"/>
    <input type="hidden" name="symbol" value="$"/>


    <input type="hidden" name="html_form" value="1" id="html_form"/>
    <input type="hidden" name="identitagReserve" value="0" id="identitagReserve"/>
    <input type="hidden" name="ironon_colour" value="" id="ironon_colour"/>

    <input type="hidden" name="chosenLabel" value="1" id="chosenLabel"/>
    <input type="hidden" name="price" value="<?php echo $price; ?>" id="price"/>
    <input type="hidden" name="type" value="<?php echo $type; ?>" id="type"/>
    <input type="hidden" name="quantdesc" value="60 Book Labels for AU$ <?php echo $price; ?>" id="quantdesc"/>

    <input type="hidden" name="submit" value="Submit" id=""/>


    <div id="designer_container">
        <div class="fixed_preview">
            <div id="designer_preview_text" style="display:none;">
                Format will be improved prior to Print.
                This is just a idea of how the label font,colours and pic look.
                Actual label size L 50mm H 9mm
            </div>

            <div id="designer_preview" class="designer_preview_rainbow_a">
                <span class="preview_image" ></span>
                <span class="preview_text" >Firstname Surname</span>
            </div>
        </div>

        <div class="designer-options">
            <div id="designer_options_details">
                <p>
                    <strong>Line 1:</strong> <input type="text" class="details_text_name" name="text1"/>
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
                <div class="colour-selector">
                    <div id="designer_options_colours">
                        <?php
                        $colourSets = array();
                        $colourSets['Rainbow A'] = array('#F205BF', '#9966FF', '#FCAD0D');
                        $colourSets['Rainbow B'] = array('#003CFF', '#FF5200', '#6BE305');

                        echo "<ul class='color-selector'>";
                        echo '<li><strong>Choose a colour set:</strong></li>';
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

                            foreach ($colourSet as $colour) {
                                echo "<span style='background:" . $colour . "' class='" . $colour . "' onclick=checkradio('$id')></span>";
                            }
                            echo "</li>";
                        }
                        ?>
                        <li>
                            <div id="designer_options_font_colour">
                                <strong>Font Colour:</strong>
                                <span class="font_colour_white"></span>
                            </div>
                        </li>
                        <?php
                        echo "</ul>";
                        ?>
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
                    echo "<option value='$price' selected>60 Book Labels for AU$ " . $price . "</option>";
                    echo "<option value='" . ($price * 2) . "'>120 Book Labels for AU$ " . ($price * 2) . "</option>";
                    echo "<option value='" . ($price * 3) . "'>180 Book Labels for AU$ " . ($price * 3) . "</option>";
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

