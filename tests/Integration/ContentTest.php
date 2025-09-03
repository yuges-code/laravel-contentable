<?php

namespace Yuges\Contentable\Tests\Integration;

use Yuges\Contentable\Tests\TestCase;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Enums\ListStyle;
use Yuges\Contentable\Data\Editor\Editor;
use Yuges\Contentable\Data\Blocks\ItemList;
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
        ]);

        $post = Post::query()->first();

        $this->assertEquals('test', $post->content?->editor?->name);
        $this->assertEquals('1.0.0', $post->content?->editor?->version);

        // $post->content->blocks()->create([
        //     'data' => New Header(HeaderLevel::Level3, 'test'),
        // ]);

        $post->content->blocks()->create([
            'data' => New ItemList(ListStyle::Unordered, []),
        ]);

        $block = $post->content->blocks->first();

        $this->assertInstanceOf(ItemList::class, $block->data);
        $this->assertEquals(ListStyle::Unordered, $block->data->style);
        $this->assertEquals([], $block->data->items);
        $this->assertEquals(BlockType::List, $block->type);
    }
}
