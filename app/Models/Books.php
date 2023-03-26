<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function authors()
    {
        return $this->belongsTo(Authors::class);
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class);
    }
}
