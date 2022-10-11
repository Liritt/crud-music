<?php

declare(strict_types=1);

use Entity\Artist;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;
use Html\AppWebPage;
use Html\Form\ArtistForm;

$webpage = new AppWebPage("Formulaire Artiste");

try {
    $artist = null;
    if (isset($_GET['artistId'])) {
        $artistId = $_GET['artistId'];

        if (!ctype_digit($artistId)) {
            throw new ParameterException();
        }

        $artist = Artist::findById((int) $artistId);
    }
    $artistForm = new ArtistForm($artist);

    $webpage->appendContent($artistForm->getHtmlForm('/admin/artist-save.php'));
    echo $webpage->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
