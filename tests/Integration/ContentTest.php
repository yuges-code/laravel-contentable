<?php

namespace Yuges\Contentable\Tests\Integration;

use Illuminate\Support\Collection;
use Yuges\Contentable\Models\Block;
use Yuges\Contentable\Tests\TestCase;
use Yuges\Contentable\Enums\BlockType;
use Yuges\Contentable\Enums\ListStyle;
use Yuges\Contentable\Enums\HeaderLevel;
use Yuges\Contentable\Data\Editor\Editor;
use Yuges\Contentable\Data\Blocks\ListData;
use Yuges\Contentable\Data\Blocks\HeaderData;
use Yuges\Contentable\Tests\Stubs\Models\Post;
use Yuges\Contentable\Tests\Stubs\Blocks\ParagraphData;

class ContentTest extends TestCase
{
    public function testContentPost()
    {
        new ParagraphData('test');

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
            'data' => New HeaderData('test', HeaderLevel::Level3),
        ]);

        $listBlock = $post->content->blocks()->create([
            'data' => New ListData(
                [],
                ListStyle::Unordered,
            ),
        ]);

        $blocks = Collection::make([
            new Block([
                'data' => New ListData(
                    ['first', 'second'],
                    ListStyle::Unordered,
                ),
            ]),
            new Block([
                'id' => $listBlock->getKey(),
                'data' => New ListData(
                    ['test'],
                    ListStyle::Unordered,
                ),
            ]),
        ]);

        $post->updateContent([], $blocks);

        $block = $post->content->blocks->first();

        $this->assertInstanceOf(ListData::class, $block->data);
        $this->assertEquals(ListStyle::Unordered, $block->data->style);
        $this->assertEquals(['test'], $block->data->items);
        $this->assertEquals(BlockType::List, $block->type);
    }
}
