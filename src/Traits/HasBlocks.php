<?php

namespace Yuges\Contentable\Traits;

use Yuges\Contentable\Models\Block;
use Yuges\Contentable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection<array-key, Block> $blocks
 */
trait HasBlocks
{
    public function blocks(): HasMany
    {
        /** @var Model $this */
        return $this->hasMany(Config::getBlockClass(Block::class));
    }
}
