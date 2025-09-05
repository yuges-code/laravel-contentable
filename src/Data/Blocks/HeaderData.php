<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Enums\HeaderLevel;

class HeaderData extends \Yuges\Contentable\Abstracts\BlockData
{
    public string $type = BlockType::Header->value;

    public function __construct(
        public HeaderLevel $level = HeaderLevel::Level3,
        public ?string $text = '',
    ) {
    }

    public function getData(): array
    {
        return [
            'text' => $this->text,
            'level' => $this->level,
        ];
    }
}
