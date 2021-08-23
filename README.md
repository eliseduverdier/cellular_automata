# Cellular automata

Image or text rendering of {2→9}-states cellular automata.

## [Use here](https://eliseduverdier.fr/cellular_automata/)

- ` GET /cellular_automata/img.php ? s=2 & ...`
- ` GET /cellular_automata/text.php ? s=8 & ...`

| parameter name | shortcut | defines                                                                                                                |
| -------------- | -------- | ---------------------------------------------------------------------------------------------------------------------- |
| states         | s        | The number of states (2 to 9)                                                                                          |
| order          | o        | The order (`1` or `2`)                                                                                                 |
| width          | w        | The width in pixels                                                                                                    |
| height         | h        | The height in pixels                                                                                                   |
| pixel_size     | p        | A cell size in pixels                                                                                                  |
| rule_number    | n        | The rule number or `random` ( `{0 → 256}` for 2 states, `{0 → 134217728}` for 3, etc) (try `110` or `73` for 2 states) |
| random_start   | start    | The first line is random or a single centered point                                                                    |
| color0         | bg       | The base color                                                                                                         |
| color1         | c1       | The first color                                                                                                        |
| color2         | c2       | The second color                                                                                                       |
| color3         | c3       | The third color, etc                                                                                                   |

All parameters are optional, default are defined for everything

### The App

<img src="_design/screenshots/v4.png" width="400" title="Generator for the four–states automata">

## How to use locally

From the folder, launch `php -S localhost:1234` and go to that url. Needs PHP8 (WIP: will run on docker later)

### Run tests

`php app/tests.php`

## The code

That was my first personal project as a brand new developer :) The code was therefore very minimalist (if not plain dirty).

I'm occasionaly trying to keep it in shape and adding new features. _The only rule is no framework, no external library, as much from scratch as possible_.

## TODO

- [x] Add more than 2 states
- [x] Make a text automata
- [x] Add 2nd order
- [ ] Add docker
- [x] Add tests

## Last changes ([see all](CHANGELOG.mg))

### [4.2] - 2021-08-23

- New UI

# Images

### First order

**2 states**

<img src="_design/automata/order1/s2-Rule101.png" height=200 title="Rule 110"> <img src="_design/automata/order1/s2-Rule110.png" height=200 title="Rule 110"> <img src="_design/automata/order1/s2-Rule18.png" height=200 title="Rule 18"> <img src="_design/automata/order1/s2-Rule210.png" height=200 title="Rule 210"> <img src="_design/automata/order1/s2-Rule73.png" height=200 title="Rule 73">

**3 states**

<img src="_design/automata/order1/s3-Rule2059a.png" height=200 title="Rule 2059a"> <img src="_design/automata/order1/s3-Rule2059b.png" height=200 title="Rule 2059b"> <img src="_design/automata/order1/s3-Rule2059.png" height=200 title="Rule 2059"> <img src="_design/automata/order1/s3-Rule4480.png" height=200 title="Rule 4480"> <img src="_design/automata/order1/s3-Rule5404.png" height=200 title="Rule 5404"> <img src="_design/automata/order1/s3-Rule5465.png" height=200 title="Rule 5465"> <img src="_design/automata/order1/s3-Rule910.png" height=200 title="Rule 910">

**5 states**

<img src="_design/automata/order1/s5-Rule161727.png" height=200 title="Rule 161727">

### Second order

**2 states**

<img src="_design/automata/order2/Rule150.png" height=200 title="Rule 150"> <img src="_design/automata/order2/Rule18.png" height=200 title="Rule 18"> <img src="_design/automata/order2/Rule227.png" height=200 title="Rule 227"> <img src="_design/automata/order2/Rule73.png" height=200 title="Rule 73">

**5 states**

<img src="_design/automata/order2/s5-Rule119545276.png" height=200 title="Rule 119545276"> <img src="_design/automata/order2/s5-Rule66133019.png" height=200 title="Rule 66133019">

## Bonus

```
◌◌✻✻◉◌◌✻◉✻◌◌◌◌✻◌◉◌◉◉◌✻✻✻◉◌✻✻◌✻◌✻◉◉◉◉✻◌◌◌✻◉◌◉◌◌◌◌◌◉◉✻◌◌✻◉✻✻◉✻◌◌◌◌✻✻✻
◉◉◉◉◉◌◉◉◉◌◉◉◉◉◉◉◉◌◉✻◉◉◉◉◉◉◉◉◉◉◉◉◉◌◌◉◌◉◉◉◉◉◌◉◌◉◉◉◉◉◉◌◉◉◉◉◌◉◉◌◉◉◉◉◉◉◉
◌◌◌◌✻◌◉◌✻◌◉◌◌◌◌◌✻◌◉◉◉◌◌◌◌◌◌◌◌◌◌◌✻◌◉◉◌◉◌◌◌✻◌◉◌◉◌◌◌◌✻◌◉◌◌✻◌◉✻◌◉◌◌◌◌◌◌
◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◉◌✻◌◉◉◉◉◉◉◉◉◉◉◉◉◉✻◌◉◌◉◉◉◉◉◌◉◌◉◉◉◉◉◉◌◉◉◉◉◌◉◉◌◉◉◉◉◉
◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌◌✻◉◉◉◉◌◌◌◌◌◌◌◌◌◌◌◉◌◉◉◌◉◌◌◌✻◌◉◌◉◌◌◌◌✻◌◉◌◌✻◌◉✻◌◉◌◌◌◌
◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌◉◌◉◉◉◉◉◉◌◉◉◉◉◌◉◉◌◉◉◉
◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌◉◌◉◌◌◌◌✻◌◉◌◌✻◌◉✻◌◉◌◌
◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌◉◌◉◉◉◉◉◉◌◉◉◉◉◌◉◉◌◉
◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌◉◌◉◌◌◌◌✻◌◉◌◌✻◌◉✻◌◉
◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌◉◌◉◉◉◉◉◉◌◉◉◉◉◌◉◉
◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌◉◌◉◌◌◌◌✻◌◉◌◌✻◌◉✻
◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌◉◌◉◉◉◉◉◉◌◉◉◉◉◌
◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌◉◌◉◌◌◌◌✻◌◉◌◌✻◌
◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌◉◌◉◉◉◉◉◉◌◉◉◉
✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌◉◌◉◌◌◌◌✻◌◉◌◌
◉◉◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌◉◌◉◉◉◉◉◉◌◉
◌◌✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌◉◌◉◌◌◌◌✻◌◉
◌◉◉◉◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌◉◌◉◉◉◉◉◉
◌◉◌◌✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌◉◌◉◌◌◌◌✻
◉◉◌◉◉◉◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌◉◌◉◉◉◉
◌✻◌◉◌◌✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌◉◌◉◌◌◌
◉◉◉◉◌◉◉◉◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌◉◌◉◉
◌◌◌✻◌◉◌◌✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌◉◌◉◌
◉◉◉◉◉◉◌◉◉◉◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌◉◌
◉◌◌◌◌✻◌◉◌◌✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌◉◌
◉◌◉◉◉◉◉◉◌◉◉◉◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉◉◌
◉◌◉◌◌◌◌✻◌◉◌◌✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌✻◌
◉◌◉◌◉◉◉◉◉◉◌◉◉◉◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉◉◉
✻◌◉◌◉◌◌◌◌✻◌◉◌◌✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌◌◌
◉◉◉◌◉◌◉◉◉◉◉◉◌◉◉◉◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌◉◉
◌◌✻◌◉◌◉◌◌◌◌✻◌◉◌◌✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌◉◌
◉◉◉◉◉◌◉◌◉◉◉◉◉◉◌◉◉◉◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌◉◌
◉◌◌◌✻◌◉◌◉◌◌◌◌✻◌◉◌◌✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉◉◌
◉◌◉◉◉◉◉◌◉◌◉◉◉◉◉◉◌◉◉◉◉◌◉◉◌◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◉◌◉◉◉◉◉◉◌◌✻◌◉◉◉◉◉◉◉◉◉◉◉◌◉✻◌
◉◌◉◌◌◌✻◌◉◌◉◌◌◌◌✻◌◉◌◌✻◌◉✻◌◉◌◌◌◌◌◌◌◌◌◌◌◌◌◌✻◌◉◌◌◌◌✻◌◉◉◉◉◌◌◌◌◌◌◌◌◌✻◌◉◌◉
```
