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
            echo str_replace(
                ['{{file}}', '{{var}}'],
                [$_SERVER['SCRIPT_NAME'], var_export($v, true)],
                file_get_contents(dirname(__DIR__, 2) . '/public/debug.html')
            );
        }
    }
}
