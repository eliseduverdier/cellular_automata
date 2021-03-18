# Cellular automata

Image generation of 2, 3, 4 states cellular automata.

## [Use here](http://eliseduverdier.fr/cellular_automata/)

Parameters ([if used as an API](http://eliseduverdier.fr/cellular_automata/img/)):
  * `rule`: The rule number ( {int, 0 → 256} or {0 → 134217728} for 3-states)
  * `width` and `height`: Dimension in pixel of the image
  * `pixel`: Size in pixel of one square
  * `color`, `bgcolor`: Colors used for the states ({#nnnnnn (0-f) | rbg(n,n,n) (0-255)},
  * `color1`, `color2`: are also used for 3 and 4 states
  * `randomstart`: If the first line composed of random points, or just is a single centered point. ({int} 1 (default) for random start, 0 for single point)

<img src="screenshots/v3.png" width="400px" title="Generator for the four–states automata">

## The code
That was my first personal project as a brand new developer :) The code was therefore very ~minimalist~.

I'm occasionaly trying to keep it in shape and adding new features.

## Todo
- Clean routes
- Add a 2nd order generator (using also the nth-1 line)
- Clean the code, always

## Changelog
### [3.0] - 2021-03-10
- Another refactoring

### [2.0] - 2016-10-20
- Class refactoring

### [1.1] - 2016-30-30
- Added presentation page

### [1.0] - 2016-30-20
- Updated project.
