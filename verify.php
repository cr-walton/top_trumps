<?php

use Transformers\Utilities\DbUpdateFail;

require_once './vendor/autoload.php';

try {
    $db = new \PDO('mysql:host=db; dbname=transformers', 'root', 'password');
    $result = \Transformers\Hydrators\Hydrator::dbInsertWinner($db, $_POST['id'], $_POST['wins']);
    if (!$result) {
        header('location: index.php');
    } else {
        throw new DbUpdateFail('Data not updated');
    }
} catch (DbUpdateFail $e) {
    echo $e->getMessage();
}
