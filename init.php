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

function fatalHandler($errno, $errstr, $errfile, $errline)
{
    header('Content-Type: application/json');
    echo json_encode(
        [
            'error' => [
                'code' => $errno,
                'message' => $errstr,
                'file' => "$errfile:$errline",
            ]
        ]
    );
}
set_error_handler('fatalHandler');
