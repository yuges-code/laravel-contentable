<?php

namespace Yuges\Contentable\Models;

use Yuges\Contentable\Data\Editor;
use Yuges\Orderable\Traits\HasOrder;
use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Traits\HasBlocks;
use Yuges\Orderable\Options\OrderOptions;
use Yuges\Orderable\Interfaces\Orderable;
use Illuminate\Database\Eloquent\Builder;
use Yuges\Contentable\Traits\HasContentable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property ?Editor $editor
 * @property ?Carbon $selected_at
 */
class Content extends \Yuges\Package\Models\Model implements Orderable
{
    use
        HasOrder,
        HasBlocks,
        HasFactory,
        HasContentable;

    protected $table = 'contents';

    protected $guarded = ['id'];

    public function getTable(): string
    {
        return Config::getContentTable() ?? $this->table;
    }

    protected function casts(): array
    {
        return [
            'editor' => Editor::class,
        ];
    }

    public function orderable(): OrderOptions
    {
        $options = new OrderOptions();

        $options->column = 'version';

        $options->query = fn (Builder $builder) => $builder
            ->where('contentable_id', $this->contentable_id)
            ->where('contentable_type', $this->contentable_type);

        return $options;
    }
}
