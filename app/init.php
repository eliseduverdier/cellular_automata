<?php


function my_autoload($className)
{
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    $path = implode('/', [
        isFromCLI() ? dirname($_SERVER['PWD']) : $_SERVER['DOCUMENT_ROOT'],
        isLocalHost() ? '' : 'cellular_automata',
        'app',
        $className . '.php'
    ]);
    include $path;
}
spl_autoload_register('my_autoload');


function isLocalHost(): bool
{
    // todo getenv('ENV') === 'dev'
    return isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] === 'localhost';
}

function isFromCLI()
{
    return php_sapi_name() === 'cli';
}
