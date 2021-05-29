<?php

namespace App\UI;

use App\Infra\CellularAutomata;
use App\Infra\Image\ImageRenderer;
use App\Util\Debug;
use App\Util\Parameters;

class Image
{
    public function __construct()
    {
        $this->display();
    }

    /**
     * Generates the cellular automata and display as an image
     */
    public function display()
    {
        $parameters = new Parameters();

        $cellularAutomata =  new CellularAutomata(
            $parameters->getStates(),
            $parameters->getOrder(),
            $parameters->getRule(),
            $parameters->getRandomStart(),
            $parameters->getWidth(),
            $parameters->getHeight(),
            $parameters->getPixelSize()
        );
        $renderer = new ImageRenderer(
            $parameters->getWidth(),
            $parameters->getHeight(),
            $parameters->getPixelSize(),
            $cellularAutomata->getRuleNumber(),
            $parameters->getColors()
        );

        return $renderer->render($cellularAutomata);
    }
}
