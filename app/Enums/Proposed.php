<?php

namespace App\Enums;

enum Proposed: string {
    case NOCATEGORY = 'no_category';
    case PRACTICAL = 'practical';
    case LITERATURE = 'literature';
    case LYRIC = 'lyric';
    case HISTORY = 'history';
    case MATHANDSCIENCE = 'mathemathics_and_science';
    case PHILOSOPHY = 'philosofy';
    case SOCIALSCIENCE = 'social_science';

    public function toString(): string
    {
        return $this->value;
    }
}
