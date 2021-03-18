<?php

/**
 * Cellular Automata Class.
 * TODO remove all those static nonsense.
 */
class CellularAutomata
{
    /** @var int The rule number */
    protected static $ruleNumber;

    /** @var int The number of different states */
    protected static $states;

    /** @var int The number of generation to take into account to compute a new cell */
    protected static $order;

    /** @var resource The image */
    protected $theImage;

    /** @var array the "map" representation of the rule. */
    protected $ruleArray;

    /** @var array the resulting array of array */
    protected $matrix;

    /**
     * Cellular automata constructor.
     */
    public function __construct(int $states = 2, int $order = 1)
    {
        // TODO use $this
        static::$states = $states;
        static::$order = $order;

        // TODO Parameters class, with ->get('') for each parameters
        $lib = new Lib();

        $this->ruleNumber = $lib->whichRule(static::$states);
        $this->ruleArray = Lib::ruleToArray($this->ruleNumber, static::$states);

        $size = Lib::getSize();
        $this->columns = $size['columns'];
        $this->generationsNb = $size['generationsNb'];
        $this->pixelLength = $size['pixelLength'];

        // colors // TODO, instanciate only needed colors
        $this->theImage = imagecreatetruecolor($this->columns, $this->generationsNb);
        $this->theColor = Lib::decodeColor(Lib::getColor(), $this->theImage);
        $this->theBgColor = Lib::decodeColor(Lib::getBgColor(), $this->theImage);
        $this->theColor2 = Lib::decodeColor(Lib::getColor2(), $this->theImage);
        $this->theColor3 = Lib::decodeColor(Lib::getColor3(), $this->theImage);

        // generate
        $this->generate();
        $this->draw();
        $this->display();
    }

    /**
     * Fill the first line with states, randomly or not.
     *
     * @return array of 0s and 1s
     */
    public function getFirstLine()
    {
        $cells = [];
        for ($i = 0; $i < ($this->columns / $this->pixelLength); ++$i) {
            if (Lib::getRandomStart()) {
                $middle = intval(($this->columns / $this->pixelLength) / 2);
                array_push($cells, ($i === $middle ? 1 : 0));
            } else {
                array_push($cells, rand(0, static::$states - 1));
            }
        }

        return $cells;
    }

    /**
     * Calculate the state of a new cell according to the parent cell and its neighbours.
     *
     * @param $currentLine {array}: current state of the cells
     * @param $position    {int}: index of the array, 0 < i < a.length
     *
     * @return int 0|1  or  0|1|2
     */
    public function newCell($currentLine, $position): int
    {
        // 1st order: 1 line
        $len = count($currentLine);
        if (0 === $position) { // first
            $n = $currentLine[$len - 1] * 100 + $currentLine[0] * 10 + $currentLine[1];
        } elseif ($position === $len - 1) { // last
            $n = $currentLine[$position - 1] * 100 + $currentLine[$position] * 10 + $currentLine[0];
        } else {
            $n = $currentLine[$position - 1] * 100 + $currentLine[$position] * 10 + $currentLine[$position + 1];
        }

        return $this->ruleArray[bindec($n)]; // number: 0 or 1
    }

    /**
     *    Generate new array.
     *
     * @param mixed $currentCells
     *
     * @return array at 't+1'
     */
    public function nextGeneration($currentCells): array
    {
        $newCells = [];
        for ($i = 0; $i < count($currentCells); ++$i) { // for each cell
            $newcellvalue = $this->newCell($currentCells, $i);
            array_push($newCells, $newcellvalue);
        }

        return $newCells;
    }

    /* *
     * WIP --- Generate a new generation for the 2nd order
     * @param $currentLine {}
     * @param $position {}
     * @param $t2 {}
     * @return int 0|1
     *
     public function nextGeneration2ndOrder($currentLine, $position, $t2) { // 2st order: 1 line
         $len = count($currentLine);
         if($position == 0) { // first
             $n = $currentLine[$len-1]*1000 + $currentLine[0]*100 + $currentLine[1]*10 + $t2;
         } else if ($position == $len-1) { // last
             $n = $currentLine[$position-1]*1000 +  $currentLine[$position]*100 + $currentLine[0]*10 + $t2;
         } else {
             $n = $currentLine[$position-1]*1000 + $currentLine[$position]*100 + $currentLine[$position+1]*10 + $t2;
         }
         return $this->rulenumber[bindec($n)];
     } //*/

    /**
     *  Generates the matrix of states.
     */
    public function generate()
    {
        $this->matrix = [$this->getFirstLine()];
        for ($line = 0; $line < $this->generationsNb; ++$line) {
            array_push(
                $this->matrix,
                $this->nextGeneration($this->matrix[$line])
            );
        }
    }

    /**
     * Draws the image from the matrix
     * background, and points.
     */
    public function draw()
    {
        imagefill($this->theImage, 0, 0, $this->theBgColor);
        for ($line = 0; $line < count($this->matrix); ++$line) {
            for ($cell = 0; $cell < count($this->matrix[$line]); ++$cell) {
                if (0 !== $this->matrix[$line][$cell]) {
                    $x1 = $cell * $this->pixelLength;
                    $y1 = $line * $this->pixelLength;
                    $x2 = $x1 + $this->pixelLength - 1;
                    $y2 = $y1 + $this->pixelLength - 1;
                    if ($this->pixelLength > 1) {
                        imagefilledrectangle(
                            $this->theImage,
                            $x1,
                            $y1,
                            $x2,
                            $y2,
                            $this->getColorFromNumber($this->matrix[$line][$cell])
                        );
                    } else {
                        imagesetpixel(
                            $this->theImage,
                            $cell,
                            $line,
                            $this->getColorFromNumber($this->matrix[$line][$cell])
                        );
                    }
                }
            }
        }
    }

    /**
     * Displays the image.
     */
    public function display()
    {
        header('Content-Type: image/png');
        header('Cache-Control: no-cache');
        header('Hello: you found the header. Hi!');
        header('Content-Disposition: inline; filename="Rule'.$this->ruleNumber.'.png"');
        imagepng($this->theImage);
    }

    /**
     * @param int $number the "index" of the number
     */
    protected function getColorFromNumber(int $number)
    {
        switch ($number) {
            case 1: return $this->theColor;
            case 2: return $this->theColor2;
            case 3: return $this->theColor3;
            default: return $this->theBgColor;
        }
    }
}
