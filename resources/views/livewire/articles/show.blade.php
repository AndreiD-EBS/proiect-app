<div>
    <header class="mb-6 ml-4">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold tracking-tight">
                {{ $article->title }}
            </h1>
            @auth
                @if(auth()->user()->role === 'editor' || auth()->user()->role === 'admin')
                <a
                    href="{{ route('articles.edit', $article->slug) }}"
                    class="inline-flex px-3 mr-6 mt-4 py-1 bg-gray-600 text-white rounded hover:bg-gray-700 text-sm"
                >
                    Edit
                </a>
                @endif
            @endauth

        </div>



        @if ($article->excerpt)
            <p class="text-gray-600 mt-2">
                {{ $article->excerpt }}
            </p>
        @endif

        <div class="mt-3 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-gray-500">
            @if ($article->category)
                <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-1">
                    {{ $article->category }}
                </span>
            @endif

            @if ($article->author_name)
                <span>By {{ $article->author_name }}</span>
            @endif

            @if ($article->published_at)
                <span>• {{ $article->published_at->format('M j, Y') }}</span>
            @endif
        </div>
    </header>

    <div class="prose prose-lg max-w-none mx-4">
        {!! $article->body !!}
    </div>
    <div class="mx-4 mt-8">
        <a href="{{ route('magazine.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 text-sm">
            &larr; Back to Articles
        </a>
    </div>
</div>
