<?php

namespace tests\lib;

class Assert
{
    static private $PLAYED_COUNT = 0;
    static private $FAILED_COUNT = 0;
    static private $PASSED_COUNT = 0;

    public static function throwsException($value, $message = null)
    {
        try {
            self::error($message ?? 'Didn’t throw exception');
        } catch (\Throwable $e) {
            self::success();
        }
    }

    public static function true($value, $message = null)
    {
        if ($value !== true) {
            self::error($message ?? 'Expected true');
        } else {
            self::success();
        }
    }

    public static function false($value, $message = null)
    {
        if ($value !== false) {
            self::error($message ?? 'Expected false');
        } else {
            self::success();
        }
    }
    /// Types

    public static function isInteger($value, $message = null)
    {
        if (!is_numeric($value)) {
            self::error($message ?? 'Expected a int');
        } else {
            self::success();
        }
    }

    public static function isString($value, $message = null)
    {
        if (!is_string($value)) {
            self::error($message ?? 'Expected a string');
        } else {
            self::success();
        }
    }

    public static function isArray($value, $message = null)
    {
        if (!is_array($value)) {
            self::error($message ?? 'Expected an array');
        } else {
            self::success();
        }
    }

    public static function isNull($value, $message = null)
    {
        if ($value !== null) {
            self::error($message ?? 'Expected nulll');
        } else {
            self::success();
        }
    }
    /// Comparisons

    public static function isEqual($value1, $value2, $message = null)
    {
        if ($value1 !== $value2) {
            self::error($message ?? 'Expected values to be equal');
        } else {
            self::success();
        }
    }

    public static function isSame($value1, $value2, $message = null)
    {
        if (json_encode($value1) != json_encode($value2)) {
            self::error($message ?? 'Expected values to be identical');
        } else {
            self::success();
        }
    }

    public static function hasKey($array, $value, $message = null)
    {
        if (!array_key_exists($value, $array)) {
            self::error($message ?? "Expected array to have key $value");
        } else {
            self::success();
        }
    }

    public static function contains($value, $subValue, $message = null)
    {
        if (strpos($value, $subValue) === false) {
            self::error($message ?? "Expected to find $subValue");
        } else {
            self::success();
        }
    }

    public static function start()
    {
    }

    public static function end()
    {
        echo PHP_EOL;
        echo PHP_EOL . self::$PLAYED_COUNT . ' tests played';
        echo PHP_EOL . self::$PASSED_COUNT . ' tests passed';
        echo PHP_EOL . self::$FAILED_COUNT . ' tests failed';
        echo PHP_EOL;
    }

    protected static function success()
    {
        SELF::$PLAYED_COUNT++;
        SELF::$PASSED_COUNT++;
        echo '✓';
    }
    protected static function error($message)
    {
        SELF::$PLAYED_COUNT++;
        SELF::$FAILED_COUNT++;
        echo PHP_EOL . '✗ ' . $message . PHP_EOL;
    }
}
