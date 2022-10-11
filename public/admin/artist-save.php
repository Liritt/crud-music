<?php

declare(strict_types=1);

use Exception\ParameterException;
use Html\Form\ArtistForm;

try {
    $artistForm = new ArtistForm();
    $artistForm->setEntityFromQueryString();

    $artistForm->getArtist()->save();

    http_response_code(302);
    header("Location: /");
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}