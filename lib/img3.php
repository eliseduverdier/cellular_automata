<?php

/**
 *  Cellular Automata.
 */
require 'init.php';

try {
    $cellularAutomata = new CellularAutomata(3);
} catch (Exception $e) {
    echo $e->getMessage();
}
