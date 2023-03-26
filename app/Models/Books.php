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
        return $this->belongsTo(authors::class);
    }

    public function categories()
    {
        return $this->belongsTo(categories::class);
    }

    public function ratings()
    {
        return $this->hasMany(ratings::class);
    }
}
