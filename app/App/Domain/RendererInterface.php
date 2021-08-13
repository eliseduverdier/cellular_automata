<?php

namespace App\Domain;

interface RendererInterface
{
    /**
     * Should render the cellular automata as an image, text, …
     */
    public function render(DrawableInterface $drawing);
}
