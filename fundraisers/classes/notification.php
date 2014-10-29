<?php

/**
 * Notification class for flash messege
 * @package Model
 * @example notification::setMessage('some msg');
 * @author Sanil Shrestha <web.developer.sanil@gmail.com>
 */
class notification {

    CONST TYPE_ERROR = 'error';
    CONST TYPE_SUCCESS = 'success';
    CONST TYPE_WARNING = 'warning';

    /**
     * set flash messege
     * @param type $message
     * @param type $type
     */
    public static function setMessage($message, $type = self::TYPE_ERROR) {
        $message = array('message' => $message, 'type' => $type);

        $notifications = session::get('notification_message');

        if (!is_array($notifications)) {
            $notifications = array();
        }

        array_push($notifications, $message);

        session::set('notification_message', $notifications);
    }

    /**
     * get appropriate template 
     * @param type $message
     * @return string
     */
    public static function getTemplate($message) {
        $type = $message['type'];
        $msg = $message['message'];

        switch ($type) {
            case self::TYPE_ERROR;
                $class = 'notification-error';
                break;
            case self::TYPE_SUCCESS;
                $class = 'notification-success';
                break;
            case self::TYPE_WARNING;
                $class = 'notification-warning';
                break;
            default:
                $class = 'notification-error';
                $type = 'error';
                break;
        }
        $html = '<div class="' . $class . ' notification-message">';
        $html.='<span style="padding-right:10px;" class="notificaion-hide"><img src="img/' . $type . '.png"></span>';
        $html.=$msg;
        $html.='<span style="float:right" class="notificaion-hide"><img src="img/close.png"></span>';
        $html.='</div>';

        return $html;
    }

    /**
     * get flash messege
     */
    public static function getMessage() {
        if (session::check('notification_message')) {
            $notifications = session::get('notification_message');

            foreach ($notifications as $notification) {
                echo self::getTemplate($notification);
            }

            session::delete('notification_message');
        }
    }

    /**
     * delete flash messege
     */
    public static function deleteMessage() {
        if (sessionClass::check('notification_message')) {
            sessionClass::delete('notification_message');
        }
    }

}
