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

    /**
     * Get array of tags (comma-separated genre field)
     */
    public function getTags()
    {
        if (!$this->genre) {
            return [];
        }
        return array_filter(array_map('trim', explode(',', $this->genre)));
    }

    /**
     * Get all unique tags from all books
     */
    public static function getAllTags()
    {
        $allTags = [];
        self::all()->each(function ($book) use (&$allTags) {
            $tags = $book->getTags();
            foreach ($tags as $tag) {
                if (!in_array($tag, $allTags)) {
                    $allTags[] = $tag;
                }
            }
        });
        sort($allTags);
        return $allTags;
    }

    /**
     * Filter books by tags
     */
    public static function filterByTags($tags)
    {
        if (empty($tags)) {
            return self::with('user')->latest();
        }

        return self::with('user')->latest()->where(function ($query) use ($tags) {
            foreach ($tags as $tag) {
                $query->orWhere('genre', 'like', "%{$tag}%");
            }
        });
    } 

    protected $casts = [
        'published_at' => 'date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
