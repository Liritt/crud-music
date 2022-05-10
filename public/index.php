<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;

$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT id, name
    FROM artist
    ORDER BY name
SQL
);

$titre = "Accueil";

$webpage = new Html\WebPage($titre);

$webpage->setTitle($titre);

$stmt->execute();

while (($ligne = $stmt->fetch()) !== false) {
    $webpage->appendContent(
        "<p>{$webpage->escapeString($ligne['name'])}\n</p>"
    );
}

echo $webpage->toHtml();
