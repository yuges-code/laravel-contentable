<?php

namespace Yuges\Contentable\Enums;

enum BlockType: string
{
    case List = 'list';
    case Header = 'header';
    case Paragraph = 'paragraph';
}
