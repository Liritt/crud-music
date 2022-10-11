<?php

declare(strict_types=1);

use Entity\Artist;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;
use Html\Form\ArtistForm;

try {
    if (!isset($_GET['artistId']) || !ctype_digit($_GET['artistId'])) {
        throw new ParameterException();
    }

    $artist = Artist::findById((int) $_GET['artistId']);
    $artist->delete();

    http_response_code(302);
    header("Location: /");
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
