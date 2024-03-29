<?php

namespace App\Util;

use Config\Defaults;

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
    public function getRule(): ?int
    {
        $rule = $this->get('r') ?? $this->get('rule');

        return is_numeric($rule) ? $rule : null;
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

    // ---------------- Appearance

    /**
     * @return bool true (s=1|on) for random start, false (s=0|null) for centered single point
     */
    public function getRandomStart(): bool
    {
        return !empty($this->get('start'));
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
