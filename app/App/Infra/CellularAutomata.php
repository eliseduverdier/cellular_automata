<?php

namespace App\Infra;

use Config\Defaults;
use App\Util\Debug;
use App\Domain\CellularAutomataInterface;
use App\Domain\DrawableInterface;
use Exception;

class CellularAutomata implements DrawableInterface, CellularAutomataInterface
{
    private $generationsNb;
    private $states;
    private $order;
    private $ruleNumber;
    private $ruleArray;
    private $columns;
    private $pixelSize;
    private $hasRandomStart;

    public function __construct(
        int $states,
        int $order,
        ?int $rule,
        bool $hasRandomStart,
        int $width,
        int $height,
        int $pixelSize
    ) {
        $this->setStates($states);
        $this->setOrder($order);

        $this->hasRandomStart = $hasRandomStart;
        $this->ruleNumber = $this->whichRule($rule);
        $this->ruleArray = $this->ruleToArray($this->ruleNumber);

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
            $matrix[] = $this->computeNextLine($matrix, $line);
        }

        return $matrix;
    }

    /**
     * Fill the first line with states, randomly or not.
     * @return array of 0s and 1s
     */
    protected function getFirstLine(): array
    {
        $totalColumns = $this->columns / $this->pixelSize;
        if ($this->hasRandomStart) {
            $cells = [];
            for ($i = 0; $i < $totalColumns; ++$i) {
                array_push($cells, rand(0, $this->states - 1));
            }
        } else {
            $cells = array_fill(0, $totalColumns, 0);
            // Fill intermediates colors like this [0001234321000]
            for ($i = 0; $i < $this->states; $i++) {
                $offset = $i - 1;
                $middle = (int) $totalColumns / 2;
                $cells[$middle + $offset] = $i;
                $cells[$middle - $offset] = $i; // sorry for assigning twice the middle dot, but keeping for clarity
            }
        }

        return $cells;
    }

    /**
     * @param array $matrix
     * @param int   $currentLine
     * @return array at 't+1'
     */
    protected function computeNextLine($matrix, $currentLineIndex): array
    {
        $lineLength = count($matrix[$currentLineIndex]);
        $newLine = [];
        for ($i = 0; $i < $lineLength; ++$i) {
            if ($this->order === 2 && $currentLineIndex > 1) {
                $newcellvalue = $this->newCell($matrix[$currentLineIndex], $i, $matrix[$currentLineIndex - 1]);
            } else {
                $newcellvalue = $this->newCell($matrix[$currentLineIndex], $i);
            }
            $newLine[] = $newcellvalue;
        }

        return $newLine;
    }
    /**
     * Calculate the state of a new cell according to the parent cell and its neighbours.
     *
     * @param array  $currentLine   Current state of the cells
     * @param int    $position      Index of the array, 0 < i < a.length
     * @param ?array $lineBefore    For order 2, the line before if it exists
     *
     * @return int Between 0..states-1
     */
    protected function newCell($currentLine, $position, $lineBefore = null): int
    {
        $len = count($currentLine);

        // handle diagonals cells on the sides : loop to the other side
        if (0 === $position) { // first
            $baseCells = [
                $currentLine[$len - 1] * 100,
                $currentLine[1]
            ];
        } elseif ($position === $len - 1) { // last
            $baseCells = [
                $currentLine[$position - 1] * 100,
                $currentLine[0]
            ];
        } else {
            $baseCells = [
                $currentLine[$position - 1] * 100,
                $currentLine[$position + 1]
            ];
        }
        // cell just above
        $baseCells[] = $currentLine[$position] * 10;

        if ($lineBefore) { // 2nd order: also add center cell from n-2 line
            $baseCells[] = $lineBefore[$position]*1000;

        }

        $index = base_convert(array_sum($baseCells), $this->states, 10);

        return (int) $this->ruleArray[$index];
    }


    // -------------------- RULES UTIL

    protected function computeMaxRule(int $states): int
    {
        return (int) ((pow(pow($states, $this->order+2), 3)) / 2) - 1;
    }

    /**
     * The index, when in base N, will represent the state of the three (or more, for order 2) current cells,
     *  and the value will represent the state of the resulting cell.
     * @param int $ruleNumber
     * @return array an "associative" array corresponding to the rule number
     */
    protected function ruleToArray(int $ruleNumber): array
    {
        // o cells with n possible states: n^o + 1
        $lengthOfRuleNumber = pow($this->states, $this->order + 2) + 1;

        $toBaseN = sprintf('%0' . $lengthOfRuleNumber . 's', base_convert($ruleNumber, 10, $this->states));

        return array_reverse(str_split(strval($toBaseN)));
    }

    /**
     * Returns a rule number, from the paramater or randomly.
     * @param ?int $rule
     * @return int
     * @throws \Exception if the ruleNumber is not compatible with the states/order
     */
    protected function whichRule(?int $rule): int
    {
        $maxRule = $this->computeMaxRule($this->states);

        if (!is_numeric($rule) || $rule < 1) {
            return rand(0, $maxRule);
        }
        $rule = (int) $rule;
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
     * @param int $columns
     * @param int $generationsNb
     * @param int $pixelSize
     * @return array column, generationsNb, pixelSize
     * @throws \Exception if the sizes are too big
     */
    protected function getSize(int $columns, int $generationsNb, int $pixelSize): array
    {
        if ($columns < 0 || $generationsNb < 0) {
            throw new Exception("Nope");
        }
        if ($columns > 3000 || $generationsNb > 3000) {
            throw new Exception("Size cannot be superior to 3000 (makes the server tired -_-)");
        }
        if ($pixelSize > 20) {
            throw new Exception("Pixel size should be <20");
        }
        if ((int) $pixelSize > 1) {
            $pixelSize = (int) $pixelSize;
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
        if ($order < 1 || $order > 2) {
            throw new Exception("Order can only be 1 or 2 (got $order)");
        }
        $this->order = $order;
    }
}
