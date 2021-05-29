<?php

namespace App\Infra\Image;

use App\Domain\DrawableInterface;
use App\Domain\RendererInterface;
use App\Infra\Image\Color;
use App\Util\Debug;

class ImageRenderer implements RendererInterface
{
    /** @var \GdImage The image */
    private $image;

    public function __construct(
        int $columns,
        int $generationsNb,
        private int $pixelSize,
        private int $ruleNumber,
        private array $colors
    ) {
        $this->image = imagecreatetruecolor($columns, $generationsNb);
        $this->pixelSize = $pixelSize;
        $this->ruleNumber = $ruleNumber;

        $this->colors = [];
        foreach ($colors as $color) {
            $this->colors[] = (new Color($color))->allocate($this->image);
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
     * @return int
     */
    protected function getColorFromNumber(int $number)
    {
        return $this->colors[$number];
    }
}
