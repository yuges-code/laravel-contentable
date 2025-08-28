<?php

namespace Yuges\Contentable\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property ?Carbon $selected_at
 */
trait HasSelected
{
    public function initializeHasSelected()
    {
        /** @var Model $this */
        $this->mergeCasts([
            'selected_at' => 'datetime',
        ]);
    }

    public function select(): self
    {
        $this->selected_at = Carbon::now();

        /** @var Model $this */
        $this->save();

        return $this;
    }
}
