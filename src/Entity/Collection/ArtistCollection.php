<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Artist;
use PDO;

class ArtistCollection
{
    /**
     * Récupère tout les artistes dans un tableau
     * @return Artist[]
     */
    public static function findAll(): array
    {
        $allArtist = MyPDO::getInstance()->prepare(
            <<<'SQL'
    SELECT id, name
    FROM artist
    ORDER BY name
SQL
        );

        $allArtist->execute();

        return $allArtist->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Artist::class);
    }
}
