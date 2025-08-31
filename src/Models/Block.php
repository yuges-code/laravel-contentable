<?php

namespace Yuges\Contentable\Models;

use Yuges\Contentable\Casts\AsData;
use Yuges\Orderable\Traits\HasOrder;
use Yuges\Contentable\Config\Config;
use Yuges\Orderable\Options\OrderOptions;
use Yuges\Orderable\Interfaces\Orderable;
use Illuminate\Database\Eloquent\Builder;
use Yuges\Contentable\Traits\HasBlockType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int|string $content_id
 */
class Block extends \Yuges\Package\Models\Model implements Orderable
{
    use
        HasOrder,
        HasFactory,
        HasBlockType;

    protected $table = 'content_blocks';

    protected $guarded = ['id'];

    public function getTable(): string
    {
        return Config::getBlockTable() ?? $this->table;
    }

    public function casts(): array
    {
        return [
            'data' => AsData::class,
        ];
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Config::getContentClass(Content::class));
    }

    public function orderable(): OrderOptions
    {
        $options = new OrderOptions();

        $options->query = fn (Builder $builder) => $builder
            ->where($this->content()->getForeignKeyName(), $this->content_id);

        return $options;
    }
}
