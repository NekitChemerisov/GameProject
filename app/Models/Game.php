<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genre');
    }
}
