<?php
session_start();


use Transformers\Utilities\DbUpdateFail;

require_once './vendor/autoload.php';

try {
    $db = new \PDO('mysql:host=db; dbname=transformers', 'root', 'password');
    $transformers = \Transformers\Hydrators\Hydrator::transformerHydrator($db);
    $topTrumps = \Transformers\Classes\Transformer::randomTransformers($transformers);
    $result = \Transformers\Hydrators\Hydrator::dbUpdatePlayed($db, $topTrumps[0]->getId(), $topTrumps[1]->getId());
    $winners = \Transformers\Classes\Transformer::winRatioForEach($transformers);
    $topTrumpsDisplayHTML = \Transformers\ViewHelpers\Display::displayTopTrumps($topTrumps);
    asort($winners);
    $leaders = array_reverse(array_slice($winners, 25));
} catch (DbUpdateFail $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo 'There has been a problem';
}
if (isset($_SESSION['winner'])) {
    $duelWinner = $_SESSION['winner'];
    unset($_SESSION['winner']);
} else {
    $duelWinner = '';
    unset($_SESSION['winner']);
}

?>

<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Top Trumps</title>
</head>

<body>
    <div class='container'>
        <div class='row text-center my-3'>
            <h1>Top Trumps: Transformers</h1>
        </div>
        <div class='row mt-2'>
            <section class='container  d-flex justify-content-evenly'>
                <?php echo $topTrumpsDisplayHTML; ?>
            </section>
        </div>
        <section class="row container text-center my-5">
            <form method='post' action='winnerVerify.php'>
                <div>
                    <select name='transformer1' id='transformer1' class="mx-1 form-select-sm">
                        <?php echo \Transformers\ViewHelpers\Display::getOptionList($transformers); ?>
                    </select>
                    <select name='transformer2' id='transformer2' class="mx-1 form-select-sm">
                        <?php echo \Transformers\ViewHelpers\Display::getOptionList($transformers); ?>
                    </select>
                </div>
                <button type='submit' class='btn btn-danger mt-3'>Who would win?</button>
            </form>
            <div>
                <h3><?php echo $duelWinner ?></h3>
            </div>
        </section>
        <div class='row my-5 text-center'>
            <h2>Leaderboard</h2>
            <section class='d-flex align-items-center justify-content-center'>
                <div class='col-4 d-flex justify-content-center'>
                    <img src='https://tfwiki.net/mediawiki/images2/8/8f/Laserrave.gif'>
                </div>
                <div class='col-4'>
                    <?php echo \Transformers\ViewHelpers\Display::displayLeaderboard($leaders); ?>
                </div>
                <div class='col-4 d-flex justify-content-center'>
                    <img height='215' src='https://blog.lootcrate.com/wp-content/uploads/2017/01/bonk_transformers.gif'>
                </div>

            </section>
        </div>
    </div>
</body>

</html>