<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public string $title = '';
    public ?string $excerpt = null;
    public ?string $category = null;
    public ?string $author_name = null;
    public ?string $published_at = null;
    public string $body = '';

    public function save(): void
    {
        $baseSlug = Str::slug($this->title);
        $slug = $baseSlug !== '' ? $baseSlug : Str::random(10);

        $n = 2;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug !== '' ? "{$baseSlug}-{$n}" : Str::random(10);
            $n++;
        }

        if(str_contains($this->body, '<script'))
        {
            $this->body=str_replace('<script', '&lt;script', $this->body);
        }
        if(str_contains($this->body, '</script>'))
        {
            $this->body=str_replace('</script>', '&lt;/script&gt;', $this->body);
        }

        $article = Article::create([
            'title' => $this->title,
            'slug' => $slug,
            'excerpt' => $this->excerpt,
            'category' => $this->category,
            'author_name' => $this->author_name,
            'published_at' => $this->published_at,
            'body' => $this->body,
            'is_published' => true,
        ]);

        $this->redirectRoute('articles.show', $article->slug);
    }

    public function render()
    {
        return view('livewire.articles.create');
    }
}
