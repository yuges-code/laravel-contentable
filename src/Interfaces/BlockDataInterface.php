<?php

namespace Yuges\Contentable\Interfaces;


interface BlockDataInterface
{
    public function getType(): BlockType;

    public function setType(BlockType $type): static;

    public function getData(): array;

    public function toArrayData(): array;

    public static function fromArrayData(BlockType $type, array $data): ?BlockDataInterface;

    public function toJsonData(): string;

    public static function fromJsonData(BlockType $type, string $data): ?BlockDataInterface;

    public function duration(): float;
}
