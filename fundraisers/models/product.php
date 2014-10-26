<?php

/**
 * product model
 * @author sanil shrestha <web.developer.sanil@gmail.com>
 */
class product extends baseModel {

    public function __construct() {
        parent::__construct();
    }

    /**
     * get product list
     * @return object
     */
    public function getList() {
        return $this->_db->select('product', '*')->all();
    }

}
