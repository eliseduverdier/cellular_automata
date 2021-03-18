<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cellular Automata — 4 states — generator</title>
    <link href="../../data/lib/reset.css" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >
    <link rel="icon" type="image/png" href="/data/img/icons/favicon.png">
</head>
<body>
<nav>
    <h1>elementary <br>cellular <br>automata</h1>
    <div>
        <div><a href="display.php">2 states</a> <a href="list.php">(list)</a></div>
        <div><a href="display_3states.php">3 states</a> <a href="list_3states.php">(list)</a></div>
        <div><a href="display_4states.php" active>4 states</a> <a href="list_4states.php">(list)</a></div>
    </div>
</nav>

<form class="display" action="../lib/img_4states.php" target="displayFrame" method="get">
    <fieldset class="sizes">
        <fieldset>
            <label for="rule">rule #</label><input type="number" name="rule" id="rule" value="" min="0" max="500000" placeholder="N">
            or <input type="checkbox" name="random" id="random"><label for="random">random</label>
        </fieldset>

        <fieldset>
            <label for="width">W:</label><input type="number" name="width" id="width" value="50" min="0" max="1000" placeholder="N">
            <label for="height">H:</label><input type="number" name="height" id="height" value="50" min="0" max="1000" placeholder="N">
        </fieldset>
        <fieldset>
            <label for="scale">pixel size:</label><input type="number" name="pixel" id="scale" value="5" min="1" max="8" placeholder="N">
        </fieldset>

        <fieldset>
            <input type="checkbox" name="randomstart" id="randomstart"><label for="randomstart">single point on first line</label>
        </fieldset>
    </fieldset>
    <fieldset class="colors">
        <fieldset>
            <label for="color">color 1</label><input type="color" name="color" value="#052e8f" id="color"> <br />
            <label for="bgcolor">color 2</label><input type="color" name="bgcolor" value="#00b3ff" id="bgcolor"> <br />
            <label for="color2">color 3</label><input type="color" name="color2" value="#eacb06" id="color2"><br>
            <label for="color3">color 4</label><input type="color" name="color3" value="#a40404" id="color3">
        </fieldset>
    </fieldset>
    <fieldset class="submit">
        <fieldset>
            <input class="submit" type="submit" value="Go !">
            <input class="reset" type="reset" value="reset">
        </fieldset>
</fieldset>
</form>

<iframe src="../lib/img_4states.php?random=on&width=50&height=50&pixel=5" height="500" name="displayFrame" border="0"></iframe>

<footer>
    CC (BY SA) Élise Duverdier 2015
</footer>

<script type="text/javascript">
document.querySelector('input[name="random"]').addEventListener('change', function() {
    document.querySelector('label[for="rule"]').setAttribute('style', 'text-decoration: '+(this.checked ? 'line-through': 'none')+';')
});
</script>
</body>
</html>
