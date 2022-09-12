<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'body' => 'array' // convert json to array when getting data from db
    ];

    protected $fillable = ['name', 'body'];

    protected $hidden = ['name']; //hidden from response

    protected $appends = ['name_upper_case'];

    public function getNameUpperCaseAttribute()
    {
      return strtoupper($this->name);
    }

    public function setNameAttribute($value)
    {
      $this->attributes['name'] = strtolower($value);
    }

    public function comments() {

      return   $this->hasMany(Comment::class, 'post_id');
    }

    public function users()
    {
      return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}
