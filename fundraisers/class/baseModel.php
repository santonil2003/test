<?php

/**
 * base model
 * @author sanil shrestha <web.developer.sanil@gmail.com>
 */
class baseModel {

    /**
     * database object
     * @var type object
     */
    protected $_db;

    /**
     * create instance of  db object
     */
    public function __construct() {
        $this->_db = Db::instance();
    }

}
