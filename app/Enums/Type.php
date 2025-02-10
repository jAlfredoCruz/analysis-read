<?php

namespace App\Enums;

enum Type: string {
    case NOCATEGORY ='no_category';
    case NOAPPLY = "no_apply";
    case PRACTICAL = "practical";
    case THEORETICAL = "theoretical";

    public function toString(): string
    {
        return $this->value;
    }
}
