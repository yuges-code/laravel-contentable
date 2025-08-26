<?php

namespace Yuges\Contentable\Tests\Feature;

use Yuges\Contentable\Tests\TestCase;
use Yuges\Contentable\Tests\Stubs\Models\User;

class HasTableTest extends TestCase
{
    public function testGettingTableName()
    {
        $this->assertEquals('users', User::getTableName());
    }
}
