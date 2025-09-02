<?php

namespace Yuges\Contentable\Calculators;

use Yuges\Contentable\Models\Content;

class DurationCalculator
{
    CONST CHARACTERS_PER_SECOND = 25;

    private Content $content;

    public function setContent(Content $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function calculate(): int
    {
        $seconds = 0;

        if (! $this->content->relationLoaded('blocks')) {
            return $seconds;
        }

        if (empty($this->content->blocks)) {
            return $seconds;
        }

        foreach ($this->content->blocks as $block) {
            $seconds += strlen($block->data->text ?? '') / self::CHARACTERS_PER_SECOND;
        }

        return $seconds;
    }
}
