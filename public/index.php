<?php

declare(strict_types=1);

use Entity\Collection\ArtistCollection;
use Html\AppWebPage;

$webpage = new AppWebPage("Artistes");

$allArtist = ArtistCollection::findAll();
$webpage->appendContent(" <div id='menu'>
                                    <input type=\"button\" name=\"ajout\" value=\"Ajouter\" onclick=\"self.location.href='/admin/artist-form.php'\">
                                  </div>");

$webpage->appendContent("<ul class='list'>");
foreach ($allArtist as $artist) {
    $webpage->appendContent("<li><a href='http://localhost:8000/artist.php?artistId={$artist->getId()}'>{$webpage->escapeString($artist->getName())}</a></li>\n");
}
$webpage->appendContent("</ul>");

echo $webpage->toHtml();
