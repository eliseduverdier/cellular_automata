<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="Cellular Automata Generator and List">
    <meta name="author" content="Élise Duverdier">

    <title>Cellular Automata — 2 states — list</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/data/img/icons/favicon.png">
</head>

<body>

    <nav>
        <h1>elementary <br>cellular <br>automata</h1>
        <div>
            <div><a href="display.php">2 states</a> <a href="list.php" active>(list)</a></div>
            <div><a href="display3.php">3 states</a> <a href="list3.php">(list)</a></div>
            <div><a href="display4.php">4 states</a> <a href="list4.php">(list)</a></div>
        </div>
    </nav>

    <?php
    $states = (isset($_GET['s'])) ? (int) $_GET['s'] : 2;
    $start = (isset($_GET['start'])) ? (int) $_GET['start'] : 0;
    ?>

    <main>
        <h1>cellular automata — <?= $states ?> states</h1>
        <?php /** Constants */
        $from = $start;
        $to = $states === 2 ? 256 : 1000;
        ?>

        <h2>start from random line (<?= $start ?> → <?= $from + $to ?>)</h2>

        <?php
        for ($i = $from; $i < $from + $to; ++$i) {
            echo "
        <div class=img>
            <img src='../index.php?s=$states&r=$i&w=90&h=90&p=1'>
            $i
        </div>
        ";
        }
        ?>
    </main>
</body>

</html>