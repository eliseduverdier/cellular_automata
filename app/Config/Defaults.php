<?php

namespace Config;

/**
 * Default parameters for the cellular automata
 */
class Defaults
{
    const STATES = 2;
    const ORDER = 1;
    const RULE = null;
    const RANDOM_START = false;

    const WIDTH = 300;
    const HEIGHT = 300;
    const PIXEL_SIZE = 3;

    // for ImageRenderer
    const COLORS = ["#242423", "#30d179", "#d4b483", "#c1666b", "#e4dfda", "#48a9a6", "#cfdbd5", "#e8eddf", "#731dd8", "#f5cb5c", "#333533"];
    // for TextRenderer
    const CHARACTERS = ['◉', '◌', '✻', '❁', '❖', '▦', '░', '·', '▓'];
}
