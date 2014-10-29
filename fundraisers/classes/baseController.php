<?php

/**
 * base controller
 * @author sanil shrestha <web.developer.sanil@gmail.com>
 */
class baseController {

    /**
     * initalized view 
     */
    public function __construct() {
        $this->view = new baseView();
    }

    /**
     * render view
     * @param type $view
     */
    public function render($view) {
        $this->view->setView($view);
        $this->view->renderLayout();
    }

    /**
     * set layout for a view
     * @param type $layout
     */
    public function setlayout($layout) {
        $this->view->layout = $layout;
    }

}
