<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\Alignment;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Interfaces\BlockType as BlockTypeInterface;

class QuoteData extends \Yuges\Contentable\Abstracts\BlockData
{
    protected const BlockTypeInterface TYPE = BlockType::Quote;

    public function __construct(
        public ?string $text = '',
        public ?string $caption = '',
        public Alignment $alignment = Alignment::Left,
    ) {
        parent::__construct();
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
