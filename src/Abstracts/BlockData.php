<?php

namespace Yuges\Contentable\Abstracts;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Factories\BlockDataFactory;
use Yuges\Contentable\Exceptions\InvalidBlockType;
use Yuges\Contentable\Interfaces\BlockDataInterface;
use Yuges\Contentable\Interfaces\BlockType as BlockTypeInterface;

abstract class BlockData implements BlockDataInterface
{
    protected const float DURATION = 0.0;
    protected const ?BlockTypeInterface TYPE = null;

    public string $type;

    public function __construct() {
        if (! static::TYPE) {
            throw InvalidBlockType::notDefined(static::class);
        }

        $this->type = static::TYPE->value;
    }

    public function getType(): BlockTypeInterface
    {
        return Config::getBlockTypeClass(BlockType::class)::tryFrom($this->type);
    }

    public function setType(BlockTypeInterface $type): static
    {
        $this->type = $type->value;

        return $this;
    }

    public function toArrayData(): array
    {
        return $this->getData();
    }

    public static function fromArrayData(BlockTypeInterface $type, array $data): ?BlockDataInterface
    {
        return BlockDataFactory::create($type, $data);
    }

    public function toJsonData(): string
    {
        return json_encode($this->getData());
    }

    public static function fromJsonData(BlockTypeInterface $type, string $data): ?BlockDataInterface
    {
        $data = json_decode($data, true);

        return self::fromArrayData($type, $data);
    }

    public function duration(): float
    {
        return static::DURATION;
    }
}
