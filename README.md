# Cellular automata

Image or text rendering of {2→9}-states cellular automata.

## [Use here](https://eliseduverdier.fr/cellular_automata/app/public/generator.php)

* ` GET /cellular_automata/img.php  ? s=2 & ...`
* ` GET /cellular_automata/text.php ? s=8 & ...`

| parameter name | shortcut | does |
|--------------|-------|---|
| states       | s     | The number of states (2 to 9)  |
| order        | o     | The order (`1` or `2`) |
| width        | w     | The width in pixels    |
| height       | h     | The height in pixels   |
| pixel_size   | p     | A cell size in pixels  |
| rule_number  | n     | The rule number or `random` ( `{0 → 256}` for 2 states, `{0 → 134217728}` for 3, etc) (try `110` or `73` for 2 states) |
| random_start | start | The first line is random or a single centered point |
| color0       | bg    | The base color         |
| color1       | c1    | The first color        |
| color2       | c2    | The second color       |
| color3       | c3    | The third color, etc   |

All parameters are optional, default are defined for everything

<img src="_design/screenshots/v3.png" width="300" title="Generator for the four–states automata">

## How to use locally
From the folder, launch `php -S localhost:1234` and go to that url. Needs PHP8 (WIP: will run on docker later)

## The code
That was my first personal project as a brand new developer :) The code was therefore very minimalist (if not plain dirty).

I'm occasionaly trying to keep it in shape and adding new features. The only rule is no external library.

## TODO
- [] Add docker
- [] Add tests

## Last changes ([see all](CHANGELOG.mg))
### [4.0] - 2021-08-13
- Added second order + some refactos

### [3.3] - 2021-05-04
- Single page to generate all states, loaded in javascript

### [3.2] - 2021-04-23
- Added a text renderer
- Optimize the defaults parameters management
- Cleaned the computation in `CellularAutomata`

## Todo
- Clean routes and templates
- Add a 2nd order generator (using also the nth-1 line)
- Clean the code, always
