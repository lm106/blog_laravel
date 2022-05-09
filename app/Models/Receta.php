<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Receta extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'title', 'image', 'description', 'ingredients', 'user_id'
    ];
    protected $table = 'receta';

    public function n_likes() {
        return $this->hasMany('App\Models\Like', 'recipe_id');
    }

    public function n_comment() {
        return $this->hasMany('App\Models\Comment', 'recipe_id');
    }
}
