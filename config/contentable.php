<?php

// Config for yuges/contentable

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for content
     */
    'models' => [
        'block' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'table' => 'content_blocks',
            'class' => Yuges\Contentable\Models\Block::class,
            'observer' => Yuges\Contentable\Observers\BlockObserver::class,
        ],
        'content' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'table' => 'contents',
            'class' => Yuges\Contentable\Models\Content::class,
            'observer' => Yuges\Contentable\Observers\ContentObserver::class,
        ],
        'contentable' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'allowed' => [
                'classes' => [
                    // \App\Models\User::class,
                ],
            ],
            'relation' => [
                'name' => 'contentable',
            ],
            'observer' => Yuges\Contentable\Observers\ContentableObserver::class,
        ],
    ],

    'block' => [
        'type' => Yuges\Contentable\Enums\BlockType::class,
        'data' => [
            Yuges\Contentable\Data\Blocks\ListData::class,
            Yuges\Contentable\Data\Blocks\QuoteData::class,
            Yuges\Contentable\Data\Blocks\HeaderData::class,
            Yuges\Contentable\Data\Blocks\ParagraphData::class,
            Yuges\Contentable\Data\Blocks\DelimiterData::class,
        ],
    ],

    'actions' => [
        
    ],
];
