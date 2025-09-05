<?php

namespace Yuges\Contentable\Traits;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\BlockType;
use Illuminate\Database\Eloquent\Model;
use Yuges\Contentable\Interfaces\BlockType as BlockTypeInterface;

/**
 * @property BlockTypeInterface $type
 */
trait HasBlockType
{
    public function initializeHasBlockType()
    {
        /** @var Model $this */
        $this->mergeCasts([
            'type' => Config::getBlockTypeClass(BlockType::class),
        ]);
    }
}
