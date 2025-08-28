<?php

namespace Yuges\Contentable\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Contentable
{
    public function content(): MorphOne;

    public function contents(): MorphMany;
}
