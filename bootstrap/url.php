<?php

/*
 * @name	mubu - a simple php framework
 *
 * @author	izni burak demirtas <izniburak@gmail.com>
 * 			murat koker <muratkoker@live.com>
 * 
 * @version 2.0
 */

class Url {

    private static $instance;
    private static $url = null;
    private static $http = 'http://';

    function __construct() {
        self::$url = $_SERVER['HTTP_HOST'] . '/' . BASE_FOLDER . '/';
        if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443)
            self::$http = 'https://';
    }

    public static function __callStatic($method, $args) {
        $name = str_replace('ssl', '', strtolower($method));
        self::$http = 'https://';
        return self::$name(($args ? $args[0] : null));
    }

    public static function getInstance() {
        if (empty(self::$instance))
            self::$instance = new Url();
        return self::$instance;
    }

    public static function base($data = null) {
        $data = (!is_null($data)) ? self::$url . $data : self::$url . '/';
        return self::$http . self::replace($data);
    }

    public static function admin($data = null) {
        $data = (!is_null($data)) ? self::$url . '/' . ADMIN_FOLDER . '/' . $data : self::$url . '/' . ADMIN_FOLDER . '/';
        return self::$http . self::replace($data);
    }

    public static function theme($data = null) {
        $data = (!is_null($data)) ? self::$url . '/assets/' . $data : self::$url . '/assets/';
        return self::$http . self::replace($data);
    }

    public static function redirect($data = null) {
        $data = (!is_null($data)) ? self::$url . '/' . $data : self::$url;
        header('Location: ' . self::$http . self::replace($data), true, 302);
        die();
    }

    public static function active() {
        return self::$http . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public static function segment($num = null) {
        if (!isset($_SERVER['REQUEST_URI']) || !isset($_SERVER['SCRIPT_NAME']))
            return null;

        if (!is_null($num)) {
            $uri = $_SERVER['REQUEST_URI'];
            $uri = str_replace(BASE_FOLDER, '', $uri);
            $uri = self::replace($uri);
            $uriA = explode('/', $uri);
            return (isset($uriA[$num]) ? $uriA[$num] : null);
        }
        else
            return null;
    }

    private static function replace($data) {
        return str_replace(array('///', '//'), '/', $data);
    }

}
