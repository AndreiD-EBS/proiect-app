<div class="max-w-5xl mx-auto px-4 py-10">
    <header class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Online Magazine</h1>
        <div class="flex items-center justify-between mt-2 mb-4">
            <p class="text-gray-600 mt-2">Fresh stories every day.</p>
            <a
                    href="{{ route('articles.create') }}"
                    class="inline-flex px-3 py-1 bg-blue-600 text-white h-a rounded hover:bg-blue-700 text-sm"
                >
                    + New Article
                </a>
        </div>
    </header>

    <section class="mb-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div class="flex gap-3 items-center w-full md:w-auto">
            <div class="w-full md:w-80">
                <input
                    type="search"
                    wire:model.live="q"
                    placeholder="Search headlines..."
                    class="w-full rounded-lg border-gray-300 focus:border-black focus:ring-black"
                />
            </div>

            <div class="w-full md:w-56">
                <select
                    wire:model.live="category"
                    class="w-full rounded-lg border-gray-300 focus:border-black focus:ring-black"
                >
                    <option value="">All categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <button
                type="button"
                wire:click="clearFilters"
                class="shrink-0 rounded-lg border px-3 py-2 text-sm hover:bg-gray-50"
            >
                Clear
            </button>
        </div>

        <div class="text-sm text-gray-500">
            Showing {{ $articles->firstItem() ?? 0 }}–{{ $articles->lastItem() ?? 0 }} of {{ $articles->total() }}
        </div>
    </section>

    <main class="divide-y divide-gray-200 rounded-xl border bg-white">
        @forelse ($articles as $article)
            <article class="p-5 hover:bg-gray-50 transition">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <a
                            href="{{ route('articles.show', $article->slug) }}"
                            class="block text-lg font-semibold text-gray-900 hover:underline truncate"
                        >
                            {{ $article->title }}
                        </a>

                        @if ($article->excerpt)
                            <p class="text-gray-600 mt-1">
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
                    </div>

                    <div class="shrink-0 text-sm text-gray-500">
                        {{ $article->published_at?->format('H:i') }}
                    </div>
                </div>
            </article>
        @empty
            <div class="p-10 text-center text-gray-600">
                No articles found.
            </div>
        @endforelse
    </main>

    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</div>
