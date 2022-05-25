<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;
use Entity\Collection\AlbumCollection;
use PHPUnit\Runner\AfterRiskyTestHook;

class Artist
{
    private int $id;
    private string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    public static function findById(int $id): Artist
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM artist
            WHERE id = ?
SQL
        );

        $stmt->execute([$id]);

        if (!$artist = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Artist::class)) {
            throw new EntityNotFoundException("Aucun artiste n'est associé à cette id");
        }

        return $artist[0];
    }

    /**
     * @return Album[]
     */
    public function getAlbums(): array
    {
        $id = $this->getId();
        $albums = AlbumCollection::findByArtistId($id);
        return $albums;
    }
}
