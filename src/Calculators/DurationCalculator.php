<?php

namespace Yuges\Contentable\Calculators;

use Yuges\Contentable\Models\Block;
use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Models\Content;

class DurationCalculator
{
    CONST CHARACTERS_PER_SECOND = 25;

    public function __construct(
        protected Content $content
    ) {
    }

    public static function create(Content $content): self
    {
        return new static($content);
    }

    public function setContent(Content $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function calculate(): int
    {
        $seconds = 0;

        if (! $this->content->relationLoaded('blocks')) {
            $this->content->load('blocks');
        }

        if ($this->content->blocks->isEmpty()) {
            return $seconds;
        }

        $seconds = $this->content->blocks->sum(fn (Block $block) => $block->data->duration());

        return round($seconds);
    }

    public static function duration(string|array|null $data): float
    {
        $seconds = 0.0;

        if (! $data) {
            return $seconds;
        }

        if (is_string($data)) {
            $data = [$data];
        }

        $time = Config::getDurationCalculatorSymbolTime();

        array_walk_recursive($data, function ($item) use ($time, &$seconds) {
            $seconds += strlen($item ?? '') * $time;
        });

        return $seconds;
    }
}
