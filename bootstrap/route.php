<?php

/*
 * @name    mubu - a simple php framework
 *
 * @author  izni burak demirtas <izniburak@gmail.com>
 *          murat koker <muratkoker@live.com>
 * 
 * @version 2.0
 */

class Route {

    private static $instance;
    private static $halts = false;
    private static $group = '';
    private static $routes = array();
    private static $methods = array();
    private static $callbacks = array();
    private static $patterns = array(
        '{a}' => '([^/]+)',
        '{i}' => '([0-9]+)',
        '{s}' => '([a-zA-Z]+)',
        '{u}' => '([a-zA-Z0-9_-]+)',
        '{*}' => '(.*)'
    );
    private static $error_callback;

    public static function getInstance() {
        Errorf::getInstance();
        Url::getInstance();
        Load::getInstance();
        Autoload::getInstance();

        if (empty(self::$instance))
            self::$instance = new Route();
        return self::$instance;
    }

    /**
     * Defines a route w/ callback and method
     */
    public static function __callstatic($method, $params) {
        $uri = $params[0];
        $callback = $params[1];

        if (strstr($uri, '{')) {
            $x = $y = '';
            foreach (explode('/', $uri) as $key => $value) {
                if ($value != '') {
                    if (!strpos($value, '?'))
                        $x .= '/' . $value;
                    else {
                        if ($y == '')
                            self::addRoute($x, $method, $callback);
                        $y = $x . '/' . str_replace('?', '', $value);
                        self::addRoute($y, $method, $callback);
                        $x = $y;
                    }
                }
            }
            if ($y == '')
                self::addRoute($x, $method, $callback);
        }
        else
            self::addRoute($uri, $method, $callback);
    }

    /**
     * Defines callback if route is not found
     */
    public static function error($callback) {
        self::$error_callback = $callback;
    }

    public static function haltOnMatch($flag = true) {
        self::$halts = $flag;
    }

    public static function addFilter($filters) {
        if (is_array($filters))
            foreach ($filters as $key => $value)
                if (!in_array('{' . $key . '}', array_keys(self::$patterns)))
                    self::$patterns['{' . $key . '}'] = '(' . $value . ')';
                else
                    Errorf::message("Opps! <b>\"" . $key . "\"</b> filter cannot be changed.");
    }

    /*
     * Add Route function. 
     */

    private static function addRoute($param, $method, $callback) {
        $uri = dirname($_SERVER['PHP_SELF']) . self::$group . $param;
        array_push(self::$routes, str_replace(['///', '//'], '/', $uri));
        array_push(self::$methods, strtoupper($method));
        array_push(self::$callbacks, $callback);
    }

    /**
     * Runs the callback for the given request
     */
    public static function run() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if ((str_replace('/', '', $uri) != BASE_FOLDER) && (substr($uri, -1) == '/'))
            $uri = substr($uri, 0, (strlen($uri) - 1));

        $method = $_SERVER['REQUEST_METHOD'];

        $searches = array_keys(static::$patterns);
        $replaces = array_values(static::$patterns);

        $found_route = false;

        // check if route is defined without regex
        if (in_array($uri, self::$routes)) {
            $route_pos = array_keys(self::$routes, $uri);
            foreach ($route_pos as $route) {
                if ((self::$methods[$route] == 'AJAX' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') || (self::$methods[$route] == 'ALL' || self::$methods[$route] == $method)) {
                    $found_route = true;

                    //if route is not an object 
                    if (!is_object(self::$callbacks[$route])) {
                        //grab all parts based on a / separator 
                        $parts = explode('/', self::$callbacks[$route]);

                        //collect the last index of the array
                        $last = end($parts);

                        //grab the controller name and method call
                        $segments = explode('@', $last);

                        $controller_file = ROOT . '/app/controllers/' . strtolower($segments[0]) . '.php';
                        if (count($parts) > 1)
                            $controller_file = ROOT . '/app/controllers/' . $parts[0] . '/' . strtolower($segments[0]) . '.php';
                        if (!file_exists($controller_file))
                            Errorf::message('<b>' . $segments[0] . '</b> Controller File is not found. Please, check file.');

                        //instanitate controller
                        require_once($controller_file);
                        $controller = new $segments[0]();

                        //call method                        
                        echo $controller->{$segments[1]}();

                        if (self::$halts)
                            return;
                    }
                    else {
                        //call closure
                        echo call_user_func(self::$callbacks[$route]);

                        if (self::$halts)
                            return;
                    }
                }
            }
        }
        else {
            // check if defined with regex
            $pos = 0;
            foreach (self::$routes as $route) {
                if (strpos($route, '{') !== false)
                    $route = str_replace($searches, $replaces, $route);

                if (preg_match('#^' . $route . '$#', $uri, $matched)) {
                    if ((self::$methods[$pos] == 'AJAX' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') || (self::$methods[$pos] == 'ALL' || self::$methods[$pos] == $method)) {
                        $found_route = true;

                        array_shift($matched); //remove $matched[0] as [1] is the first parameter.

                        $newMatched = array();

                        foreach ($matched as $key => $value) {
                            if (strstr($value, '/')) {
                                $exp = explode('/', $value);
                                foreach ($exp as $key => $value)
                                    $newMatched[] = $value;
                            }
                            else
                                $newMatched[] = $value;
                        }

                        $matched = $newMatched;

                        if (!is_object(self::$callbacks[$pos])) {
                            //grab all parts based on a / separator 
                            $parts = explode('/', self::$callbacks[$pos]);

                            //collect the last index of the array
                            $last = end($parts);

                            //grab the controller name and method call
                            $segments = explode('@', $last);

                            $controller_file = ROOT . '/app/controllers/' . strtolower($segments[0]) . '.php';
                            if (count($parts) > 1)
                                $controller_file = ROOT . '/app/controllers/' . $parts[0] . '/' . strtolower($segments[0]) . '.php';
                            if (!file_exists($controller_file))
                                Errorf::message('<b>' . $segments[0] . '</b> Controller File is not found. Please, check file.');

                            //instanitate controller
                            require_once($controller_file);
                            $controller = new $segments[0]();

                            //call method and pass any extra parameters to the method
                            echo call_user_func_array(array($controller, $segments[1]), $matched);

                            if (self::$halts)
                                return;
                        }
                        else {
                            //call closure
                            echo call_user_func_array(self::$callbacks[$pos], $matched);

                            if (self::$halts)
                                return;
                        }
                    }
                }
                $pos++;
            }
        }

        // run the error callback if the route was not found
        if ($found_route == false) {
            if (!self::$error_callback) {
                self::$error_callback = function() {
                            header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
                            Errorf::message('Üzgünüm, aradığınız sayfa bulunamadı!', 'index');
                        };
            }
            call_user_func(self::$error_callback);
        }
    }

    public static function group($name, $obj = null) {
        self::$group .= '/' . $name;

        if (is_object($obj))
            call_user_func($obj);

        self::endGroup();
    }

    public static function endGroup() {
        if (substr_count(self::$group, '/') > 1) {
            $explode = explode('/', self::$group);
            unset($explode[0]);
            unset($explode[count($explode)]);

            self::$group = '';

            foreach ($explode as $key => $value)
                self::$group .= '/' . $value;
        }
        else
            self::$group = '';
    }

    public static function controller($route, $controller) {
        $controller_file = ROOT . '/app/controllers/' . strtolower($controller) . '.php';


        if (!class_exists($controller))
            require_once($controller_file);

        $class_methods = get_class_methods($controller);

        foreach ($class_methods as $method_name) {
            if (!strstr($method_name, '__')) {
                $r = new \ReflectionMethod($controller, $method_name);
                $param_num = $r->getNumberOfRequiredParameters();
                $param_num2 = $r->getNumberOfParameters();

                $value = ($method_name == 'home' ? $route : $route . '/' . $method_name);

                if ($param_num2 != $param_num)
                    self::addRoute(($value . str_repeat('/{u}', $param_num)), 'ALL', ($controller . '@' . $method_name));

                self::addRoute(($value . str_repeat('/{u}', $param_num2)), 'ALL', ($controller . '@' . $method_name));
            }
        }
        unset($r);
        $req = null;
    }

    public static function getRoutes() {
        var_dump(self::$routes);
    }

}
