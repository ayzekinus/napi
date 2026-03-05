<?php


class Cache
{
	private static $file;

	public function __construct()
	{

		$fileName = md5('%%-' . $_SERVER['REQUEST_URI']) . '.cache';
		$path = ROOT . '/storage/cache/html/';
		$path = str_replace('//', '/', $path);

		if (!file_exists($path)) $createPath = mkdir($path, 0777);

		self::$file = $path . $fileName;
	}

	public function start($time = 1)
	{
		ob_start();
		$cacheTime = $time * 60;
		if (file_exists(self::$file)) {
			if (time() - $cacheTime < filemtime(self::$file)) {
				readfile(self::$file);
				die();
			} else
				self::delete();
		}
		return;
	}

	private function delete()
	{
		unlink(self::$file);
		return;
	}

	public function finish()
	{
		$fp = fopen(self::$file, 'w+');
		fwrite($fp, ob_get_contents());
		fclose($fp);
		ob_end_flush();
		return;
	}
}
