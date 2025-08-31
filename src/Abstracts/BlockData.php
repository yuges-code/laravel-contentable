<?php

namespace Yuges\Contentable\Abstracts;

use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Factories\BlockDataFactory;
use Yuges\Contentable\Interfaces\BlockDataInterface;

abstract class BlockData implements BlockDataInterface
{
    protected BlockType $type;

    public function getType(): BlockType
    {
        return $this->type;
    }

    public function setType(BlockType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function toArrayData(): array
    {
        return $this->getData();
    }

    public static function fromArrayData(BlockType $type, array $data): BlockDataInterface
    {
        return BlockDataFactory::create($type, $data);
    }

    public function toJsonData(): string
    {
        return json_encode($this->getData());
    }

    public static function fromJsonData(BlockType $type, string $data): BlockDataInterface
    {
        $data = json_decode($data, true);

        return self::fromArrayData($type, $data);
    }
}
