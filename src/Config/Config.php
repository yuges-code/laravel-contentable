<?php

namespace Yuges\Contentable\Config;

use Yuges\Package\Enums\KeyType;
use Yuges\Contentable\Models\Content;

class Config extends \Yuges\Package\Config\Config
{
    const string NAME = 'contentable';

    public static function getContentTable(mixed $default = null): string
    {
        return self::get('models.content.table', $default);
    }

    /** @return class-string<Content> */
    public static function getContentClass(mixed $default = null): string
    {
        return self::get('models.content.class', $default);
    }

    public static function getContentKeyType(mixed $default = null): KeyType
    {
        return self::get('models.content.key', $default);
    }

    /** @return class-string<ContentObserver> */
    public static function getContentObserverClass(mixed $default = null): string
    {
        return self::get('models.content.observer', $default);
    }

    public static function getBlockTable(mixed $default = null): string
    {
        return self::get('models.block.table', $default);
    }

    /** @return class-string<Block> */
    public static function getBlockClass(mixed $default = null): string
    {
        return self::get('models.block.class', $default);
    }

    public static function getBlockKeyType(mixed $default = null): KeyType
    {
        return self::get('models.block.key', $default);
    }

    /** @return class-string<BlockObserver> */
    public static function getBlockObserverClass(mixed $default = null): string
    {
        return self::get('models.block.observer', $default);
    }
}
