<?php

declare(strict_types=1);

use Entity\Cover;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    if (!isset($_GET['coverId']) || !ctype_digit($_GET['coverId'])) {
        throw new ParameterException("Désolé, la cover est soit inexistante, soit non numérique... :(");
    }

    $cover = Cover::findById((int) $_GET['coverId']);

    header('Content-Type: image/jpeg');
    echo $cover->getJpeg();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
