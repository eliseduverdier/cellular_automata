<?php

namespace App\Infra\Image;

use App\Util\Debug;

class ColorConverter
{
    const PATTERN_HEXA = '/#([0-9a-fA-F]+)/i';
    const PATTERN_RGB = '/(?:rgb)?\(?(\d+,\d+,\d+)\)?/i';
    const PATTERN_TSL = '/tsl(\d+,\d+,\d+)/i';

    public function decode(string $color): array
    {
        // #CCDD99
        if (preg_match(ColorConverter::PATTERN_HEXA, $color, $match_hexa)) {
            return $this->fromHexa($match_hexa[1]);
        }

        // rgb(200,220,180)
        if (preg_match(ColorConverter::PATTERN_RGB, $color, $match_rgb)) {
            return $this->fromRGB($match_rgb[1]);
        }
        throw new \UnexpectedValueException("The color '$color' could not be decoded.");
    }

    private function fromHexa(string $color): array
    {
        $hexaNbs = str_split($color, 2);
        return [
            intval(base_convert($hexaNbs[0], 16, 10)),
            intval(base_convert($hexaNbs[1], 16, 10)),
            intval(base_convert($hexaNbs[2], 16, 10))
        ];
    }

    private function fromRGB(string $color): array
    {
        $colorNbs = explode(',', $color);
        return [
            intval($colorNbs[0]),
            intval($colorNbs[1]),
            intval($colorNbs[2])
        ];
    }
}
