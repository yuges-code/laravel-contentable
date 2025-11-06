<?php

namespace Yuges\Contentable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;
use Yuges\Contentable\Traits\HasContents;
use Yuges\Contentable\Interfaces\Contentable;

class Post extends Model implements Contentable
{
    use HasContents;

    protected $table = 'posts';

    protected $guarded = ['id'];
}
