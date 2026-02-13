<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'body', 'category', 'author_name',
        'published_at', 'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function scopePublished(Builder $query): Builder
    {
        if(Auth::user() && (Auth::user()->role == 'editor' || Auth::user()->role == 'admin'))
        {
            return $query;   
        }
        return $query
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function likedByUsers() : belongsToMany
    {
        return $this->belongsToMany(User::class, 'userlikes', 'article_id', 'user_id');
    }
}
