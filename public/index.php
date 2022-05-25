<?php

declare(strict_types=1);

use Entity\Collection\ArtistCollection;
use Entity\Artist;

$titre = "Accueil";

$webpage = new Html\AppWebPage($titre);

$webpage->appendContent("<ul class='list'>");
foreach (ArtistCollection::findAll() as $artist) {
    $webpage->appendContent(
        "<li><a href='http://localhost:8000/artist.php?artistId={$artist->getId()}'>{$webpage->escapeString($artist->getName())}</a></li>\n"
    );
}
$webpage->appendContent("</ul");
echo $webpage->toHtml();
