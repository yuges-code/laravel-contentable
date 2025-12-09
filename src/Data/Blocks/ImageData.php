<?php

namespace Yuges\Contentable\Data\Blocks;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Interfaces\BlockType as BlockTypeInterface;

class ImageData extends \Yuges\Contentable\Abstracts\BlockData
{
    protected const BlockTypeInterface TYPE = BlockType::Image;

    public function __construct(
        public array $file = [
            'url' => '',
        ],
        public ?string $caption = '',
        public bool $stretched = true,
        public bool $withBorder = false,
        public bool $withBackground = false,
    ) {
        parent::__construct();
    }

    public function getData(): array
    {
        return [
            'file' => $this->file,
            'caption' => $this->caption,
            'stretched' => $this->stretched,
            'withBorder' => $this->withBorder,
            'withBackground' => $this->withBackground,
        ];
    }

    public function duration(): float
    {
        $calculator = Config::getDurationCalculatorClass();

        return ($this->file['url'] ?? 0 ? 5 : 0) + $calculator::duration($this->caption);
    }
}
