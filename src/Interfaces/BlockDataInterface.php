<?php

namespace Yuges\Contentable\Interfaces;


interface BlockDataInterface
{
    public function getType(): BlockType;

    public function setType(BlockType $type): static;

    public function getData(): array;

    public function toArrayData(): array;

    public function toJsonData(): string;

    public static function from(mixed ...$payloads): static;
}
