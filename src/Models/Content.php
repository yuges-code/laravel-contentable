<?php

namespace Yuges\Contentable\Models;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Traits\HasBlocks;
use Yuges\Contentable\Traits\HasContentable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property ?Carbon $selected_at
 */
class Content extends \Yuges\Package\Models\Model
{
    use
        HasBlocks,
        HasFactory,
        HasContentable;

    protected $table = 'contents';

    protected $guarded = ['id'];

    public function getTable(): string
    {
        return Config::getContentTable() ?? $this->table;
    }
}
