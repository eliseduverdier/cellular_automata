<?php

namespace App\Infra\Text;

use Config\Defaults;
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
            <style>pre{line-height: .6em;}</style>
        </head>
        <body>{{content}}</body>
    </html>';

    public function __construct(protected int $ruleNumber)
    {
    }

    /**
     * Outputs the cellular automata as text
     * with headers:
     * -> "no-cache" to avoid getting same result with random rule
     * -> "filename" filled with rule number
     */
    public function render(DrawableInterface $automata): void
    {
        header('Cache-Control: no-cache');
        echo $this->draw($automata->getMatrix());
    }

    /**
     * Draws the image from the matrix background, and points.
     */
    public function draw(array $matrix): string
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
        return Defaults::CHARACTERS[$number];
    }
}
