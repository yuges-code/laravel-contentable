<?php

namespace Yuges\Contentable\Config;

use Yuges\Package\Enums\KeyType;
use Illuminate\Support\Collection;
use Yuges\Contentable\Models\Content;
use Yuges\Contentable\Interfaces\BlockType;
use Yuges\Contentable\Interfaces\Contentable;
use Yuges\Contentable\Actions\SyncBlocksAction;
use Yuges\Contentable\Interfaces\BlockDataInterface;
use Yuges\Contentable\Calculators\DurationCalculator;

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

    /** @return class-string<BlockType> */
    public static function getBlockTypeClass(mixed $default = null): string
    {
        return self::get('block.type', $default);
    }

    /** @return Collection<array-key, class-string<BlockDataInterface>> */
    public static function getBlockData(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('block.data', $default)
        );
    }

    /** @return class-string<BlockObserver> */
    public static function getBlockObserverClass(mixed $default = null): string
    {
        return self::get('models.block.observer', $default);
    }

    public static function getContentableKeyType(mixed $default = null): KeyType
    {
        return self::get('models.contentable.key', $default);
    }

    public static function getContentableRelationName(mixed $default = null): string
    {
        return self::get('models.contentable.relation.name', $default);
    }

    /** @return Collection<array-key, class-string<Contentable>> */
    public static function getContentableAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.contentable.allowed.classes', $default)
        );
    }

    /** @return class-string<ContentableObserver> */
    public static function getContentableObserverClass(mixed $default = null): string
    {
        return self::get('models.contentable.observer', $default);
    }

    public static function getSyncBlocksAction(
        Content $content,
        mixed $default = null
    ): SyncBlocksAction
    {
        return self::getSyncBlocksActionClass($default)::create($content);
    }

    /** @return class-string<SyncBlocksAction> */
    public static function getSyncBlocksActionClass(mixed $default = null): string
    {
        return self::get('actions.sync', $default);
    }

    public static function getDurationCalculator(
        Content $content,
        mixed $default = null
    ): DurationCalculator
    {
        return self::getDurationCalculatorClass($default)::create($content);
    }

    /** @return class-string<DurationCalculator> */
    public static function getDurationCalculatorClass(mixed $default = null): string
    {
        return self::get('calculators.duration.class', $default);
    }

    public static function getDurationCalculatorSymbolTime(mixed $default = null): float
    {
        return self::get('calculators.duration.symbol.time', $default);
    }
}
