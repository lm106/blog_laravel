<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'description', 'user_id', 'recipe_id'
    ];
    protected $table = 'comment';

    public function nameUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
