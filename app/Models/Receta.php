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
        'title', 'description', 'ingredients', 'user_id'
    ];
    protected $table = 'receta';
}
