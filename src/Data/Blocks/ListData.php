<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Enums\ListStyle;

class ListData extends \Yuges\Contentable\Abstracts\BlockData
{
    public string $type = BlockType::List->value;

    public function __construct(
        public ?array $items = [],
        public ListStyle $style = ListStyle::Unordered,
    ) {
    }

    public function getData(): array
    {
        return [
            'items' => $this->items,
            'style' => $this->style,
        ];
    }
}
