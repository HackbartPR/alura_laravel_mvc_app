<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $casts = ['watched' => 'boolean'];

    public function seasons()
    {
        return $this->belongsTo(Season::class);
    }
}
