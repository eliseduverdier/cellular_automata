<?php

namespace App\Domain;

interface DrawableInterface
{
    /**
     * Returns the drawing as a two dimentional array
     */
    public function getMatrix(): array;
}
