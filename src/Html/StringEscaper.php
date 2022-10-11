<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    public static function escapeString(?string $string): string
    {
        return htmlspecialchars($string ?? "", ENT_QUOTES | ENT_HTML5, "UTF-8");
    }

    public function stripTagsAndTrim(?string $string): string
    {
        return trim(self::escapeString($string));
    }
}
