<?php

namespace Yuges\Contentable\Providers;

use Yuges\Package\Data\Package;
use Yuges\Contentable\Models\Block;
use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Models\Content;
use Yuges\Contentable\Observers\BlockObserver;
use Yuges\Contentable\Exceptions\InvalidBlock;
use Yuges\Contentable\Observers\ContentObserver;
use Yuges\Contentable\Exceptions\InvalidContent;
use Yuges\Package\Providers\PackageServiceProvider;

class ContentableServiceProvider extends PackageServiceProvider
{
    protected string $name = 'laravel-contentable';

    public function configure(Package $package): void
    {
        $block = Config::getBlockClass(Block::class);
        $content = Config::getContentClass(Content::class);

        if (! is_a($block, Block::class, true)) {
            throw InvalidBlock::doesNotImplementBlock($block);
        }

        if (! is_a($content, Content::class, true)) {
            throw InvalidContent::doesNotImplementContent($content);
        }

        $package
            ->hasName($this->name)
            ->hasConfig('contentable')
            ->hasMigrations([
                '000_create_contents_table',
                '001_create_content_blocks_table',
            ])
            ->hasObserver($block, Config::getBlockObserverClass(BlockObserver::class))
            ->hasObserver($content, Config::getContentObserverClass(ContentObserver::class));
    }
}
