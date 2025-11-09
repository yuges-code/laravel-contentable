<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Enums\HeaderLevel;
use Yuges\Contentable\Interfaces\BlockType as BlockTypeInterface;

class HeaderData extends \Yuges\Contentable\Abstracts\BlockData
{
    protected const BlockTypeInterface TYPE = BlockType::Header;

    public function __construct(
        public ?string $text = '',
        public HeaderLevel $level = HeaderLevel::Level3,
    ) {
        parent::__construct();
    }

    public function getData(): array
    {
        return [
            'text' => $this->text,
            'level' => $this->level,
        ];
    }

    public function duration(): float
    {
        return Config::getDurationCalculatorClass()::duration($this->text);
    }
}
