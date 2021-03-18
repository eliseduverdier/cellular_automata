<?php

/**
 * Class Lib.
 */
class Lib
{
    // Defaults
    const COLOR = '#000000';
    const COLOR_BG = '#ffffff';
    const COLOR_2 = '#aacc00';
    const COLOR_3 = '#0055cc';

    /**
     * Get parameters from $_GET.
     */
    public static function getColor()
    {
        return $_GET['color'] ?? self::COLOR;
    }

    public static function getBgColor()
    {
        return $_GET['bgcolor'] ?? self::COLOR_BG;
    }

    public static function getColor2()
    {
        return $_GET['color2'] ?? self::COLOR_2;
    }

    public static function getColor3()
    {
        return $_GET['color3'] ?? self::COLOR_3;
    }

    public static function getRandomStart()
    {
        if (!array_key_exists('randomstart', $_GET)) {
            return false;
        }

        return 1 == $_GET['randomstart'] || 'on' == $_GET['randomstart'];
    }

    public static function getPixelSize()
    {
        return $_GET['pixel'] ?? 1;
    }

    public static function getWidth()
    {
        return $_GET['width'] ?? 500;
    }

    public static function getHeight()
    {
        return $_GET['height'] ?? 500;
    }

    public static function getRandomRule()
    {
        if (!array_key_exists('random', $_GET)) {
            return false;
        }

        return 1 == $_GET['random'] || 'on' == $_GET['randomstart'];
    }

    public static function getRuleNumber()
    {
        return $_GET['rule'] ?? null;
    }

    /**
     * Returns a rule number, from the paramater or randomly.
     *
     * @param {int} the number of states
     * @param mixed $states
     */
    public function whichRule($states): int
    {
        $maxRule = $this->computeMaxRule($states);
        //self::setMaxRules($states);

        
        if (false != self::getRandomRule() || 0 == self::getRuleNumber()) {
            return rand(0, $maxRule);
        }
        $rule = intval(self::getRuleNumber());
        if ($rule > $maxRule) {
            throw new Exception(sprintf(
                'Cannot use rule #%d (max: %d)',
                $rule,
                $maxRule
            ));
        }

        return $rule;
    }

    /**
     * Returns the dimension of the final image, and the length of a pixel.
     *
     * @return array column, generationsNb, pixelLength
     */
    public static function getSize(): array
    {
        $columns = self::getWidth();
        $generationsNb = self::getHeight();

        if (intval(self::getPixelSize()) > 1) {
            $pixelLength = intval(self::getPixelSize());
            $columns *= $pixelLength;
            $generationsNb *= $pixelLength;
        } else {
            $pixelLength = 1;
        }

        return [
            'columns' => $columns,
            'generationsNb' => $generationsNb,
            'pixelLength' => $pixelLength,
        ];
    }

    /**
     * The index, when in bin[/trin]ary, will represent the state of the three current cells,
     *  and the number (0/1[/2]), will represent the state of the resulting cell.
     *
     * @param {int} $ruleNumber
     * @param {int} $states     digital base
     *
     * @return array an "associative" array corresponding to the rule number
     */
    public static function ruleToArray($ruleNumber, $states): array
    {
        $toBaseN = sprintf('%08d', intval(base_convert($ruleNumber, 10, $states)));

        return array_reverse(str_split(strval($toBaseN)));
    }

    /**
     * Decode Color from string, either rrr,vvv,bbb or #rrvvbb
     * and allocate this color to the Image resource.
     *
     * @param {string}   $color    color in hexa or decimal format
     * @param {resource} $theImage the image resource
     *
     * @throws Exception if the format could not be understood
     *
     * @return int (ImageColorAllocate)
     */
    public static function decodeColor($color, $theImage): int
    {
        preg_match('/#([0-9a-fA-F]+)/i', $color, $match_hexa);
        preg_match('/\d+,\d+,\d+/i', $color, $match_rgb);
        if (count($match_hexa) > 0) { // #CCDD99
            $hexaNbs = str_split($match_hexa[1], 2);

            return imagecolorallocate(
                $theImage,
                intval(base_convert($hexaNbs[0], 16, 10)),
                intval(base_convert($hexaNbs[1], 16, 10)),
                intval(base_convert($hexaNbs[2], 16, 10))
            );
        }
        if (count($match_rgb) > 0) {  // rgb(200,220,180)
            $colorNbs = explode(',', $color);

            return imagecolorallocate(
                $theImage,
                intval($colorNbs[0]),
                intval($colorNbs[1]),
                intval($colorNbs[2])
            );
        }

        throw new Exception('The color '.$color.' could not be decoded.');
    }

    protected function computeMaxRule($states)
    {
        // TODO find the correct formula...?
        switch ($states) {
            case 2:
                return 256; // 2 ** $states ** 3
            case 3:
                return 52486;
            case 4:
                return 500000; // approx. 274875000000;
            default:
                throw new Exception(sprintf(
                    'Cannot process other states than 2, 3, 4 (%s (%s) given)',
                    $states,
                    gettype($states)
                ));
        }
    }
}
