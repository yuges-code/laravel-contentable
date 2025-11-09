<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Enums\ListStyle;
use Yuges\Contentable\Interfaces\BlockType as BlockTypeInterface;

class ListData extends \Yuges\Contentable\Abstracts\BlockData
{
    protected const BlockTypeInterface TYPE = BlockType::List;

    public function __construct(
        public ?array $items = [],
        public ListStyle $style = ListStyle::Unordered,
    ) {
        parent::__construct();
    }

    public function getData(): array
    {
        return [
            'items' => $this->items,
            'style' => $this->style,
        ];
    }

    public function duration(): float
    {
        return Config::getDurationCalculatorClass()::duration($this->items);
    }
}
