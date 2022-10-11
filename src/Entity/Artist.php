<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\AlbumCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Artist
{
    private ?int $id;
    private string $name;

    private function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    private function setId(?int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public static function findById(int $id): Artist
    {
        $artistData = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM artist
            WHERE id = ?
SQL
        );
        $artistData->execute([$id]);

        if (!$artist = $artistData->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Artist::class)) {
            throw new EntityNotFoundException("Aucun artiste n'est lié à cet ID");
        }
        return $artist[0];
    }

    public function getAlbums(): array
    {
        return AlbumCollection::findByArtistId($this->getId());
    }

    public function delete(): Artist
    {
        $change = MyPDO::getInstance()->prepare(
            <<<'SQL'
            DELETE FROM artist
            WHERE id = ?
SQL
        );

        $change->execute([$this->getId()]);

        $this->setId(null);
        return $this;
    }

    public function update(): Artist
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            UPDATE artist
                SET name = :name
            WHERE id = :id
SQL
        );

        $stmt->execute([':name' => $this->getName(), ':id' => $this->getId()]);

        return $this;
    }

    public static function create(string $name, ?int $id = null): Artist
    {
        $artist = new Artist();
        $artist->setName($name)->setId($id);
        return $artist;
    }

    public function insert(): Artist
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            INSERT INTO artist (name)
            VALUES (:name)
SQL
        );

        $stmt->execute([':name' => $this->getName()]);
        $this->setId((int) MyPdo::getInstance()->lastInsertId());

        return $this;
    }

    public function save(): Artist
    {
        if ($this->getId()) {
            $this->update();
        } else {
            $this->insert();
        }

        return $this;
    }
}
