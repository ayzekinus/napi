<?php
/*
 * @name    mubu - a simple php framework
 *
 * @author  izni burak demirtas <izniburak@gmail.com>
 *          murat koker <muratkoker@live.com>
 * 
 * @version 2.0
 */

class Input
{
    private static $value;

    public static function post($key = null, $filter = true)
    {
		
		if(is_null($key)) return $_POST;
	
        self::$value = (isset($_POST[$key]) ? $_POST[$key] : '');
		
        if ($filter == true)
            return self::filter(self::$value);
        else
            return self::$value;
    }

    public static function get($key = null, $filter = true)
    {
		if(is_null($key)) return $_GET;
	
        self::$value = (isset($_GET[$key]) ? $_GET[$key] : '');
		
        if ($filter == true)
            return self::filter(self::$value);
        else
            return self::$value;
    }

    public static function request($key = null, $filter = true)
    {
		if(is_null($key)) return $_REQUEST;
	
        self::$value = (isset($_REQUEST[$key]) ? $_REQUEST[$key] : '');
		
        if ($filter == true)
            return self::filter(self::$value);
        else
            return self::$value;
    }

    public static function files($key = null, $name = null)
    {
		if(is_null($key)) return $_FILES;
	
        if (isset($_FILES[$key]))
        {
            if (!is_null($name))
                return $_FILES[$key][$name];
            else
                return $_FILES[$key];
        }
		
        return;
    }

    public static function server($key = null)
    {
		if(is_null($key)) return $_SERVER;
	
        self::$value = (isset($_SERVER[$key]) ? $_SERVER[$key] : '');
		
        return self::$value;
    }

    static private function filter($str = null)
    {
		$str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
        $str = trim($str);
		
        return $str;
    }
}
