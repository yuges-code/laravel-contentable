<?php

namespace Yuges\Contentable\Data\Editor;

use Spatie\LaravelData\Data;
use Yuges\Contentable\Casts\AsEditor;
use Illuminate\Contracts\Database\Eloquent\Castable;

class Editor extends Data implements Castable
{
    public function __construct(
        public ?string $name,
        public ?string $version,
    ) {
    }

    public static function castUsing(array $arguments): string
    {
        return AsEditor::class;
    }
}
