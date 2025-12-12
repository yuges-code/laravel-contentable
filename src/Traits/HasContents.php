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
use Illuminate\Support\Collection as CollectionSupport;

/**
 * @property ?Content $content
 * @property Collection<array-key, Content> $contents
 */
trait HasContents
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

    /**
     * @param CollectionSupport<array-key, Block> $blocks
     */
    public function storeContent(array $attributes = [], CollectionSupport $blocks): Content
    {
        $content = $this->contents()->create($attributes);

        $content->syncBlocks($blocks);

        $content->duration = Config::getDurationCalculator($content)->calculate();

        $content->save();

        return $content;
    }

    /**
     * @param CollectionSupport<array-key, Block> $blocks
     */
    public function updateContent(array $attributes = [], CollectionSupport $blocks, ?Content $content = null): bool
    {
        $content ??= $this->content;

        $syncs = $content->syncBlocks($blocks);

        $content->duration = Config::getDurationCalculator($content)->calculate();

        if (count($syncs['created']) || count($syncs['deleted']) || count($syncs['updated'])) {
            if ($content->usesTimestamps()) {
                $content->updateTimestamps();
            }
        }

        return $content->fill($attributes)->save();
    }
}
