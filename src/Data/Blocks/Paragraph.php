<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Enums\BlockType;

class Paragraph extends \Yuges\Contentable\Abstracts\BlockData
{
    protected BlockType $type = BlockType::Paragraph;

    public function __construct(
        public ?string $text = null,
    ) {
    }

    public function getData(): array
    {
        return [
            'text' => $this->text,
        ];
    }
}
