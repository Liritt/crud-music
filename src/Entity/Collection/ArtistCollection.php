<?php

declare(strict_types=1);

namespace Entity\Collection;

use Entity\Artist;
use mysql_xdevapi\SqlStatement;
use Database\MyPdo;
use PDO;

class ArtistCollection
{
    /**
     * retourne un tableau contenant tous les artistes triés par ordre alphabétique
     * @return Artist[]
     */
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT id, name
                FROM artist
                ORDER BY name
            SQL
        );
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Artist::class);
    }
}
