<?php

namespace Yuges\Contentable\Tests\Stubs\Blocks;

use Yuges\Contentable\Tests\Stubs\Enums\BlockType;

class ParagraphData extends \Yuges\Contentable\Data\Blocks\ParagraphData
{
    protected const BlockType TYPE = BlockType::Delimiter;

    public function __construct(
        public ?string $text = '',
    ) {
        parent::__construct($text);
    }
}
