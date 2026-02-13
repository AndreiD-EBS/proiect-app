<?php

namespace App\Livewire\Articles;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Show extends Component
{
    public Article|null $article;
    public bool $filled_like_button;
    public int $likeCount;

    public function mount($slug)
    {
        Log::info('Article mounted');
        
        $this->article = Article::published()->where('slug', $slug)->firstOrFail();
        
        if($this->article->likedByUsers()->get()->contains(Auth::user()))
        {
            $this->filled_like_button = true;   
            Log::info('Current user likes the post');
        }
        else
        {
            $this->filled_like_button = false;   
            Log::info('Current user does not like the post');
        }
        $this->likeCount = $this->article->likedByUsers()->get()->count();
    }
    public function render()
    {
        return view('livewire.articles.show')->layout('layouts.app');
    }
    public function toggleLike($article_id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $currentUser = Auth::user();
        $this->likeCount = $this->article->likedByUsers()->get()->count();
        if($this->article->likedByUsers()->get()->contains(Auth::user()))
        {
            $this->filled_like_button = false;   
            $this->likeCount--;
            Log::info('Current user unliked the post');
            $this->article->likedByUsers()->detach($currentUser->id);
        }
        else
        {
            $this->likeCount++;
            $this->filled_like_button = true;   
            Log::info('Current user liked the post');
            $this->article->likedByUsers()->attach($currentUser->id);
        }
        $this->render();
    }
}
