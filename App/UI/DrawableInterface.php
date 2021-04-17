<?php

namespace APP\UI;

interface DrawableInterface
{
    /**
     * Retudns the drawing as a two dimentional array
     */
    public function getMatrix(): array;
}
