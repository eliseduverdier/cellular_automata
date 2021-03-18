<?php
require 'init.php';

try {
    $cellularAutomata = new CellularAutomata(4);
} catch (Exception $e) {
    echo $e->getMessage();
}
