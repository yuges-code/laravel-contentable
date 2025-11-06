<?php

namespace Yuges\Contentable\Models;

use Yuges\Orderable\Traits\HasOrder;
use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Traits\HasData;
use Yuges\Contentable\Traits\HasContent;
use Yuges\Orderable\Options\OrderOptions;
use Yuges\Orderable\Interfaces\Orderable;
use Illuminate\Database\Eloquent\Builder;
use Yuges\Contentable\Traits\HasBlockType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends \Yuges\Package\Models\Model implements Orderable
{
    use
        HasData,
        HasOrder,
        HasContent,
        HasFactory,
        HasBlockType;

    protected $table = 'content_blocks';

    protected $guarded = [];

    public function getTable(): string
    {
        return Config::getBlockTable() ?? $this->table;
    }

    public function orderable(): OrderOptions
    {
        $options = new OrderOptions();

        $options->query = fn (Builder $builder) => $builder
            ->where($this->content()->getForeignKeyName(), $this->content_id);

        return $options;
    }
}
