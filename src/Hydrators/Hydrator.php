<?php

namespace Transformers\Hydrators;

use \Transformers\Classes\Transformer;

class Hydrator
{
    public static function transformerHydrator(\PDO $db)
    {
        $query = $db->prepare("SELECT `id`, `name`, `size`, `speed`, `power`, `disguise`, `top_trumps_rating`, `type`, `img_url`, `wins`, `played` FROM `characters`;");
        $query->setFetchMode(\PDO::FETCH_CLASS, Transformer::class);
        $query->execute();
        return $query->fetchAll();
    }

    public static function dbUpdatePlayed(
        \PDO $db,
        string $id,
        string $id2
    ) {
        $query = $db->prepare("UPDATE `characters` SET `played` = `played` + 1 WHERE `id` IN (:id, :id2);");
        $query->bindParam(':id', $id);
        $query->bindParam(':id2', $id2);
        return $query->execute();
    }

    public static function dbInsertWinner(
        \PDO $db,
        string $id
    ): void {
        $query = $db->prepare("UPDATE `characters` SET `wins` = `wins` + 1 WHERE `id` = :id;");
        $query->bindParam(':id', $id);
        if (!$query->execute()) {
            throw new DbInsertFail('Database not updated');
        }
    }

    public static function comparisonHydrator(
        \PDO $db,
        $name1,
        $name2
    ) {
        $query = $db->prepare("SELECT `id`, `name`, `size`, `speed`, `power`, `disguise`, `top_trumps_rating`, `type`, `img_url`, `wins`, `played` FROM `characters` WHERE `name` IN (:name1, :name2);");
        $query->setFetchMode(\PDO::FETCH_CLASS, Transformer::class);
        $query->bindParam(':name1', $name1);
        $query->bindParam(':name2', $name2);
        $query->execute();
        return $query->fetchAll();
    }
}
