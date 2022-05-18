<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LikeComment extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'user_id', 'comment_id'
    ];
    protected $table = 'like_comment';

    public function nameUser() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nameComment() {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

}
