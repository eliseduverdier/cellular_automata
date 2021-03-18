<?php

/**
 *   Cellular Automata with 3 states.
 */
class GenericCellularAutomata extends CellularAutomata
{
    public function __construct(int $states = 2, $order = 1)
    {
        static::$states = $states;
        static::$order = $order;
        parent::__construct();
    }
}
