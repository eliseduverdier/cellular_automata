<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Cellular Automata — 2 states — generator</title>
    <link href="../../data/lib/reset.css" rel="stylesheet" type="text/css" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="icon" type="image/png" href="/data/img/icons/favicon.png" />
</head>

<body>

    <?php include 'includes/nav.php' ?>

    <main>
        <form class="display" action="../img.php" target="displayFrame" method="get">
            <fieldset class="sizes">
                <fieldset>
                    <div class="input-group">
                        <label for="state">states</label>
                        <input type="number" name="s" id="state" value="" min="2" max="9" placeholder="2" />
                    </div>
                    <div class="input-group">
                        <label for="rule">rule #</label>
                        <input type="number" name="r" id="rule" value="" min="0" max="256" placeholder="N" />
                    </div>
                    <div class="input-group">
                        or <input type="checkbox" name="random" id="random" /><label for="random">random</label>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="input-group">
                        <label for="width">width:</label> <input type="number" name="w" id="width" value="300" min="0" max="1000" placeholder="N" />
                    </div>
                    <div class="input-group">
                        <label for="height">height:</label> <input type="number" name="h" id="height" value="300" min="0" max="1000" placeholder="N" />
                    </div>
                    <div class="input-group">
                        <label for="scale">pixel:</label> <input type="number" name="p" id="scale" value="5" min="1" max="8" placeholder="N" />
                    </div>
                </fieldset>

                <fieldset>
                    <input type="checkbox" name="start" id="randomstart" />
                    <label for="randomstart"> single point on first line</label>
                </fieldset>
            </fieldset>
            <fieldset class="colors">
                <fieldset>
                    <div class="input-group">
                        <label for="color0">color 1</label> <input type="color" name="c0" value="#000000" id="color0" />
                        <br />
                    </div>
                    <div class="input-group">
                        <label for="color1">color 2</label>
                        <input type="color" name="c1" value="#ffffff" placeholder="#ffffff" id="color1" />
                    </div>
                </fieldset>
            </fieldset>
            <fieldset class="submit">
                <fieldset>
                    <input class="submit" type="submit" value="Go !" />
                    <input class="reset" type="reset" value="reset" />
                </fieldset>
            </fieldset>
        </form>

        <iframe src="../img.php?s=2&w=300&h=300&p=5" height="500" name="displayFrame"> </iframe>
    </main>

    <?php include 'includes/footer.html' ?>

    <script type="text/javascript">
        document.querySelector('input[name="random"]').addEventListener("change", function() {
            document.querySelector('label[for="rule"]').setAttribute(
                'style',
                'text-decoration: ' + (this.checked ? 'line-through' : 'none') + ';'
            );
        });
    </script>
</body>

</html>