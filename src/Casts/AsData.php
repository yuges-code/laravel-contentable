<?php

namespace Yuges\Contentable\Casts;

use TypeError;
use InvalidArgumentException;
use Yuges\Contentable\Models\Block;
use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Enums\BlockType;
use Illuminate\Database\Eloquent\Model;
use Yuges\Contentable\Abstracts\BlockData;
use Yuges\Contentable\Factories\BlockDataFactory;
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
        if (! $model instanceof Block) {
            throw new TypeError('model type error');
        }

        if ($value instanceof BlockDataInterface) {
            return [
                'type' => $value->getType()->value,
                'data' => $value->toJsonData(),
            ];
        }

        if (is_array($value)) {
            $type = Config::getBlockTypeClass(BlockType::class)::from($value['type']);

            return [
                'type' => $type->value,
                'data' => BlockDataFactory::create($type,$value)->toJsonData(),
            ];
        }

        throw new InvalidArgumentException('The given value is not an Block Data instance or array.');
    }
}
