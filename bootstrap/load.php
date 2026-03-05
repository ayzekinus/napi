<?php

/*
 * @name    mubu - a simple php framework
 *
 * @author  izni burak demirtas <izniburak@gmail.com>
 *          murat koker <muratkoker@live.com>
 * 
 * @version 2.0
 */

class Load {

    private static $instance = null;
    public static $library, $model = array();

    public function __construct() {
        
    }

    public static function __callStatic($name, $val) {
        return $this->$name($val[0], $val[1]);
    }

    public static function getInstance() {
        if (empty(self::$instance))
            self::$instance = new Load();
        return self::$instance;
    }

    public static function get() {
        return self::getInstance();
    }

    public static function view($name, $data = null) {
        $name = strtolower($name);
        $file = ROOT . '/app/views/' . $name . '.php';
        if (file_exists($file)) {
            if (is_array($data))
                extract($data);
            require $file;
        }
        else
            Errorf::message('<b>View::' . $name . '</b> not found.');
    }

    public function model($name) {
        $name = strtolower($name);
        $model = ROOT . '/app/models/_model.php';
        $file = ROOT . '/app/models/' . $name . '.php';
        if (file_exists($file)) {
            if (!class_exists("Model"))
                require $model;
            if (!class_exists($name))
                require $file;

            if (!isset(self::$model[$name]))
                self::$model[$name] = new $name();

            return self::$model[$name];
        }
        else
            Errorf::message('<b>Model::' . $name . '</b> not found.');
    }

    public function library($name, $params = null) {
        $name = strtolower($name);
        $file = ROOT . '/app/library/' . $name . '.php';
        if (file_exists($file)) {
            if (!class_exists($name))
                require $file;

            if (!isset(self::$library[$name]) && is_null($params))
                self::$library[$name] = new $name();
            elseif (!isset(self::$library[$name]) && !is_null($params))
                if (is_array($params))
                    self::$library[$name] = eval("\$a = new $name('" . implode("', '", $params) . "'); return \$a;");
                else
                    self::$library[$name] = new $name($params);

            return self::$library[$name];
        }
        else
            Errorf::message('<b>Library::' . $name . '</b> not found.');
    }

    public static function helper($name) {
        $name = strtolower($name);
        $file = ROOT . '/app/helpers/' . $name . '.php';
        if (file_exists($file))
            require $file;
        else
            Errorf::message('<b>Helper::' . $name . '</b> not found.');
    }

    public function __destruct() {
        self::$instance = null;
        self::$library = self::$model = array();
    }

}
