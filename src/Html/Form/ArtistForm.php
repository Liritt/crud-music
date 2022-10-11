<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Artist;
use Exception\ParameterException;
use Html\StringEscaper;

class ArtistForm
{
    use StringEscaper;

    /**
     * @param Artist|null $artist
     */
    public function __construct(
        private ?Artist $artist = null
    ) {
    }

    /**
     * @return Artist|null
     */
    public function getArtist(): ?Artist
    {
        return $this->artist;
    }



    public function getHtmlForm(string $url): string
    {
        $escapedUrl = self::escapeString($url);
        $escapeArtist = self::escapeString($this->getArtist()?->getName());
        return <<<HTML
                <form action="{$escapedUrl}" method="post">
                   <input type="hidden" name="id" value="{$this->getArtist()?->getId()}">
                   
                   <label for="name">Nom</label>
                   <input type="text" name="name" value="{$escapeArtist}" required>
                   
                   <input type="submit" value="Enregistrer">
                </form>
        HTML;
    }

    public function setEntityFromQueryString(): void
    {
        $artistId = null;
        if (isset($_POST['id']) && ctype_digit($_POST['id'])) {
            $artistId = (int) $_POST['id'];
        }

        if (!isset($_POST['name']) || $_POST['name'] === '') {
            throw new ParameterException("Cet artiste n'a pas de nom !");
        }
        $artistName = $_POST['name'];

        $escapedString = self::stripTagsAndTrim($artistName);

        $this->artist = Artist::create($escapedString, $artistId);
    }
}
