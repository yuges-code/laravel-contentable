<?php

namespace Yuges\Contentable\Factories;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Interfaces\BlockType;
use Yuges\Contentable\Exceptions\InvalidBlockData;
use Yuges\Contentable\Interfaces\BlockDataInterface;

class BlockDataFactory
{
    public static function create(BlockType $type, array $data): ?BlockDataInterface
    {
        $class = static::getClass($type);

        if (! $class) {
            return null;
        }

        static::validateBlockData($class);

        return $class::from($data);
    }

    /** @return ?class-string<BlockDataInterface> */
    public static function getClass(BlockType $type): string
    {
        return Config::getBlockData()->first(function(string $data) use ($type) {
            return new $data()->getType() === $type;
        });
    }

    protected static function validateBlockData(string $class): void
    {
        if (! class_exists($class)) {
            throw InvalidBlockData::doesntExist($class);
        }

        if (! is_subclass_of($class, BlockDataInterface::class)) {
            throw InvalidBlockData::doesNotImplementBlockData($class);
        }
    }
}
