<?php

namespace App;

class image
{
    /**
     * 
     */
    public function __construct()
    {
        $parameters = new Util\Parameters();

        $cellularAutomata =  new CellularAutomata(
            $parameters->getStates(),
            $parameters->getOrder(),
            $parameters->getRule(),
            $parameters->getRandomStart(),
            $parameters->getWidth(),
            $parameters->getHeight(),
            $parameters->getPixelSize()
        );
        $renderer = new UI\ImageRenderer(
            $parameters->getWidth(),
            $parameters->getHeight(),
            $parameters->getPixelSize(),
            $cellularAutomata->getRuleNumber(),
            $parameters->getColors()
        );
        return $renderer->render($cellularAutomata);
    }
}
