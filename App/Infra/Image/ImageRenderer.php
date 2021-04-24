<?php

namespace App\Infra\Image;

use App\Domain\DrawableInterface;
use App\Domain\RendererInterface;
use App\Infra\Image\Color;
use App\Util\Debug;

class ImageRenderer implements RendererInterface
{
    /** @var resource The image */
    private $image;

    /** @var int[] The int corresponding to the color, relative to the resource image */
    private $colors = [];

    public function __construct(
        protected int $columns,
        protected int $generationsNb,
        protected int $pixelSize,
        protected int $ruleNumber,
        array $colors
    ) {
        $this->image = imagecreatetruecolor($this->columns, $this->generationsNb);

        foreach ($colors as $color) {
            array_push($this->colors, (new Color())->decodeColor($color, $this->image));
        }
    }

    /**
     * Outputs the image as PNG
     * with headers:
     * -> "no-cache" to avoid getting same result with random rule
     * -> "filename" filled with rule number
     */
    public function render(DrawableInterface $automata): bool
    {
        $this->draw($automata->getMatrix());

        header('Content-Type: image/png');
        header('Cache-Control: no-cache');
        header('Content-Disposition: inline; filename="Rule' . $this->ruleNumber . '.png"');
        return imagepng($this->image);
    }

    /**
     * Draws the image from the matrix background, and points.
     */
    public function draw($matrix): void
    {
        imagefill($this->image, 0, 0, $this->colors[0]);

        for ($line = 0; $line < count($matrix); ++$line) {
            for ($cell = 0; $cell < count($matrix[$line]); ++$cell) {
                if (0 !== $matrix[$line][$cell]) {
                    $x1 = $cell * $this->pixelSize;
                    $y1 = $line * $this->pixelSize;
                    $x2 = $x1 + $this->pixelSize - 1;
                    $y2 = $y1 + $this->pixelSize - 1;
                    if ($this->pixelSize > 1) {
                        imagefilledrectangle(
                            $this->image,
                            $x1,
                            $y1,
                            $x2,
                            $y2,
                            $this->getColorFromNumber($matrix[$line][$cell])
                        );
                    } else {
                        imagesetpixel(
                            $this->image,
                            $cell,
                            $line,
                            $this->getColorFromNumber($matrix[$line][$cell])
                        );
                    }
                }
            }
        }
    }

    /**
     * @param int $number
     */
    protected function getColorFromNumber(int $number)
    {
        return $this->colors[$number];
    }
}
