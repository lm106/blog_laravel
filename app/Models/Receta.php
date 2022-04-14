<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'title', 'description', 'ingredients'
    ];
    protected $table = 'receta';
}
