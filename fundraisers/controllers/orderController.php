<?php

/*
 * order controller
 * @author sanil shrestha <web.developer.sanil@gmail.com>
 */

class orderController extends baseController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * save order into the session
     * @todo save order into database
     */
    public function orderAction() {

        //@todo apply filter
        $data = $_POST;
        $Order = new order();

        // token validation
        if (isset($data['token']) && session::get('token') == $data['token']) {
            session::delete('token');

            if (isset($data['item']) && count($data['item'])) {
                $Order->placeOrder($data['item']);
            } else {
                // flash messege
                notification::setMessage('Item not selected!', notification::TYPE_ERROR);
            }
        } else if (isset($data['token'])) {
            // flash messege
            notification::setMessage('Invalid token!', notification::TYPE_ERROR);
        }

        $this->orderListAction();
    }

    /**
     * list order
     */
    public function orderListAction() {

        $Order = new order();
        $this->view->order = session::get('order');

        $this->view->packageList = $Order->getPackageList($this->view->order);

        $this->render('orderList');
    }

    /**
     * delet order saved on session
     */
    public function flushOrderAction() {
        $Order = new order();
        $Order->clearOrder();

        $this->orderListAction();
    }

}
