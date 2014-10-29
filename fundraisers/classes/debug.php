<?php

/**
 * debug class
 * @author sanil shrestha <web.developer.sanil@gmail.com>
 */
class debug {

    /**
     * Extended form of print_r with trace
     * @param type $data
     * @param type $label
     */
    public static function r($data, $label = '') {
        $trace = debug_backtrace();
        $html = '';
        $html.= '<p style=background:red;padding:4px;margin:0px;>';
        $html.= 'File : <i>' . $trace[0]['file'] . ' </i>, at  Line number :';
        $html.= '<b>' . $trace[0]['line'] . '</b>';
        $html.= '</p>';

        echo $html;

        if ($label) {
            echo $label . '<hr>';
        }

        echo '<pre style="background:#e0e0e0;padding:4px;margin:0px;clear:both;">';
        print_r($data);
        echo '</pre>';
    }

    /**
     * utility method to write file log
     * @param type $data
     * @param type $file
     */
    public static function l($data, $file = 'log.txt') {

        if (!file_exists(LOG_PATH)) {
            mkdir(LOG_PATH);
        }

        $data = (is_array($data) || is_object($data)) ? print_r($data, true) : $data;

        try {
            $trace = debug_backtrace();
            $today = date("F j, Y, g:i a");
            $content = "\n";
            $content.="Logged from file : " . $trace[0]['file'] . ", at  line number :" . $trace[0]['line'] . " on " . $today;
            $content.= "\n  $data \n";
            $content.= str_repeat('_', 100);
            $content.="\n";

            $fp = fopen(helper::normalizePath(LOG_PATH . DIRECTORY_SEPARATOR . $file), 'a+');
            fwrite($fp, $content);
            fclose($fp);
        } catch (Exception $exc) {
            notification::setMessage($exc->getTraceAsString(), notification::TYPE_ERROR);
        }
    }

    public static function info($msg1, $msg2 = '') {
        $html = '
            <div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
                <p>
                    <span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
                    <strong>' . $msg1 . '</strong>' . $msg2 . '
                </p>
            </div>';

        return $html;
    }

    public static function error($msg1, $msg2 = '') {
        $html = '
            <div class="ui-widget">
                <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                    <p>
                        <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                        <strong>' . $msg1 . '</strong>' . $msg2 . '</p>
                </div>
            </div>';
        return $html;
    }

}
