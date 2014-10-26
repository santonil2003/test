<?php

/**
 * index controller
 * @author sanil shrestha <web.developer.sanil@gmail.com>
 */
class indexController extends baseController {

    /**
     * construct parent constroller
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * default action
     */
    public function indexAction() {
        // render index view
        $this->render('index');
    }

}
