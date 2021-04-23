<?php

namespace App\Util;

use App\Config\Defaults;

class Parameters
{
    // ------------------ Automata main data
    public function getStates(): int
    {
        return $this->get('s') ?? $this->get('states', Defaults::STATES);
    }

    public function getOrder(): int
    {
        return $this->get('o') ?? $this->get('order', Defaults::ORDER);
    }

    /**
     * @return int|string The rule number or 'random'
     */
    public function getRule()
    {
        return $this->get('r') ?? $this->get('rule', Defaults::RULE);
    }

    // ---------------- Size
    public function getWidth(): int
    {
        return $this->get('w') ?? $this->get('width', Defaults::WIDTH);
    }
    public function getHeight(): int
    {
        return $this->get('h') ?? $this->get('height', Defaults::HEIGHT);
    }
    public function getPixelSize(): int
    {
        return $this->get('p') ?? $this->get('pixel_size', Defaults::PIXEL_SIZE);
    }

    // ---------------- Size
    /**
     * @return bool true for random start, false for centered single point
     */
    public function getRandomStart(): bool
    {
        return (bool) $this->get('start', Defaults::RANDOM_START);
    }

    /**
     * Colors of the cells
     * @return array [bg, color1, ...]
     */
    public function getColors(): array
    {
        for ($i = 0; $i < $this->getStates(); $i++) {
            $colors[] = $this->get("c$i") ?? $this->get("color$i", Defaults::COLORS[$i]);
        }

        return $colors;
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
