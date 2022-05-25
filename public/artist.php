<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Entity\Artist;
use Entity\Album;

$artistId = $_GET['artistId'];
if ((!is_numeric($artistId))) {
    header('Location: index.php');
    exit;
}

$artiste = Artist::findById((int)$artistId);

$artistName = $artiste->getName();

$artistAlbums = $artiste->getAlbums();

$webpage = new Html\AppWebPage("Albums de {$artistName}");

$webpage->appendContent("<ul>");
foreach ($artistAlbums as $album) {
    $webpage->appendContent(
        "<li>{$album->getYear()} {$webpage->escapeString($album->getName())}</li>\n"
    );
}
$webpage->appendContent("</ul>");
echo $webpage->toHtml();
