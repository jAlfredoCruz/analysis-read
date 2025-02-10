<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Misinformation extends Model
{
    use HasFactory;


    public function shortText()
    {
        $limitText = Str::limit($this->text, 15);
        return Str::markdown($limitText);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
