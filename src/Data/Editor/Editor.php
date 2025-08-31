<?php

namespace Yuges\Contentable\Data\Editor;

use Yuges\Contentable\Casts\AsEditor;
use Illuminate\Contracts\Database\Eloquent\Castable;

class Editor implements Castable
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
