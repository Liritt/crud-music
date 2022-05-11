<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;

$artistId = $_GET['artistId'];
if ((!is_numeric($artistId))){
    header('Location: index.php');
    exit;
}

$artistName = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT name
    FROM artist
    WHERE id = ?
SQL
);

$artistName->execute([$artistId]);


$name = $artistName->fetch();

if(($name == false)){
    http_response_code(404);
    exit;
}

$webpage = new Html\WebPage("Albums de {$name['name']}");
$webpage->appendContent("<h1>Albums de {$name['name']}</h1>");

$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT year, name 
    FROM album
    WHERE artistId = ?
    ORDER BY year DESC, name
SQL
);

$stmt->execute([$artistId]);

foreach ($stmt as $ligne) {
    $webpage->appendContent(
        "<p>{$ligne['year']} {$webpage->escapeString($ligne['name'])}\n</p>"
    );
}


echo $webpage->toHtml();

