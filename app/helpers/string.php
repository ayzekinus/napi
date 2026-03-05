<?php


if (!function_exists('strtoupper_tr')) {
    function strtoupper_tr($s)
    {

        $degis1 = array("a", "b", "c", "ç", "d", "e", "f", "g", "ğ", "h", "ı",
            "i", "j", "k", "l", "m", "n", "o", "ö", "p", "r", "s", "ş", "t",
            "u", "ü", "v", "y", "z", "q", "w", "x");
        $degis2 = array("A", "B", "C", "Ç", "D", "E", "F", "G", "Ğ", "H", "I",
            "İ", "J", "K", "L", "M", "N", "O", "Ö", "P", "R", "S", "Ş", "T",
            "U", "Ü", "V", "Y", "Z", "Q", "W", "X");
        $tmp = str_replace($degis1, $degis2, $s);

        return $tmp;
    }
}

if (!function_exists('strtolower_tr')) {
    function strtolower_tr($s)
    {
        $tmp = str_replace(
            array("A", "B", "C", "Ç", "D", "E", "F", "G", "Ğ", "H", "I",
                "İ", "J", "K", "L", "M", "N", "O", "Ö", "P", "R", "S", "Ş", "T",
                "U", "Ü", "V", "Y", "Z", "Q", "W", "X"), array("a", "b", "c", "ç", "d", "e", "f", "g", "ğ", "h", "ı",
            "i", "j", "k", "l", "m", "n", "o", "ö", "p", "r", "s", "ş", "t",
            "u", "ü", "v", "y", "z", "q", "w", "x"), $s
        );
        return $tmp;
    }
}

if (!function_exists('ucfirst_tr')) {
    function ucfirst_tr($s)
    {
        return strtoupper_tr(substr($s, 0, 1)) . strtolower_tr(substr($s, 1));
    }
}

?>
