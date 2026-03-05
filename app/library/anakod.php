<?php
/**
 * User: muratkoker
 * Date: 10.07.2018
 * Time: 18:53
 */

class Anakod {

    public static function olustur($anakod){

        $bir = strtoupper($anakod[0]);
        $iki = strtoupper($anakod[1]);
        $uc = strtoupper($anakod[2]);


        $buldum = false;

        if ($uc == 'Z' && $iki != 'Z' && !$buldum) {
            $buldum = true;
            $anakod = $bir . self::nextChar($iki) . self::nextChar($uc);
        }

        if (ord($uc) < 90 && !$buldum) {
            $buldum = true;
            $anakod =  $bir . $iki . self::nextChar($uc);
        }

        if ($iki == 'Z' && !$buldum) {
            $buldum = true;
            $anakod =  self::nextChar($bir) . self::nextChar($iki) . self::nextChar($uc);
        }

        return $anakod;

    }

    private static function nextChar($ch){
        $ch = ord($ch) + 1;
        if ($ch > 90) {
            return 'A';
        }
        if ($ch == 81) {
            return 'R';
        }
        if ($ch == 87 || $ch == 88) {
            return 'Y';
        }
        return chr($ch);
    }

}