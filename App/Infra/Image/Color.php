<?php

namespace App\Infra\Image;

class Color
{
    private $color;

    public function __construct(string $color)
    {
        $this->color = $this->decode($color);
    }

    public function allocate(\GdImage $image): int
    {
        return imagecolorallocate(
            $image,
            $this->color[0],
            $this->color[1],
            $this->color[2]
        );
    }

    /**
     * Decode Color from string, either rrr,vvv,bbb or #rrvvbb
     * @throws UnexpectedValueException if the format could not be understood
     */
    private function decode(string $color): array
    {
        return (new ColorConverter())->decode($color);
    }
}
