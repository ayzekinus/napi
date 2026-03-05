<?php

if (!function_exists('escape_str'))
{
    function escape_str($value){

        $replace1 = array("\\", "'", "\\0", "\n", "\r", '"', "\x1a", "\\**\\");
        $replace2 = array("\\\\", '\'', "\\\\0", "\\n", "\\r", '\"', "\\Z", "");

        $replace3 = array("CAST(DATABASE()", "DUAL WHERE", "UPDATEXML", "OR SLEEP", "AND SLEEP", "EXTRACTVALUE", "SELECT CONVERT", "SELECT BENCHMARK", "SELECT CONCAT", "AND JSON_KEYS", "SELECT * FROM", "INFORMATION_SCHEMA", "CASE WHEN", "THEN 1 ELSE", "BOOLEAN MODE", "IFNULL", "AND ELT",  "OR ELT", "OR ORD");
        $replace4 = array("AND ORD", "MAKE_SET", "RLIKE (SELECT", "UNION ALL", "CONCAT(", "ORDER BY", "PROCEDURE ANALYSE", "FLOOR(RAND", "COUNT(*)", "AND EXP", "OR EXP", "script>", "alert(", "</scr", "xp_cmdshell", "AND 1=1", "etc/passwd");

        $value = str_replace($replace1, $replace2, $value);
        $value = str_replace($replace3, "",$value);
        $value = str_replace($replace4, "", $value);

        return $value;
    }
}
