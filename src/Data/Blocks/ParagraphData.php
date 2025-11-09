<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Interfaces\BlockType as BlockTypeInterface;

class ParagraphData extends \Yuges\Contentable\Abstracts\BlockData
{
    protected const BlockTypeInterface TYPE = BlockType::Paragraph;

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

    public function duration(): float
    {
        return Config::getDurationCalculatorClass()::duration($this->text);
    }
}
