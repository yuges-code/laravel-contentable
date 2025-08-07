<?php

namespace Yuges\Contentable\Exceptions;

use Exception;
use TypeError;
use Yuges\Contentable\Models\Block;

class InvalidBlock extends Exception
{
    public static function doesNotImplementBlock(string $class): TypeError
    {
        $block = Block::class;

        return new TypeError("Block class `{$class}` must implement `{$block}`");
    }
}
