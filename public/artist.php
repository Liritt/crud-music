<?php

use Database\MyPdo;
use Entity\Artist;
use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;

$artistId = $_GET['artistId'];

if (!isset($_GET['artistId']) || !ctype_digit($_GET['artistId'])) {
    http_response_code(302);
    header("Location: /index.php");
    exit(0);
}

try {
    $artist = Artist::findById((int) $_GET['artistId']);
} catch (EntityNotFoundException) {
    http_response_code(404);
    exit(0);
}

$artistName = AppWebPage::escapeString($artist->getName());

$webpage = new AppWebPage("Albums de {$artistName}");

$albums = $artist->getAlbums();

$albumsHTML = '';

$webpage->appendContent(
    <<<HTML
      <div id='menu'>
        <input type="button" name="modif" value="Modifier" onclick="self.location.href='/admin/artist-form.php?artistId={$artistId}'">
        <input type="button" name="suppr" value="Supprimer" onclick="self.location.href='/admin/artist-delete.php?artistId={$artistId}'">
      </div> 
HTML
);


foreach ($artist->getAlbums() as $album) {
    $escapedName = AppWebPage::escapeString($album->getName());


    $albumsHTML .= <<<HTML
    <div class="album">
        <img class="album__cover" src="/cover.php?coverId={$album->getCoverId()}" alt="Pochette d'album">
        <div class="album_informations">
            <p class="album__year">{$album->getYear()}</p>
            <p class="album__name">{$escapedName}</p>
        </div>
    </div>
    HTML;
}
                                //class='list grid'
$webpage->appendContent("<div class='list'>{$albumsHTML}</div>");


echo $webpage->toHtml();
