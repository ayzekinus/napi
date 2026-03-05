<?php

if (!function_exists('csrf_generate'))
{
    function csrf_generate(){
        $csrf = md5(time(). Rand(0,100));
        $_SESSION['csrf'] = $csrf;

        return $csrf;
    }
}
