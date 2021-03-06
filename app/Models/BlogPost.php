<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'body',
        'imageLink',
        'author',
        // 'date',
        // 'time',
        // 'category_id'
    ];

    // public function comments() {
    //     return $this->hasMany(Comment::class);
    // }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }

    
}
