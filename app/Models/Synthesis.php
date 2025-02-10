<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synthesis extends Model
{
    use HasFactory;

    protected $table = "syntheses";

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
