<?php

namespace Yuges\Contentable\Models;

use Yuges\Contentable\Config\Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends \Yuges\Package\Models\Model
{
    use HasFactory;

    protected $table = 'content_blocks';

    protected $guarded = ['id'];

    public function getTable(): string
    {
        return Config::getBlockTable() ?? $this->table;
    }
}
