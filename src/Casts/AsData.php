<?php

namespace Yuges\Contentable\Casts;

use TypeError;
use InvalidArgumentException;
use Yuges\Contentable\Models\Block;
use Illuminate\Database\Eloquent\Model;
use Yuges\Contentable\Abstracts\BlockData;
use Yuges\Contentable\Interfaces\BlockDataInterface;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AsData implements CastsAttributes
{
    public function get(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): ?BlockDataInterface {
        if (! $model instanceof Block) {
            throw new TypeError('model type error');
        }

        return BlockData::fromJsonData($model->type, $value);
    }

    public function set(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): ?array {
        if (! $value instanceof BlockDataInterface) {
            throw new InvalidArgumentException('The given value is not an Block Data instance.');
        }

        if (! $model instanceof Block) {
            throw new TypeError('model type error');
        }

        return [
            'type' => $value->getType()->value,
            'data' => $value->toJsonData(),
        ];
    }
}
