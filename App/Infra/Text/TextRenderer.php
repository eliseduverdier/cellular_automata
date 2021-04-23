<?php

namespace App\Infra\Text;

use App\Domain\DrawableInterface;
use App\Domain\RendererInterface;

class TextRenderer implements RendererInterface
{
    // TODO create in resources and retreive from there
    const BASIC_HTML_PAGE = '<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Cellular Automata — rule {{rule}}</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <body>{{content}}</body>
    </html>';

    /** @var int[] The int corresponding to the color, relative to the resource image */
    private $characters = ['◉', '◌', '✻', '❁', '❖', '▦', '░', '·', '▓'];

    public function __construct(
        protected int $ruleNumber,
    ) {
    }

    /**
     * Outputs the image as PNG
     * with headers:
     * -> "no-cache" to avoid getting same result with random rule
     * -> "filename" filled with rule number
     */
    public function render(DrawableInterface $automata): void
    {
        //header('Content-Type: application/text');
        header('Cache-Control: no-cache');
        echo $this->draw($automata->getMatrix());
    }

    /**
     * Draws the image from the matrix background, and points.
     */
    public function draw($matrix)
    {
        $text = '<pre>';
        for ($line = 0; $line < count($matrix); ++$line) {
            for ($cell = 0; $cell < count($matrix[$line]); ++$cell) {
                $text .= $this->getCharacterFromNumber($matrix[$line][$cell]);
            }
            $text .= "\n";
        }
        $text .= '</pre>';

        return str_replace(
            ['{{content}}', '{{rule}}'],
            [$text, $this->ruleNumber],
            self::BASIC_HTML_PAGE
        );
    }

    /**
     * @param int $number 
     */
    protected function getCharacterFromNumber(int $number)
    {
        return $this->characters[$number];
    }
}
