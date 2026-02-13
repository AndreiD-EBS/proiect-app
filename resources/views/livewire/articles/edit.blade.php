<div class="mx-4">
    <header class="mb-6">
        <input
            type="text"
            wire:model.defer="title"
            class="w-full text-3xl font-bold tracking-tight border-0 border-b border-gray-300 focus:ring-0 focus:border-black"
        />

        <textarea
            wire:model.defer="excerpt"
            rows="2"
            class="w-full mt-3 text-gray-600 border-gray-300 rounded-lg focus:border-black focus:ring-black"
            placeholder="Excerpt"
        ></textarea>

        <div class="mt-4 flex flex-wrap gap-3">
            <input
                type="text"
                wire:model.defer="category"
                class="rounded-lg border-gray-300 focus:border-black focus:ring-black"
                placeholder="Category"
            />

            <input
                type="text"
                wire:model.defer="author_name"
                class="rounded-lg border-gray-300 focus:border-black focus:ring-black"
                placeholder="Author"
            />

            <input
                type="datetime-local"
                wire:model.defer="published_at"
                class="rounded-lg border-gray-300 focus:border-black focus:ring-black"
            />


           <label class="inline-flex items-center gap-2">
                <input
                    type="checkbox"
                    wire:model.defer="published"
                    class="rounded border-gray-300 text-green-600 focus:ring-green-500"
                >
                <span class="text-sm text-gray-700">Visible</span>
            </label>
        </div>
    </header>

    <div>
        <textarea
            wire:model.defer="body"
            rows="14"
            class="w-full border-gray-300 rounded-lg focus:border-black focus:ring-black font-mono"
        ></textarea>
    </div>

    <div class="mt-6 flex gap-3">
        <button
            wire:click="save"
            class="rounded-lg bg-black px-4 py-2 text-white hover:bg-gray-800"
        >
            Save
        </button>

        <a
            href="{{ route('articles.show', $article->slug) }}"
            class="rounded-lg border px-4 py-2 hover:bg-gray-50"
        >
            Cancel
        </a>

         <button
            wire:click="delete"
            class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700"
            onclick="return confirm('Are you sure you want to delete this article?')"
        >
            Delete
        </button>
    </div>


</div>
