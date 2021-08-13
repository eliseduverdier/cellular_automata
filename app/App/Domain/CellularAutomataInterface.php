<?php

namespace App\Domain;

interface CellularAutomataInterface
{
    /**
     * Returns the 2D array representing all the cells  of the automata
     */
    public function getMatrix(): array;

    /**
     * Returns the rule number that was used to compute the automata
     */
    public function getRuleNumber(): int;
}
