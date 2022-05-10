<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    /**
     * @var string
     */
    private string $head="";
    private string $title="";
    private string $body="";

    /**
     * @param string $title
     */
    public function __construct(string $title="")
    {
        $this->setTitle($title);
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Ajouter un contenu dans $this->head.
     * @param string $content
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Ajouter un contenu CSS dans $this->head.
     * @param string $css
     */
    public function appendCss(string $css): void
    {
        $this->appendToHead("<style>{$css}</style>");
    }

    /**
     * Ajouter l'URL d'un script CSS dans $this->head.
     * @param string $url
     */
    public function appendCssUrl(string $url): void
    {
        $this->appendToHead("<link rel='stylesheet' href='{$url}'>");
    }

    /**
     * Ajouter un contenu JavaScript dans $this->head.
     * @param string $js
     */
    public function appendJs(string $js): void
    {
        $this->appendToHead("<script>{$js}</script>");
    }

    /**
     * Ajouter l'URL d'un script JavaScript dans $this->head.
     * @param string $url
     */
    public function appendJsUrl(string $url): void
    {
        $this->appendToHead("<script src='{$url}'></script>");
    }

    /**
     * Ajouter un contenu dans $this->body.
     * @param string $content
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * Produire la page Web complète.
     * @return string
     */
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
                            {$this->getBody()}
                        </body>
                    </html>
                HTML;
    }

    /**
     * Donner la date et l'heure de la dernière modification du script principal.
     * @return string
     */
    public function getLastModification(): string
    {
        return "Dernière modification : " . date(" F D Y H:i:s.", getlastmod());
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     * @param string $string
     * @return string
     */
    public static function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
    }
}
