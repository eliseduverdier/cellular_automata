<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cellular Automata — 2 states — list</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="/data/img/icons/favicon.png">
    </head>
    <body>

<nav>
    <h1>elementary <br>cellular <br>automata</h1>
    <div>
        <div><a href="display.html">2 states</a> <a href="list.php" active>(list)</a></div>
        <div><a href="display_3states.php">3 states</a> <a href="list_3states.php">(list)</a></div>
        <div><a href="display_4states.php">4 states</a> <a href="list_4states.php">(list)</a></div>
    </div>
</nav>

<h1>cellular automata — rules 0 to 255</h1>
<?php /** Constants */
    $from = 0;
    $to = 256;
?>

<h2>start from random line</h2>

<?php
    for ($i = $from; $i < $to; ++$i) {
        echo '
        <a href="../lib/img.php?rule='.$i.'&width=400&height=200&pixel=3">
        <div class="img">
            <img src="../lib/img.php?rule='.$i.'&width=90&height=90">
            '.$i.'
        </div>
        </a>
        ';
    }
?>

<div class="clear"></div>

<h2>start from single point</h2>

<?php
for ($i = $from; $i < $to; ++$i) {
    echo '
        <a href="../lib/img.php?rule='.$i.'&width=400&height=200&randomstart=on&pixel=3">
        <div class="img">
            <img src="../lib/img.php?rule='.$i.'&width=80&height=80&randomstart=on">
            '.$i.'
        </div>
        </a>
        ';
}
?>
    </body>
</html>
