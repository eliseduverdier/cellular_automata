<?php

function my_autoload($className)
{
    $PROJECT_FOLDER = 'cellular_automata';
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    include implode('/', [
        $_SERVER['DOCUMENT_ROOT'],
        $PROJECT_FOLDER,
        $className . '.php'
    ]);
}
spl_autoload_register('my_autoload');

/**
 * Rudimentary debug method
 */
function dump(...$var): void
{
    foreach ($var as $v) {
        echo '<div style="font: normal 10px monospace; background: black; color: white; padding: 5px; margin: 5px;">';
        echo "<span style='color: red;'>in {$_SERVER['SCRIPT_NAME']}: </span>";
        echo '<pre>';
        var_dump($v);
        echo '</pre>';
        echo '</div>';
    }
}
