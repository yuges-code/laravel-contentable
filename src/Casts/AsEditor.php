<?php

namespace Yuges\Contentable\Casts;

use InvalidArgumentException;
use Yuges\Contentable\Data\Editor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AsEditor implements CastsAttributes
{
    public function get(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): ?Editor {
        $value = json_decode($value, true);

        return new Editor(
            $value['name'] ?? null,
            $value['version'] ?? null,
        );
    }

    public function set(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): ?array {
        if (! $value) {
            return null;
        }

        if (! $value instanceof Editor) {
            throw new InvalidArgumentException('The given value is not an Editor instance.');
        }

        return [
            'editor' => json_encode([
                'name' => $value?->name,
                'version' => $value?->version,
            ]),
        ];
    }
}
