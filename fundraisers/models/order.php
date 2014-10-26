<?php

/**
 * Order model
 * @author sanil shrestha <web.developer.sanil@gmail.com>
 */
class order extends baseModel {

    const ITEMS_NOT_SELECTED = 0;

    public function __construct() {
        parent::__construct();
    }

    /**
     * get courier charge by weight
     * @param type $weight
     */
    public static function getCourierPriceByWeight($weight) {
        if ($weight > 1000) {
            $charge = 20;
        } else if ($weight > 500) {
            $charge = 15;
        } else if ($weight > 200) {
            $charge = 10;
        } else if ($weight > 0) {
            $charge = 5;
        } else {
            exit('Courier price not found for weight:' . $weight);
        }

        return $charge;
    }

    /**
     * save order into session 
     * @param type $itemIds
     * @return type
     */
    public function placeOrder($itemIds) {
        if (!is_array($itemIds) && count($itemIds) <= 0) {
            return self::ITEMS_NOT_SELECTED;
        }

        // fetch product from database
        $itemIdsString = implode(',', $itemIds);
        $OrderLines = $this->_db
                ->raw("SELECT * FROM product WHERE id IN ($itemIdsString)")
                ->all();

        // calculate total price, weight
        $newOrder = array();
        $numberOfItems = 0;
        $totalPrice = 0;
        $totalWeight = 0;

        foreach ($OrderLines as $item) {
            $newOrder['items'][$item->id] = $item;
            $numberOfItems++;
            $totalPrice+=$item->price;
            $totalWeight+=$item->weight;
        }

        $newOrder['noOfItems'] = $numberOfItems;
        $newOrder['totalPrice'] = $totalPrice;
        $newOrder['totalWeight'] = $totalWeight;

        // save order array into session
        session::set('order', $newOrder);

        // package distrubution
        $this->getPackageList($newOrder);
    }

    /**
     * get item name
     * @param type $obj
     * @return type
     */
    private function items($obj) {
        return $obj->name;
    }

    /**
     * get package list for a order
     * @param type $order
     * @return array
     */
    public function getPackageList($order) {

        $packages = array();

        $package = array();

        if (!is_array($order)) {
            return false;
        }
        
        if ($order['totalPrice'] <= 250) {
            $itemArray = array_map(array($this, 'items'), $order['items']);
            $package['items'] = implode(',', $itemArray);
            $package['totalWeight'] = $order['totalWeight'];
            $package['totalPrice'] = $order['totalPrice'];
            $package['courierPrice'] = self::getCourierPriceByWeight($order['totalWeight']);

            array_push($packages, $package);
        } else {
            //@todo split items into multiple package ......
        }

        return $packages;
    }

    /**
     * clear order from session
     */
    public function clearOrder() {
        session::delete('order');
    }

}
