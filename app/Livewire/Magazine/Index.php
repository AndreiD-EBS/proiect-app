<?php

namespace App\Livewire\Magazine;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $q = '';
    public ?string $category = null;

    protected $queryString = [
        'q' => ['except' => ''],
        'category' => ['except' => null],
        'page' => ['except' => 1],
    ];

    public function updatingQ(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->q = '';
        $this->category = null;
        $this->resetPage();
    }

    public function render()
    {
        $base = Article::query()
            ->published()
            ->when($this->q !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->q . '%')
                      ->orWhere('excerpt', 'like', '%' . $this->q . '%');
                });
            })
            ->when($this->category, fn ($q) => $q->where('category', $this->category));

        $categories = Article::query()
            ->published()
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $articles = $base
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('livewire.magazine.index', [
            'articles' => $articles,
            'categories' => $categories,
        ])->title('Magazine');
    }
}
