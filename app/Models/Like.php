<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Like extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'user_id', 'recipe_id'
    ];
    protected $table = 'likes';
}
