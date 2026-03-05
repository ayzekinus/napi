<?php

if (!function_exists('dates'))
{
	function dates($time)
	{
		$d 		= date("j M Y", $time);
		$ing	= array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
		$tr		= array("Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi", "Pazar");
		$x		= str_replace($ing, $tr, $d);
		return $x;
	}
}

if (!function_exists('hours'))
{
	function hours($time, $s = false)
	{
		$x	= date("H:i", $time);
		if($s) $x = date("H:i:s", $time);
		return $x;	
	}
}
