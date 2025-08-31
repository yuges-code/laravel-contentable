<?php

namespace Yuges\Contentable\Exceptions;

use Exception;
use Yuges\Contentable\Interfaces\BlockDataInterface;

class InvalidBlockData extends Exception
{
    public static function doesntExist(string $class): self
    {
        return new static("Block data class `{$class}` doesn't exist");
    }

    public static function doesNotImplementBlockData(string $class): self
    {
        $BlockDataClass = BlockDataInterface::class;

        return new static("Block data class `{$class}` must implement `$BlockDataClass}`");
    }
}
