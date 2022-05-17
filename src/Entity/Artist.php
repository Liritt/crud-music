<?php

declare(strict_types=1);

namespace Entity;

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
}
