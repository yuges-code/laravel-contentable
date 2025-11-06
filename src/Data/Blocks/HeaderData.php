<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Enums\HeaderLevel;

class HeaderData extends \Yuges\Contentable\Abstracts\BlockData
{
    public string $type = BlockType::Header->value;

    public function __construct(
        public ?string $text = '',
        public HeaderLevel $level = HeaderLevel::Level3,
    ) {
    }

    public function getData(): array
    {
        return [
            'text' => $this->text,
            'level' => $this->level,
        ];
    }

    public function duration(): float
    {
        return Config::getDurationCalculatorClass()::duration($this->text);
    }
}
