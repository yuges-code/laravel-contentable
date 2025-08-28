<?php

namespace Yuges\Contentable\Observers;

use Carbon\Carbon;
use Yuges\Contentable\Models\Content;

class ContentObserver
{
    public function creating(Content $content): void
    {
        $content->selected_at ??= Carbon::now();
    }

    public function deleted(Content $content): void
    {

    }
}
