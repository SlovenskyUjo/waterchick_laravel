<?php

namespace App\Models;

use App\Http\Controllers\PluginController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function plugins()
    {
        return $this->belongsToMany(Plugin::class);
    }
}
