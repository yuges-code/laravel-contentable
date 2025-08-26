<?php

namespace Yuges\Contentable\Interfaces;

use Yuges\Contentable\Models\Content;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Contentable
{
    public function contents(): MorphMany;

    public function content(string $content): Content;
}
