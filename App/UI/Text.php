<?php

namespace App\UI;

use App\Infra\CellularAutomata;
use App\Infra\Text\TextRenderer;
use App\Util\Parameters;

class Text
{
    public function __construct()
    {
        $this->display();
    }

    /**
     * Generates the cellular automata and display as an text block
     */
    public function display()
    {
        $parameters = new Parameters();

        $cellularAutomata = new CellularAutomata(
            $parameters->getStates(),
            $parameters->getOrder(),
            $parameters->getRule(),
            $parameters->getRandomStart(),
            $parameters->getWidth(),
            $parameters->getHeight(),
            $parameters->getPixelSize()
        );
        $renderer = new TextRenderer(
            $cellularAutomata->getRuleNumber(),
        );
        return $renderer->render($cellularAutomata);
    }
}
