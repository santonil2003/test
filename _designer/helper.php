<?php

Class Helper {

    public static function getCurrencyDetails($currencyInt) {
        $query = "SELECT * FROM `currencies` WHERE id = '$currencyInt'";
        $res = mysql_query($query);
        $currencyRow = mysql_fetch_assoc($res);
        return $currencyRow;
    }

    public static function getPricePerSet($productId, $currencyInt = 1) {
        $query = "SELECT pps.*,p.productName FROM price_per_set AS pps JOIN product p ON pps.product_id=p.id WHERE pps.product_id='$productId' AND pps.currencyInt='$currencyInt' ";
        $price_per_set_result = mysql_query($query);

        $result = array();
        while ($price_per_set_row = mysql_fetch_assoc($price_per_set_result)) {
            $result[] = $price_per_set_row;
        }
        return $result;
    }

    public static function getExtraPriceOption($productId, $currencyInt = 1) {
        $options = self::getPricePerSet($productId, $currencyInt);
        $currency = self::getCurrencyDetails($currencyInt);
        $html = '';
        
        foreach ($options as $option) {
            $html.="<option value='" . $option['price'] . "' type='".$productId."' gota='".$option['items_per_unit']."'>" . $option['items_per_unit'] . " " . $option['productName'] . " for " . $currency['symbol'] . " " . $option['price'] . "</option>";
        }
        
        return $html;
    }

    public static function r($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

}
