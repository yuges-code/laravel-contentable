<?php

namespace Yuges\Contentable\Tests\Integration;

use Yuges\Contentable\Tests\TestCase;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Data\Editor\Editor;
use Yuges\Contentable\Data\Blocks\Paragraph;
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

        $post->content->blocks()->create([
            'data' => New Paragraph('test'),
        ]);

        $block = $post->content->blocks->first();

        $this->assertInstanceOf(Paragraph::class, $block->data);
        $this->assertEquals('test', $block->data->text);
        $this->assertEquals(BlockType::Paragraph, $block->type);
    }
}
