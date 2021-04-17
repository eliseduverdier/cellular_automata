<?php

namespace APP\Util;

class Parameters
{
    const DEFAULT_STATES = 2;
    const DEFAULT_ORDER = 1;
    const DEFAULT_RULE = 'random';
    const DEFAULT_RANDOM_START = true;

    const DEFAULT_WIDTH = 100;
    const DEFAULT_HEIGHT = 100;
    const DEFAULT_PIXEL_SIZE = 3;

    const DEFAULT_BGCOLOR = '#FFFFFF';
    const DEFAULT_COLOR1 = '#000000';
    const DEFAULT_COLOR2 = '#EACB06';
    const DEFAULT_COLOR3 = '#A40404';

    public function getStates()
    {
        return $this->get('s') ?? $this->get('states', self::DEFAULT_STATES);
    }

    public function getOrder()
    {
        return $this->get('o') ?? $this->get('order', self::DEFAULT_ORDER);
    }
    public function getRule()
    {
        return $this->get('r') ?? $this->get('rule', self::DEFAULT_RULE);
    }


    public function getWidth()
    {
        return $this->get('w') ?? $this->get('width', self::DEFAULT_WIDTH);
    }
    public function getHeight()
    {
        return $this->get('h') ?? $this->get('height', self::DEFAULT_HEIGHT);
    }
    public function getPixelSize()
    {
        return $this->get('p') ?? $this->get('pixel_size', self::DEFAULT_PIXEL_SIZE);
    }

    /**
     * @return bool true for random start, false for centered single point
     */
    public function getRandomStart()
    {
        return $this->get('start', self::DEFAULT_RANDOM_START);
    }

    /**
     * @return array [bg, color1, ...]
     */
    public function getColors(): array
    {
        return [
            $this->get('bg') ?? $this->get('color0', self::DEFAULT_BGCOLOR),
            $this->get('c1') ?? $this->get('color1', self::DEFAULT_COLOR1),
            $this->get('c2') ?? $this->get('color2', self::DEFAULT_COLOR2),
            $this->get('c3') ?? $this->get('color3', self::DEFAULT_COLOR3),
        ];
    }

    /**
     * Returns the parameter from $_GET
     * @param string $parameterName
     * @param mixed $default
     * @return mixed
     */
    protected function get(string $parameterName, $default = null)
    {
        return array_key_exists($parameterName, $_GET)
            ? $_GET[$parameterName]
            : $default;
    }
}
