<?php

/**
 * item controller
 * @author sanil shrestha <web.developer.sanil@gmail.com>
 */
class itemsController extends baseController {

    function __construct() {
        parent::__construct();
    }

    /**
     * list all product
     * @todo generate more secure token
     */
    public function listAction() {
        // creating token to prevent csrf        
        $this->view->token = base64_encode(uniqid());
        session::set('token', $this->view->token);

        // fetch product list
        $Product = new product();
        $this->view->productList = $Product->getList();

        $this->render('productList');
    }

}
