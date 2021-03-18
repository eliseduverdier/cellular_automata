<?php

/**
 *  Cellular Automata.
 */
require 'init.php';

try {
    $cellularAutomata = new GenericCellularAutomata(4);
} catch (Exception $e) {
    echo $e->getMessage();
}
