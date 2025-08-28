<?php

namespace Yuges\Contentable\Traits;

use Yuges\Contentable\Enums\BlockType;
use Illuminate\Database\Eloquent\Model;

/**
 * @property BlockType $type
 */
trait HasBlockType
{
    public function initializeHasBlockType()
    {
        /** @var Model $this */
        $this->mergeCasts([
            'type' => BlockType::class,
        ]);
    }
}
