<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Perfil extends Model
{
    use HasFactory;

   public function points() : string
    {

        $count = substr_count($this->level, '.');

        if($count == 1){
            return "";
        }

        $td = "";
        for($i = 1; $i <= $count; $i++){
            $td .= "<td></td>";
        }

        return $td;

    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}
