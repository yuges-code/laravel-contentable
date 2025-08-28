<?php

namespace Yuges\Contentable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;
use Yuges\Contentable\Traits\HasContent;
use Yuges\Contentable\Interfaces\Contentable;

class Post extends Model implements Contentable
{
    use HasContent;

    protected $table = 'posts';

    protected $guarded = ['id'];
}
