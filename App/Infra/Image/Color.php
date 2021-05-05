<?php

namespace App\Infra\Image;

class Color
{
    /**
     * Decode Color from string, either rrr,vvv,bbb or #rrvvbb
     * and allocate this color to the Image resource.
     *
     * @param string   $color  color in hexa or decimal format
     * @param \GdImage $image  the image resource
     *
     * @throws Exception if the format could not be understood
     *
     * @return int (ImageColorAllocate)
     */
    public function decodeColor(string $color, $image): int
    {
        // #CCDD99
        if (preg_match('/#([0-9a-fA-F]+)/i', $color, $match_hexa)) {
            $color = $this->hexaToColor($match_hexa[1]);
            return imagecolorallocate($image, $color[0], $color[1], $color[2]);
        }

        // rgb(200,220,180)
        if (preg_match('/\d+,\d+,\d+/i', $color, $match_rgb)) {
            $color = $this->rgbToColor($color);
            return imagecolorallocate($image, $color[0], $color[1], $color[2]);
        }

        throw new \Exception("The color '$color' could not be decoded.");
    }

    /**
     * @param string $color as hexadecimal code
     * @return ressource (imagecolorallocate)
     */
    protected function hexaToColor(string $color)
    {
        $hexaNbs = str_split($color, 2);
        return [
            intval(base_convert($hexaNbs[0], 16, 10)),
            intval(base_convert($hexaNbs[1], 16, 10)),
            intval(base_convert($hexaNbs[2], 16, 10))
        ];
    }

    /**
     * @param string $color as hexadecimal code
     * @return ressource (imagecolorallocate)
     */
    protected function rgbToColor(string $color)
    {
        $colorNbs = explode(',', $color);
        return [
            intval($colorNbs[0]),
            intval($colorNbs[1]),
            intval($colorNbs[2])
        ];
    }
}
