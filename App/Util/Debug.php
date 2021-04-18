<?php

namespace App\Util;

/**
 * 
 */
class Debug
{
    static public function print($var)
    {
        echo '<pre>';
        if (is_array($var)) {
            print_r($var);
        } else {
            echo $var . "\n";
        }
        echo '</pre>';
    }
}
