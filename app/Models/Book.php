<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Baethon\LaravelCriteria\Traits\AppliesCriteria;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use AppliesCriteria;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }

    public function questions()
    {
        return $this->hasMany(GeneralQuestion::class,);
    }

    public function category()
    {
        return $this->belongsTo(MyOwnCategory::class, 'my_own_category_id');
    }

    public function synthesis()
    {
        return $this->hasOne(Synthesis::class);
    }

    public function perfils()
    {
        return $this->hasMany(Perfil::class);
    }

    public function problems()
    {
        return $this->hasMany(Problem::class);
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    public function sentences()
    {
        return $this->hasMany(Sentence::class);
    }

    public function arguments()
    {
        return $this->hasMany(Argument::class);
    }

    public function desinformations()
    {
        return $this->hasMany(Desinformation::class);
    }

    public function misinformations()
    {
        return $this->hasMany(Misinformation::class);
    }

    public function ilogics()
    {
        return $this->hasMany(Ilogic::class);
    }

    public function incompletes()
    {
        return $this->hasMany(Incomplete::class);
    }
}
