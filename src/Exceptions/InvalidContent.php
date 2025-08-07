<?php

namespace Yuges\Contentable\Exceptions;

use Exception;
use TypeError;
use Yuges\Contentable\Models\Content;

class InvalidContent extends Exception
{
    public static function doesNotImplementContent(string $class): TypeError
    {
        $content = Content::class;

        return new TypeError("Content class `{$class}` must implement `{$content}`");
    }
}
