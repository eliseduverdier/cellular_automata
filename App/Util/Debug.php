<?php

namespace App\Util;

class Debug
{
    /**
     * Echoes a variable or a list of variables
     * @param mixed $var
     */
    static public function print(...$var): void
    {
        foreach ($var as $v) {
            echo '<pre style="background: black; color: white; padding: 5px; margin: 5px;">';
            var_dump($v);
            echo '</pre>';
        }
    }
}
