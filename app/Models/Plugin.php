<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'url',
        'category',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}

