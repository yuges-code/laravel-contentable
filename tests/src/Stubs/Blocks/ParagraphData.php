<?php

namespace Yuges\Contentable\Tests\Stubs\Blocks;

use Yuges\Contentable\Abstracts\BlockData;
use Yuges\Contentable\Tests\Stubs\Enums\BlockType;

class ParagraphData extends BlockData
{
    protected const BlockType TYPE = BlockType::Paragraph;

    public function __construct(
        public ?string $text = '',
    ) {
        parent::__construct();
    }

    public function getData(): array
    {
        return [
            'text' => $this->text,
        ];
    }
}
