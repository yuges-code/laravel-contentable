<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\BlockType;

class ParagraphData extends \Yuges\Contentable\Abstracts\BlockData
{
    public string $type = BlockType::Paragraph->value;

    public function __construct(
        public ?string $text = '',
    ) {
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
