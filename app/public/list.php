<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="Cellular Automata Generator and List">
    <meta name="author" content="Élise Duverdier">

    <title>Cellular Automata — 2 states — list</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/favicon.png" />
</head>

<body>

    <?php include 'includes/nav.php' ?>

    <?php
    $states = (isset($_GET['s'])) ? (int) $_GET['s'] : 2;
    $from = (isset($_GET['start'])) ? (int) $_GET['start'] : 0;
    $order = (isset($_GET['o'])) ? (int) $_GET['o'] : 1;
    $randomStart = (isset($_GET['rs'])) ? (int) $_GET['rs'] : 0;
    $to = $states === 2 && $order === 1 ? 256 : 1000;
    ?>

    <main>
        <h1>cellular automata — <?= $states ?> states — order <?= $order ?></h1>

        <h2>start from random line (<?= $from ?> → <?= $from + $to ?>)</h2>

        <p> Also try
            <a href="?o=<?= $order===1?2:1 ?>">Order <?= $order===1?2:1 ?></a>,
            <a href="?rs=<?= $randomStart===1?0:1 ?>"><?= $randomStart?'single point first line':'random first line' ?></a>,
            <a href="?s=<?= $states+1 ?>">N+1 states</a>,
        </p>

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
