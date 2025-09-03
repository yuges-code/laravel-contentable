<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Enums\BlockType;

class Paragraph extends \Yuges\Contentable\Abstracts\BlockData
{
    public BlockType $type = BlockType::Paragraph;

    public function __construct(
        public ?string $text = '',
    ) {
    }

    public function getData(): array
    {
        return [
            'text' => $this->text,
        ];
    }
}
