<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'user_id',
        'cover',
        'published_at',
        'genre',
        'rating',
    ]; 

    protected $casts = [
        'published_at' => 'date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
