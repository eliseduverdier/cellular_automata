<?php

namespace APP\UI;

interface RendererInterface
{
    /**
     * Should render the cellular automata as an image, text, …
     */
    public function render(DrawableInterface $drawing);
}
