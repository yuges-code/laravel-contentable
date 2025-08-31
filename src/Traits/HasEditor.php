<?php

namespace Yuges\Contentable\Traits;

use Illuminate\Database\Eloquent\Model;
use Yuges\Contentable\Data\Editor\Editor;

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
