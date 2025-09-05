<?php

namespace Yuges\Contentable\Abstracts;

use Spatie\LaravelData\Data;
use Illuminate\Validation\Rule;
use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Factories\BlockDataFactory;
use Spatie\LaravelData\Attributes\PropertyForMorph;
use Yuges\Contentable\Interfaces\BlockDataInterface;
use Spatie\LaravelData\Contracts\PropertyMorphableData;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Yuges\Contentable\Interfaces\BlockType as BlockTypeInterface;

#[MergeValidationRules]
abstract class BlockData extends Data implements BlockDataInterface, PropertyMorphableData
{
    #[PropertyForMorph]
    public string $type;

    public static function morph(array $properties): ?string
    {
        $type = Config::getBlockTypeClass(BlockType::class)::tryFrom($properties['type']);

        return BlockDataFactory::getClass($type);
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

    public static function rules(): array
    {
        return [
            'type' => [Rule::enum(Config::getBlockTypeClass(BlockType::class))],
        ];
    }
}
