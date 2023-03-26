<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function books()
    {
        return $this->hasMany(Books::class);
    }

    public function ratings()
    {
        return $this->hasManyThrough(ratings::class, books::class);
    }
}
