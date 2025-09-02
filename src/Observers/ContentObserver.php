<?php

namespace Yuges\Contentable\Observers;

use Carbon\Carbon;
use Yuges\Contentable\Models\Content;
use Yuges\Contentable\Calculators\DurationCalculator;

class ContentObserver
{
    public function creating(Content $content): void
    {
        $content->selected_at ??= Carbon::now();
    }

    public function saving(Content $content): void
    {
        $content->duration = new DurationCalculator()->setContent($content)->calculate();
    }

    public function deleted(Content $content): void
    {

    }
}
