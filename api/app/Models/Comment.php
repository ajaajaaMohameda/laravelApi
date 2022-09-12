<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $casts = [
        'body' => 'array' // convert json to array when getting data from db
    ];

    protected $fillable = [
        'body',
        'user_id',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');

    }

    function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
