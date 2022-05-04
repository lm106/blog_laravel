<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name', 'name_last', 'email', 'password', 'type'
    ];
    protected $table = 'user';

    public function nameComment() {
        return $this->hasMany('App\Models\Comment', 'user_id');
    }
}
