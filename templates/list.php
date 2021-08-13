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

    <?php include 'includes/nav.php' ?>

    <?php
    $states = (isset($_GET['s'])) ? (int) $_GET['s'] : 2;
    $start = (isset($_GET['start'])) ? (int) $_GET['start'] : 0;
    $order = (isset($_GET['o'])) ? (int) $_GET['o'] : 1;
    $randomStart = (isset($_GET['rs'])) ? (int) $_GET['rs'] : 0;
    ?>

    <main>
        <h1>cellular automata — <?= $states ?> states — order <?= $order ?></h1>
        <?php /** Constants */
        $from = $start;
        $to = $states === 2 ? 256 : 1000;
        ?>

        <h2>start from random line (<?= $start ?> → <?= $from + $to ?>)</h2>

        <?php
        for ($i = $from; $i < $from + $to; ++$i) {
            echo "
        <div class=img>
            <img src='../img.php?s=$states&r=$i&w=90&h=90&p=1&o=$order&start=$randomStart'>
            $i
        </div>
        ";
        }
        ?>
    </main>
</body>

</html>
