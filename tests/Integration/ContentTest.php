<?php

namespace Yuges\Contentable\Tests\Integration;

use Carbon\Carbon;
use Yuges\Contentable\Data\Editor;
use Yuges\Contentable\Models\Content;
use Yuges\Contentable\Tests\TestCase;
use Yuges\Contentable\Tests\Stubs\Models\Post;

class ContentTest extends TestCase
{
    public function testContentPost()
    {
        $post = Post::query()->create([
            'title' => 'New post',
        ]);

        $this->assertDatabaseHas(Post::getTableName('posts'), [
            'id' => $post->id,
            'title' => 'New post',
        ]);

        $post->content()->create([
            'editor' => new Editor('test', '1.0.0'),
            'selected_at' => Carbon::now(),
        ]);

        $post = Post::query()->first();

        $this->assertEquals('test', $post->content?->editor?->name);
        $this->assertEquals('1.0.0', $post->content?->editor?->version);
    }
}
