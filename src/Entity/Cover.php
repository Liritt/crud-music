<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Cover
{
    private int $id;
    private string $jpeg;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id): Cover
    {
        $cover = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM cover
            WHERE id = ?
SQL
        );

        $cover->execute([$id]);

        if (!$covered = $cover->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Cover::class)) {
            throw new EntityNotFoundException("Aucune cover n'est lié à cet ID");
        }

        return $covered[0];
    }
}
