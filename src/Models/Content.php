<?php

namespace Yuges\Contentable\Models;

use Yuges\Contentable\Config\Config;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property Collection<array-key, Block> $blocks
 */
class Content extends \Yuges\Package\Models\Model
{
    use HasFactory;

    protected $table = 'contents';

    protected $guarded = ['id'];

    public function getTable(): string
    {
        return Config::getContentTable() ?? $this->table;
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Config::getBlockClass(Block::class));
    }
}
