<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $table = 'books';
    protected $fillable = [
        'category_id',
        'title',
        'author',
        'available',
        'thumbnail',
        'pages',
        'publisher_date',
        'language',
        'content',
    ];
    public function users()
    {
        return $this->belongsToMany('App\Entities\Auth\User', 'book_user', 'book_id', 'user_id');
    }
    public function category()
    {
        return $this->hasOne('App\Entities\Category', 'id', 'category_id');
    }
}
