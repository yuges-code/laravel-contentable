<?php

namespace Yuges\Contentable\Traits;

use Yuges\Contentable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Yuges\Contentable\Interfaces\Contentable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $contentable_type
 * @property int|string $contentable_id
 * 
 * @property ?Contentable $contentable
 */
trait HasContentable
{
    public function contentable(): MorphTo
    {
        /** @var Model $this */
        return $this->morphTo(Config::getContentableRelationName('contentable'));
    }
}
