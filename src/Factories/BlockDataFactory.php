<?php

namespace Yuges\Contentable\Factories;

use BackedEnum;
use ReflectionClass;
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

        $parameters = new ReflectionClass($class)->getConstructor()->getParameters();

        foreach ($data as $key => $value) {
            $parameter = array_find($parameters, fn ($parameter) => $parameter->getName() === $key);

            if (! $parameter) {
                unset($data[$key]);

                continue;
            }

            $type = $parameter->getType();

            if (is_subclass_of($type->getName(), BackedEnum::class)) {
                $data[$key] = $type->getName()::from($value instanceof BackedEnum ? $value->value : $value);
            }
        }

        return new $class(...$data);
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
