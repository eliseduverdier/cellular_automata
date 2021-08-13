<?php

function my_autoload($className)
{
    $PROJECT_FOLDER =$_SERVER['SERVER_NAME'] === 'localhost' // TODO env variables for prod|dev
       ? ''
       : 'cellular_automata';

    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    include implode('/', [
        $_SERVER['DOCUMENT_ROOT'],
        $PROJECT_FOLDER,
        'app',
        $className . '.php'
    ]);
}
spl_autoload_register('my_autoload');
