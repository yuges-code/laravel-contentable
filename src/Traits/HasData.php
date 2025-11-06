<?php

namespace Yuges\Contentable\Traits;

use Yuges\Contentable\Casts\AsData;
use Illuminate\Database\Eloquent\Model;
use Yuges\Contentable\Interfaces\BlockDataInterface;

/**
 * @property BlockDataInterface $data
 */
trait HasData
{
    public function initializeHasData()
    {
        /** @var Model $this */
        $this->mergeCasts([
            'data' => AsData::class,
        ]);
    }
}
