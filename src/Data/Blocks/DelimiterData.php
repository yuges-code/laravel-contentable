<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Interfaces\BlockType as BlockTypeInterface;

class DelimiterData extends \Yuges\Contentable\Abstracts\BlockData
{
    protected const float DURATION = 0.5;
    protected const BlockTypeInterface TYPE = BlockType::Delimiter;

    public function __construct() {
        parent::__construct();
    }

    public function getData(): array
    {
        return [];
    }
}
