<?php

namespace Yuges\Contentable\Enums;

enum BlockType: string implements \Yuges\Contentable\Interfaces\BlockType
{
    case List = 'list';
    case Header = 'header';
    case Paragraph = 'paragraph';
}
