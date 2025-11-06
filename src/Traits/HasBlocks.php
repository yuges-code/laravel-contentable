<?php

namespace Yuges\Contentable\Traits;

use Yuges\Contentable\Models\Block;
use Yuges\Contentable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection as CollectionSupport;

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

    /**
     * @param CollectionSupport<array-key, Block> $blocks
     */
    public function syncBlocks(CollectionSupport $blocks): array
    {
        return Config::getSyncBlocksAction($this)->execute($blocks);
    }
}
