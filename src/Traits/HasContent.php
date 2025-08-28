<?php

namespace Yuges\Contentable\Traits;

use Carbon\Carbon;
use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Models\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property ?Content $content
 * @property Collection<array-key, Content> $contents
 */
trait HasContent
{
    public function contents(): MorphMany
    {
        /** @var Model $this */
        return $this
            ->MorphMany(
                Config::getContentClass(Content::class),
                Config::getContentableRelationName('contentable'),
            );
    }

    public function content(): MorphOne
    {
        return $this->contents()->one()->ofMany([
            'selected_at' => 'max',
            'id' => 'max',
        ], function (Builder $builder) {
            $builder->where('selected_at', '<=', Carbon::now());
        });
    }
}
