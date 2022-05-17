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
    public function findAll(): array
    {
        $tab = [];
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT name
                FROM artist
                ORDER BY name
            SQL
        );
        while (($line = $stmt->fetchAll(PDO::FETCH_CLASS, PDO::FETCH_PROPS_LATE)) !== false) {
            $tab[]=$line;
        }
        return $tab;
    }
}
