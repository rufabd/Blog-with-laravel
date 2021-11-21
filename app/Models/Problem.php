<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'body',
        // 'user_id',
    ];

    // public function user() {
    //     return $this->belongsTo(User::class);
    // }
}
