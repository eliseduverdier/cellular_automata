<?php

namespace App\Infra;

use App\Config\Defaults;
use App\Domain\DrawableInterface;
use App\Util\Debug;
use Exception;
use Psr\Log\Test\DummyTest;

class CellularAutomata implements DrawableInterface
{
    /** @var int */
    protected $generationsNb;

    /** @var int */
    protected $ruleNumber;

    /** @var bool */
    protected $hasRandomStart;

    public function __construct(
        protected mixed $states = Defaults::STATES,
        protected mixed $order = Defaults::ORDER,
        protected mixed $rule = Defaults::RULE,
        protected mixed $randomStart = Defaults::RANDOM_START,
        protected mixed $width = Defaults::WIDTH,
        protected mixed $height = Defaults::HEIGHT,
        protected mixed $pixelSize = Defaults::PIXEL_SIZE,
    ) {
        $this->setStates($states);
        $this->setOrder($order);
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
            $matrix[] = $this->computeNextLine($matrix[$line]);
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
        return (int) ((pow(pow($states, 3), 3)) / 2) - 1;
    }

    /**
     * The index, when in binary (or base3+), will represent the state of the three current cells,
     *  and the number will represent the state of the resulting cell.
     * @param int $ruleNumber
     * @return array an "associative" array corresponding to the rule number
     */
    protected function ruleToArray(int $ruleNumber): array
    {
        // 3 cells with n possible states: n^3
        $toBaseN = sprintf('%0' . pow($this->states, 3) + 1 . 's', base_convert($ruleNumber, 10, $this->states));

        return array_reverse(str_split(strval($toBaseN)));
    }

    /**
     * Returns a rule number, from the paramater or randomly.
     * @param mixed $states
     * @return int
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
    protected function getSize(int $columns, int $generationsNb, int $pixelSize): array
    {
        if (intval($pixelSize) > 1) {
            $pixelSize = intval($pixelSize);
            $generationsNb /= $pixelSize;
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

    private function setStates(?int $states): void
    {
        if ($states < 2 || $states > 10) {
            throw new Exception("State must be between 2 and 10 (got $states)");
        }
        $this->states = $states;
    }

    private function setOrder(?int $order): void
    {
        if ($order !== 1) {
            throw new Exception("Order can only be 1 (got $order)");
        }
        $this->order = $order;
    }
}
