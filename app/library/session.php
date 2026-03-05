<?php

/*
 * @name    mubu - a simple php framework
 *
 * @author  izni burak demirtas <izniburak@gmail.com>
 *          murat koker <muratkoker@live.com>
 * 
 * @version 2.0
 */

class Session {

    private static $data = array();

    public function __construct() {
        session_start();
        self::$data = & $_SESSION;
    }

    public static function set($key, $value = null) {
        if (is_array($key))
            foreach ($key as $k => $v)
                self::$data[$k] = $v;
        else
            self::$data[$key] = $value;

        return;
    }

    public static function get($key = null) {
        return (is_null($key) ? self::$data : self::$data[$key]);
    }

    public static function delete($key) {
        unset(self::$data[$key]);
        return;
    }

    public static function destroy() {
        self::$data = array();
        session_destroy();
        return;
    }

    public static function id() {
        return session_id();
    }

}
