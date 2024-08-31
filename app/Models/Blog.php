<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'file_path',
        'body',
        'user_id'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
