<?php

/**
 *  Cellular Automata.
 */
require 'init.php';

try {
    $cellularAutomata = new CellularAutomata(2);
} catch (Exception $e) {
    echo $e->getMessage();
}
