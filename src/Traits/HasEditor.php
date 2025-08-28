<?php

namespace Yuges\Contentable\Traits;

use Yuges\Contentable\Data\Editor;
use Illuminate\Database\Eloquent\Model;

/**
 * @property ?Editor $editor
 */
trait HasEditor
{
    public function initializeHasEditor()
    {
        /** @var Model $this */
        $this->mergeCasts([
            'editor' => Editor::class,
        ]);
    }
}
