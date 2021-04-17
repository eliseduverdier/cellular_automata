<?php

namespace APP;

use APP\UI\DrawableInterface;

class CellularAutomata implements DrawableInterface
{
    const DEFAULT_STATES = 2;
    const DEFAULT_ORDER = 1;
    const DEFAULT_RULE = 'random';
    const DEFAULT_RANDOM_START = true;

    const DEFAULT_WIDTH = 100;
    const DEFAULT_HEIGHT = 100;
    const DEFAULT_PIXEL_SIZE = 3;

    /** @var int */
    protected $generationsNb;

    /** @var int */
    protected $ruleNumber;

    /** @var bool */
    protected $hasRandomStart;

    public function __construct(
        protected mixed $states = self::DEFAULT_STATES,
        protected mixed $order = self::DEFAULT_ORDER,
        protected mixed $rule = self::DEFAULT_RULE,
        protected mixed $randomStart = self::DEFAULT_RANDOM_START,
        protected mixed $width = self::DEFAULT_WIDTH,
        protected mixed $height = self::DEFAULT_HEIGHT,
        protected mixed $pixelSize = self::DEFAULT_PIXEL_SIZE,

    ) {
        $this->states = $states;
        $this->order = $order;
        $this->hasRandomStart = $randomStart;

        $this->ruleNumber = $this->whichRule($rule);
        $this->ruleArray = $this->ruleToArray($this->ruleNumber, $this->states);

        $size = $this->getSize($width, $height, $pixelSize);
        $this->columns = $size['columns'];
        $this->generationsNb = $size['generationsNb'];
        $this->pixelSize = $size['pixelSize'];
    }

    /**
     * @return array The whole object, encoded with numbers
     */
    public function getMatrix(): array
    {
        $matrix = [$this->getFirstLine()];
        for ($line = 0; $line < $this->generationsNb; ++$line) {
            array_push(
                $matrix,
                $this->computeNextLine($matrix[$line])
            );
        }
        return $matrix;
    }

    /**
     * Fill the first line with states, randomly or not.
     * @return array of 0s and 1s
     */
    protected function getFirstLine(): array
    {
        $cells = [];
        for ($i = 0; $i < ($this->columns / $this->pixelSize); ++$i) {
            if ($this->hasRandomStart) {
                array_push($cells, rand(0, $this->states - 1));
            } else {
                $middle = intval(($this->columns / $this->pixelSize) / 2);
                array_push($cells, ($i === $middle ? 1 : 0));
            }
        }

        return $cells;
    }

    /**
     *    Generate new array.
     * @param array $currentCells
     * @return array at 't+1'
     */
    protected function computeNextLine($currentLine): array
    {
        $newCells = [];
        for ($i = 0; $i < count($currentLine); ++$i) {
            $newcellvalue = $this->newCell($currentLine, $i);
            $newCells[] = $newcellvalue;
        }

        return $newCells;
    }
    /**
     * Calculate the state of a new cell according to the parent cell and its neighbours.
     *
     * @param $currentLine {array}: current state of the cells
     * @param $position    {int}: index of the array, 0 < i < a.length
     *
     * @return int 0|1  or  0|1|2
     */
    protected function newCell($currentLine, $position): int
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
        $index = base_convert($n, $this->states, 10);
        return $this->ruleArray[$index];
    }


    // -------------------- RULES UTIL

    protected function computeMaxRule(int $states): int
    {
        // TODO find the correct formula...
        switch ($states) {
            case 2:
                return 256; // 2 ** $states ** 3
            case 3:
                return 52486; // Should theorically be higher, but nothing interesting after that number
            case 4:
                return 500000; // approx. 274875000000;
            default:
                throw new \Exception(sprintf(
                    'Cannot process other states than 2, 3, 4 (%s given)',
                    $states
                ));
        }
    }

    /**
     * The index, when in bin[/trin]ary, will represent the state of the three current cells,
     *  and the number (0/1[/2]), will represent the state of the resulting cell.
     *
     * @param int $ruleNumber
     *
     * @return array an "associative" array corresponding to the rule number
     */
    protected function ruleToArray($ruleNumber): array
    {
        // 3 cells with n possible states: n^3
        $toBaseN = sprintf('%0' . pow($this->states, 3) + 1 . 'd', intval(base_convert($ruleNumber, 10, $this->states)));

        return array_reverse(str_split(strval($toBaseN)));
    }

    /**
     * Returns a rule number, from the paramater or randomly.
     *
     * @param int the number of states
     * @param mixed $states
     */
    protected function whichRule($rule): int
    {
        $maxRule = $this->computeMaxRule($this->states);

        if (!is_numeric($rule) || $rule < 1) {
            return rand(0, $maxRule);
        }
        $rule = intval($rule);
        if ($rule > $maxRule) {
            throw new \Exception(sprintf(
                'Cannot use rule #%d (max: %d)',
                $rule,
                $maxRule
            ));
        }

        return $rule;
    }

    /**
     * Returns the dimension of the final image, and the length of a pixel.
     * @param int $width
     * @param int $height
     * @param int $pixelSize
     * @return array column, generationsNb, pixelSize
     */
    protected function getSize(?int $columns, ?int $generationsNb, ?int $pixelSize): array
    {
        if (intval($pixelSize) > 1) {
            $pixelSize = intval($pixelSize);
            $columns *= $pixelSize;
            $generationsNb *= $pixelSize;
        } else {
            $pixelSize = 1;
        }

        return [
            'columns' => $columns,
            'generationsNb' => $generationsNb,
            'pixelSize' => $pixelSize,
        ];
    }

    public function getRuleNumber(): int
    {
        return $this->ruleNumber;
    }
}
