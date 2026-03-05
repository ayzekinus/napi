<?php

/*
 * @name    mubu - a simple php framework
 *
 * @author  izni burak demirtas <izniburak@gmail.com>
 *          murat koker <muratkoker@live.com>
 * 
 * @version 2.0
 */

Class Errorf {

    private static $instance;

    public static function getInstance() {
        if (empty(self::$instance))
            self::$instance = new Errorf();
        return self::$instance;
    }

    public static function message($msg = null, $page = null) {

        $message = is_null($msg) ? '' : $msg;

        if (is_null($page))
            die(($message == '' ? 'Oppss! System error. Please check your codes.' : $message));
        else {
            $file = ROOT . '/app/errors/' . $page . '.php';
            if (file_exists($file)) {
                require $file;
                die();
            }
            else
                die($msg);
        }
    }

}
