<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Enums\BlockType;

class DelimiterData extends \Yuges\Contentable\Abstracts\BlockData
{
    public string $type = BlockType::Delimiter->value;

    public function __construct() {
    }

    public function getData(): array
    {
        return [];
    }
}
