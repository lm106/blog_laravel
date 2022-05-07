<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class List_private extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name', 'user_id', 'recipe_id'
    ];
    protected $table = 'list';
}
