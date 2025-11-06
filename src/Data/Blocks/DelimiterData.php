<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Enums\BlockType;

class DelimiterData extends \Yuges\Contentable\Abstracts\BlockData
{
    protected const DURATION = 0.5;

    public string $type = BlockType::Delimiter->value;

    public function __construct() {
    }

    public function getData(): array
    {
        return [];
    }
}
