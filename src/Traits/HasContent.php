<?php

namespace Yuges\Contentable\Traits;

use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Models\Content;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Content $content
 * @property int|string $content_id
 */
trait HasContent
{
    public function content(): BelongsTo
    {
        return $this->belongsTo(Config::getContentClass(Content::class));
    }
}
