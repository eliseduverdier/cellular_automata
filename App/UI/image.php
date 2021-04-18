<?php

namespace App\UI;

use App\Infra\CellularAutomata;
use App\Infra\Image\ImageRenderer;
use App\Util\Parameters;

class image
{
    public function __construct()
    {
        $this->display();
    }

    public function display()
    {
        try {
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
        } catch (\Exception $e) {
            // TODO move in abstract UI
            http_response_code(500);
            header('Content-Type: pplication/json');
            echo json_encode($e, 0, 1);
            return;
        }
    }
}
