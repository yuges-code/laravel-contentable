<?php

namespace Yuges\Contentable\Actions;

use Illuminate\Support\Collection;
use Yuges\Contentable\Models\Block;
use Yuges\Contentable\Models\Content;

class SyncBlocksAction
{
    public function __construct(
        protected Content $content
    ) {
    }

    public static function create(Content $content): self
    {
        return new static($content);
    }

    /**
     * @param Collection<array-key, Block> $blocks
     * @return array{created: array, deleted: array, updated: array}
     */
    public function execute(Collection $blocks): array
    {
        $changes = [
            'created' => [], 'deleted' => [], 'updated' => [],
        ];

        $models = $this->content->blocks()->get();

        $ids = [
            'current' => $models->modelKeys(),
            'records' => $blocks->map(fn (Block $block) => $block->getKey())->filter()->toArray(),
        ];

        $deleted = array_diff($ids['current'], $ids['records']);

        if (count($deleted)) {
            $models
                ->filter(fn (Block $block) => in_array($block->getKey(), $deleted))
                ->each(fn (Block $block) => $block->forceDelete());

            $changes['deleted'] = $deleted;
        }

        $blocks->each(function (Block $block) use ($ids, $models, &$changes) {
            $block->content_id = $this->content->getKey();

            if (! in_array($block->getKey(), $ids['current'])) {
                $block->setAttribute($block->getKeyName(), null);
                $block->save();

                $changes['created'][] = $block->getKey();
            } else {
                $model = $models->find($block->getKey());

                $model->setRawAttributes(
                    array_merge(
                        $model->getAttributes(),
                        $block->getAttributes()
                    )
                );

                if ($model->isDirty()) {
                    $model->save();

                    $changes['updated'][] = $block->getKey();
                }
            }
        });

        return $changes;
    }
}
