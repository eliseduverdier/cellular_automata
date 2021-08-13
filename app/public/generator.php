<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Cellular Automata — 2 states — generator</title>
    <link href="../../data/lib/reset.css" rel="stylesheet" type="text/css" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="icon" type="image/png" href="img/favicon.png" />
</head>

<body>

    <?php include 'includes/nav.php' ?>

    <main>
        <form class="display" id="display" method="get" action="">
            <fieldset class="sizes">
                <fieldset>
                    <div class="input-group">
                        <label for="state">orders</label>
                        <input type="number" name="o" id="orders" size="5" value="1" min="1" max="2" placeholder="1" />
                    </div>
                    |
                    <div class="input-group">
                        <label for="state">states</label>
                        <input type="number" name="s" id="states" size="5" value="2" min="2" max="9" placeholder="2" />
                    </div>
                </fieldset>

                <fieldset>
                    <div class="input-group">
                        <label for="rule">rule #</label>
                        <input type="number" name="r" id="rule" size="5" value="" min="0" max="256" placeholder="N" />
                    </div>
                    <div class="input-group">
                        or <input type="checkbox" name="random" id="random" /><label for="random">random</label>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="input-group">
                        <label for="width">width:</label> <input type="number" name="w" id="width" size="5" value="300" min="0" max="1000" placeholder="N" />
                    </div>
                    <div class="input-group">
                        <label for="height">height:</label> <input type="number" name="h" id="height" size="5" value="300" min="0" max="1000" placeholder="N" />
                    </div>
                    <div class="input-group">
                        <label for="scale">pixel:</label> <input type="number" name="p" id="scale" size="5" value="5" min="1" max="8" placeholder="N" />
                    </div>
                </fieldset>

                <fieldset>
                    <input type="checkbox" name="start" id="randomstart" checked />
                    <label for="randomstart"> random first line</label>
                </fieldset>
            </fieldset>

            <fieldset id="colors">
                <legend>colors</legend>
                <input type="color" name="c0" value="#f5cb5c" id="color0" />
                <input type="color" name="c1" value="#e8eddf" id="color1" />
                <input type="color" id="color-template" hidden />
            </fieldset>

            <fieldset class="submit">
                <fieldset>
                    <input class="submit" type="submit" value="Go !" />
                    <input class="reset" type="reset" value="reset" />
                </fieldset>
            </fieldset>
        </form>

        <section id="image"><img src="" /></section>
    </main>

    <?php include 'includes/footer.html' ?>

    <script type="text/javascript" src="js/init.js"></script>
    <script type="text/javascript" src="js/colorsInputs.js"></script>
    <script type="text/javascript" src="js/ruleChooser.js"></script>
    <script type="text/javascript" src="js/imageDisplay.js"></script>
</body>

</html>
