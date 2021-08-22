<?php

namespace tests;

class Test
{
    protected $classNames = [
        CellularAutomataTest::class,
    ];

    public function runTests()
    {
        \tests\lib\Assert::start();


        $this->runAllTests();


        \tests\lib\Assert::end();
    }

    protected function runAllTests()
    {
        foreach ($this->classNames as $className) {
            $methods = get_class_methods($className);

            foreach ($methods as $method) {
                (new $className)->$method();
            }
        }
    }
}
