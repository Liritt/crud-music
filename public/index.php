<?php

declare(strict_types=1);

use Entity\Collection\ArtistCollection;
use Entity\Artist;

$titre = "Accueil";

$webpage = new Html\WebPage($titre);

foreach (ArtistCollection::findAll() as $artist) {
    $webpage->appendContent(
        "<p><a href='http://localhost:8000/artist.php?artistId={$artist->getId()}'>{$webpage->escapeString($artist->getName())}</a></p>\n"
    );
}

echo $webpage->toHtml();
