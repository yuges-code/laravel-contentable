<?php

namespace Yuges\Contentable\Exceptions;

use Exception;
use TypeError;
use Yuges\Contentable\Interfaces\BlockType;

class InvalidBlockType extends Exception
{
    public static function notDefined(string $class): TypeError
    {
        return new TypeError("Block type is not defined in the `{$class}` class");
    }

    public static function doesNotImplementBlockType(string $class): TypeError
    {
        $BlockType = BlockType::class;

        return new TypeError("Block type enum `{$class}` must implement `{$BlockType}`");
    }
}
