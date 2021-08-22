<?php

namespace tests;

require_once dirname(__DIR__) . '/init.php';

class CellularAutomataTest // extends Test
{
    public function testMatrix()
    {
        $actual = (new \App\Infra\CellularAutomata(
            2,     // states
            1,     // order
            110,   // rule
            false, // hasRandomStart
            10,    // width
            10,    // height
            2      // pixelSize
        ))->getMatrix();
        $expected = [
            [0, 0, 1, 0, 0],
            [0, 1, 1, 0, 0],
            [1, 1, 1, 0, 0],
            [1, 0, 1, 0, 1],
            [1, 1, 1, 1, 1],
            [0, 0, 0, 0, 0]
        ];

        lib\Assert::isArray($actual);
        lib\Assert::isEqual($actual, $expected);
    }
}
