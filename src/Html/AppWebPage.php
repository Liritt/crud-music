<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title);
        $this->appendCssUrl('../css/style.css');
    }

    public function toHtml(): string
    {
        return <<<HTML
                    <!DOCTYPE html>
                    <html lang="fr">
                        <head>
                            <meta charset="utf-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>{$this->getTitle()}</title>
                            {$this->getHead()}
                        </head>
                        <body>
                            <header class="header">
                                <h1>{$this->getTitle()}</h1>
                            </header>
                                <main class="content">
                                    <p>{$this->getBody()}</p>
                                </main>
                            <footer class="footer">
                                <p>{$this->getLastModification()}</p>
                            </footer>
                        </body>
                    </html>
                HTML;
    }
}
