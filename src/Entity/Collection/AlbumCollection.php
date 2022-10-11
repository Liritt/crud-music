<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Album;
use PDO;

class AlbumCollection
{
    /**
     * @param int $artistId
     * @return Album[]
     */
    public static function findByArtistId(int $artistId): array
    {
        $albums = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM album
            WHERE artistId = ?
            ORDER BY year DESC, name
SQL
        );

        $albums->execute([$artistId]);

        return $albums->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Album::class);
    }
}
