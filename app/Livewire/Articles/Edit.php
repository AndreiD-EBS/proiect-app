<?php

namespace App\Livewire\Articles;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class Edit extends Component
{
    public Article $article;

    public string $title = '';
    public ?string $excerpt = null;
    public ?string $category = null;
    public ?string $author_name = null;
    public ?string $published_at = null;
    public string $body = '';

    public function mount(string $slug): void
    {
        $this->article = Article::where('slug', $slug)->firstOrFail();

        $this->title = $this->article->title;
        $this->excerpt = $this->article->excerpt;
        $this->category = $this->article->category;
        $this->author_name = $this->article->author_name;
        $this->published_at = optional($this->article->published_at)->format('Y-m-d\TH:i');
        $this->body = $this->article->body;
    }

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

        $this->article->update([
            'title' => $this->title,
            'slug' => $slug,
            'excerpt' => $this->excerpt,
            'category' => $this->category,
            'author_name' => $this->author_name,
            'published_at' => $this->published_at,
            'body' => $this->body,
        ]);

        $this->redirectRoute('articles.show', $this->article->slug);
    }

    public function delete(): void
    {
        $this->article->delete();

        $this->redirectRoute('magazine.index');
    }

    public function render()
    {
        return view('livewire.articles.edit');
    }
}
