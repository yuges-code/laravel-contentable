<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Enums\ListStyle;

class ItemList extends \Yuges\Contentable\Abstracts\BlockData
{
    public BlockType $type = BlockType::List;

    public function __construct(
        public ListStyle $style = ListStyle::Unordered,
        public ?array $items = [],
    ) {
    }

    public function getData(): array
    {
        return [
            'style' => $this->style,
            'items' => $this->items,
        ];
    }
}
