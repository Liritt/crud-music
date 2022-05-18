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
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
                SELECT * 
                FROM album
                WHERE artistId = ?
                ORDER BY year DESC, name
SQL
        );

        $stmt->execute([$artistId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Album::class);
    }
}
