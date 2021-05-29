<?php

namespace App\Infra\Text;

use Config\Defaults;
use App\Domain\DrawableInterface;
use App\Domain\RendererInterface;

class TextRenderer implements RendererInterface
{
    public function __construct(private int $ruleNumber)
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
            $this->getHtmlBase()
        );
    }

    /**
     * @param int $number 
     */
    protected function getCharacterFromNumber(int $number)
    {
        return Defaults::CHARACTERS[$number];
    }

    private function getHtmlBase(): string
    {
        return file_get_contents(dirname(__DIR__, 3) . '/templates/base.html');
    }
}
