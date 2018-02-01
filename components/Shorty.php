<?php

namespace mergit\shorty\components;

class Shorty {
    /**
     * Default characters to use for shortening.
     *
     * @var string
     */
    private static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    /**
     * Salt for id encoding.
     *
     * @var string
     */
    private static $salt = 'dfgdfu98esdfvnvdfirijckvjnsdpriubvfcgvuf';
    /**
     * Length of number padding.
     */
    private static $padding = 4;





    /**
     * Converts an id to an encoded string.
     *
     * @param int $n Number to encode
     * @return string Encoded string
     */
    private static function encode($n) {
        $k = 0;
        if (self::$padding > 0 && !empty(self::$salt)) {
            $k = self::get_seed($n, self::$salt, self::$padding);
            $n = (int)($k.$n);
        }
        return self::num_to_alpha($n, self::$chars);
    }
    /**
     * Converts an encoded string into a number.
     *
     * @param string $s String to decode
     * @return int Decoded number
     */
    private static function decode($s) {
        $n = self::alpha_to_num($s, self::$chars);
        return (!empty(self::$salt)) ? substr($n, self::$padding) : $n;
    }
    /**
     * Gets a number for padding based on a salt.
     *
     * @param int $n Number to pad
     * @param string $salt Salt string
     * @param int $padding Padding length
     * @return int Number for padding
     */
    private static function get_seed($n, $salt, $padding) {
        $hash = md5($n.$salt);
        $dec = hexdec(substr($hash, 0, $padding));
        $num = $dec % pow(10, $padding);
        if ($num == 0) $num = 1;
        $num = str_pad($num, $padding, '0');
        return $num;
    }
    /**
     * Converts a number to an alpha-numeric string.
     *
     * @param int $num Number to convert
     * @param string $s String of characters for conversion
     * @return string Alpha-numeric string
     */
    private static function num_to_alpha($n, $s) {
        $b = strlen($s);
        $m = $n % $b;
        if ($n - $m == 0) return substr($s, $n, 1);
        $a = '';
        while ($m > 0 || $n > 0) {
            $a = substr($s, $m, 1).$a;
            $n = ($n - $m) / $b;
            $m = $n % $b;
        }
        return $a;
    }
    /**
     * Converts an alpha numeric string to a number.
     *
     * @param string $a Alpha-numeric string to convert
     * @param string $s String of characters for conversion
     * @return int Converted number
     */
    private static function alpha_to_num($a, $s) {
        $b = strlen($s);
        $l = strlen($a);
        for ($n = 0, $i = 0; $i < $l; $i++) {
            $n += strpos($s, substr($a, $i, 1)) * pow($b, $l - $i - 1);
        }
        return $n;
    }


    public static function getShortUrl($id) {
        $short_url = self::encode($id);
        return $short_url;
    }

    public static function getId($short_url) {
        if (preg_match('/^([a-zA-Z0-9]+)$/', $short_url, $matches)) {
            $id = self::decode($matches[1]);
            return ($id);
        }
    }


}