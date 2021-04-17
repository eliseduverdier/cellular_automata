<?php

namespace APP\UI;

use App\Util\Color;

class ImageRenderer implements RendererInterface
{
    /** @var resource The image */
    protected $theImage;

    public function __construct(
        protected int $columns,
        protected int $generationsNb,
        protected int $pixelSize,
        protected int $ruleNumber,
        array $colors
    ) {
        [$width, $height] = $this->getSize($this->columns, $this->generationsNb, $pixelSize);
        $this->theImage = imagecreatetruecolor($width, $height);

        $this->theBgColor = (new Color())->decodeColor($colors[0], $this->theImage);
        $this->theColor1 = (new Color())->decodeColor($colors[1], $this->theImage);
        $this->theColor2 = (new Color())->decodeColor($colors[2], $this->theImage);
        $this->theColor3 = (new Color())->decodeColor($colors[3], $this->theImage);
    }

    /**
     * Outputs the image as PNG
     * with correct headers
     * -> No cache to avoid getting same result with random rule
     */
    public function render(DrawableInterface $automata)
    {
        // generate
        $this->draw($automata->getMatrix());

        header('Content-Type: image/png');
        header('Cache-Control: no-cache');
        header('Content-Disposition: inline; filename="Rule' . $this->ruleNumber . '.png"');
        imagepng($this->theImage);
    }

    /**
     * Draws the image from the matrix background, and points.
     */
    public function draw($matrix)
    {
        imagefill($this->theImage, 0, 0, $this->theBgColor);
        for ($line = 0; $line < count($matrix); ++$line) {
            for ($cell = 0; $cell < count($matrix[$line]); ++$cell) {
                if (0 !== $matrix[$line][$cell]) {
                    $x1 = $cell * $this->pixelSize;
                    $y1 = $line * $this->pixelSize;
                    $x2 = $x1 + $this->pixelSize - 1;
                    $y2 = $y1 + $this->pixelSize - 1;
                    if ($this->pixelSize > 1) {
                        imagefilledrectangle(
                            $this->theImage,
                            $x1,
                            $y1,
                            $x2,
                            $y2,
                            $this->getColorFromNumber($matrix[$line][$cell])
                        );
                    } else {
                        imagesetpixel(
                            $this->theImage,
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
     * @param int $number the "index" of the number
     */
    protected function getColorFromNumber(int $number)
    {
        switch ($number) {
            case 1:
                return $this->theColor1;
            case 2:
                return $this->theColor2;
            case 3:
                return $this->theColor3;
            default:
                return $this->theBgColor;
        }
    }


    /**
     * Returns the dimension of the final image, and the length of a pixel.
     * @param int $width
     * @param int $height
     * @param int $pixelSize
     * @return array column, generationsNb, pixelSize
     */
    protected function getSize($width, $height, $pixelSize)
    {
        if (intval($pixelSize) > 1) {
            $pixelSize = intval($pixelSize);
            $width *= $pixelSize;
            $height *= $pixelSize;
        } else {
            $pixelSize = 1;
        }

        return [
            $width,
            $height,
        ];
    }
}
