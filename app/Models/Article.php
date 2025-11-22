<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'published', 'published_at'
    ];

    protected $dates = ['published_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
    public function getRouteKeyName()
{
    return 'slug';
}
}
