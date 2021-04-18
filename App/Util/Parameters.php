<?php

namespace App\Util;

use App\Config\ParametersDefaults;

class Parameters
{
    // Automata main data
    public function getStates(): int
    {
        return $this->get('s') ?? $this->get('states', ParametersDefaults::DEFAULT_STATES);
    }
    public function getOrder(): int
    {
        return $this->get('o') ?? $this->get('order', ParametersDefaults::DEFAULT_ORDER);
    }

    /**
     * @return int|string The rule number or 'random'
     */
    public function getRule()
    {
        return $this->get('r') ?? $this->get('rule', ParametersDefaults::DEFAULT_RULE);
    }

    // Size
    public function getWidth(): int
    {
        return $this->get('w') ?? $this->get('width', ParametersDefaults::DEFAULT_WIDTH);
    }
    public function getHeight(): int
    {
        return $this->get('h') ?? $this->get('height', ParametersDefaults::DEFAULT_HEIGHT);
    }
    public function getPixelSize(): int
    {
        return $this->get('p') ?? $this->get('pixel_size', ParametersDefaults::DEFAULT_PIXEL_SIZE);
    }

    /**
     * @return bool true for random start, false for centered single point
     */
    public function getRandomStart(): bool
    {
        return (bool) $this->get('start', ParametersDefaults::DEFAULT_RANDOM_START);
    }

    /**
     * Colors of the cells
     * @return array [bg, color1, ...]
     */
    public function getColors(): array
    {
        $colors = [
            $this->get('bg') ?? $this->get('color0', ParametersDefaults::DEFAULT_BGCOLOR),
        ];

        $i = 0;
        while ($i < $this->getStates()) {
            $colors[] = $this->get("c$i") ?? $this->get("color$i", ParametersDefaults::DEFAULT_COLORS[$i]);
            $i++;
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
