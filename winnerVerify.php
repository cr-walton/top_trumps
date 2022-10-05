<?php

use Transformers\Classes\Transformer;

session_start();
require_once './vendor/autoload.php';
if ($_POST['transformer1'] !== $_POST['transformer2']) {
    $db = new \PDO('mysql:host=db; dbname=transformers', 'root', 'password');
    $result = Transformers\Hydrators\Hydrator::comparisonHydrator($db, $_POST['transformer1'], $_POST['transformer2']);
    $winner = \Transformers\Classes\Transformer::pickWinner($result[0], $result[1]);
    $winner instanceof Transformer ? $_SESSION['winner'] = $winner->getName() : $_SESSION['winner'] = $winner;
    header("location: index.php");
} else {
    header("location: index.php?error=You can't use the same transformer");
}
