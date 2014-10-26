<?php

/**
 * Base view
 * @author sanil shrestha <web.developer.sanil@gmail.com>
 */
class baseView {

    public $view;
    public $layout = false;

    /**
     * set view
     * @param type $view
     */
    public function setView($view) {
        $this->view = $view;
    }

    /**
     * get content to be rendered
     */
    public function getContent() {
        if ($this->view) {
            if (file_exists('views/' . $this->view . '.php')) {
                include 'views/' . $this->view . '.php';
            } else {
                echo 'views/' . $this->view . '.php not found!';
            }
        } else {
            echo 'View not defined';
        }
    }

    /**
     * render main layout
     */
    public function renderLayout() {
        if ($this->layout) {
            if (file_exists('layout/' . $this->layout . '.php')) {
                include 'layout/' . $this->layout . '.php';
            } else {
                $msg = 'layout/' . $this->layout . '.php not found!';
                exit($msg);
            }
        } else {
            include 'layout/' . DEFAULT_LAYOUT . '.php';
        }
    }

}
