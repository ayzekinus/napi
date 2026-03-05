<?php


class Cookie
{
    private static $data = array();

    public function __construct()
    {
        self::$data = $_COOKIE;
    }

    public static function set($key, $value, $time = 0)
    {
		if(is_array($key))
		{
			foreach ($key as $k => $v)
			{
				setcookie($k, $v, ($time == 0 ? 0 : time() + 60 * $time), '/');
				self::$data[$k] = $v;
			}
		}
		else
		{
			setcookie($key, $value, ($time == 0 ? 0 : time() + 60 * $time), '/');
			self::$data[$key] = $value;
		}
		return;
    }

    public static function get($key = null)
    {
		return (is_null($key) ? self::$data : self::$data[$key]);
    }

    public static function delete($key)
    {
		setcookie($key, NULL, time()-9999999999);
        unset(self::$data[$key]);
    }

    public static function destroy()
    {
		foreach (self::$data as $k => $v)
		{
			setcookie($k, NULL, time()-9999999999);
			unset(self::$data[$k]);
		}
		return;
    }
}
