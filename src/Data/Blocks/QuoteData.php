<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\Alignment;
use Yuges\Contentable\Enums\BlockType;

class QuoteData extends \Yuges\Contentable\Abstracts\BlockData
{
    public string $type = BlockType::Quote->value;

    public function __construct(
        public ?string $text = '',
        public ?string $caption = '',
        public Alignment $alignment = Alignment::Left,
    ) {
    }

    public function getData(): array
    {
        return [
            'text' => $this->text,
            'caption' => $this->caption,
            'alignment' => $this->alignment,
        ];
    }

    public function duration(): float
    {
        $calculator = Config::getDurationCalculatorClass();

        return $calculator::duration($this->text) + $calculator::duration($this->caption);
    }
}
