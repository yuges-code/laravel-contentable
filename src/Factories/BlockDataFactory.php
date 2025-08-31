<?php

namespace Yuges\Contentable\Factories;

use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Data\Blocks\Header;
use Yuges\Contentable\Data\Blocks\ItemList;
use Yuges\Contentable\Data\Blocks\Paragraph;
use Yuges\Contentable\Exceptions\InvalidBlockData;
use Yuges\Contentable\Interfaces\BlockDataInterface;

class BlockDataFactory
{
    public static function create(BlockType $type, array $data): BlockDataInterface
    {
        $class = static::getClass($type);

        static::validateBlockData($class);

        return new $class(...$data);
    }

    /** @return class-string<BlockDataInterface> */
    protected static function getClass(BlockType $type): string
    {
        $class = match ($type) {
            BlockType::List => ItemList::class,
            BlockType::Header => Header::class,
            BlockType::Paragraph => Paragraph::class,
        };

        return $class;
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
