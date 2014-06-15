<?php
require_once '../common_db.php';
require_once 'include.php';
linkme();
?>  
<script>
    var _colourArray = new Array();
    
    
    <?php
    $getColourArray = mysql_query("SELECT * FROM designer_colours");
    while ($row = mysql_fetch_array($getColourArray)) {
        echo "_colourArray[" . $row['colour_id'] . "] = '" . $row['hex'] . "';\n";
    }
    ?>
</script>
<div id="designer_container">
    <div id="designer_preview_text">
        Format will be improved prior to Print.<br />
        This is just a idea of how the label font,colours and pic look.<br />
        Actual label size L 50mm  H 9mm
    </div>

    <!------preview------------->
    <div id="designer_preview" class="designer_preview_rainbow_a">
        <span class="preview_text" >Preview Text</span>
    </div>
    <!--@end of preview--------->

    <div class="box">
        <div id="designer_options_details">
            <p>
                <strong>Name:</strong> 
                <input type="text" class="details_text_name" placeholder="Preview Text"/> 
            </p>
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
                echo "<li class='" . $fontFile . " selected' style='font-family:" . $fontName . ";'>Ginger Meggs</li>";
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
                    echo "<span style='background:" . $colour . "' class='" . $colour . "' onclick=checkradio('$id')></span>";
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

