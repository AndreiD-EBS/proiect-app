<div class="mx-4 my-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold tracking-tight">Create Article</h1>

        <a
            href="{{ route('magazine.index') }}"
            class="rounded-lg border px-4 py-2 hover:bg-gray-50 text-sm"
        >
            Back
        </a>
    </div>

    <div class="bg-white rounded-xl border p-5">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input
                    type="text"
                    wire:model.defer="title"
                    class="w-full rounded-lg border-gray-300 focus:border-black focus:ring-black"
                    placeholder="Headline"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                <textarea
                    wire:model.defer="excerpt"
                    rows="2"
                    class="w-full rounded-lg border-gray-300 focus:border-black focus:ring-black"
                    placeholder="Short summary shown on the listing page"
                ></textarea>
            </div>

            <div class="flex flex-wrap gap-3">
                <div class="min-w-[220px] flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <input
                        type="text"
                        wire:model.defer="category"
                        class="w-full rounded-lg border-gray-300 focus:border-black focus:ring-black"
                        placeholder="e.g. Tech"
                    />
                </div>

                <div class="min-w-[220px] flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                    <input
                        type="text"
                        wire:model.defer="author_name"
                        class="w-full rounded-lg border-gray-300 focus:border-black focus:ring-black"
                        placeholder="Author name"
                    />
                </div>

                <div class="min-w-[260px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Published at</label>
                    <input
                        type="datetime-local"
                        wire:model.defer="published_at"
                        class="w-full rounded-lg border-gray-300 focus:border-black focus:ring-black"
                    />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea
                    wire:model.defer="body"
                    rows="14"
                    class="w-full rounded-lg border-gray-300 focus:border-black focus:ring-black font-mono"
                    placeholder="Write the article HTML or text here..."
                ></textarea>
            </div>

            <div class="pt-2 flex gap-3">
                <button
                    type="button"
                    wire:click="save"
                    class="rounded-lg bg-black px-4 py-2 text-white hover:bg-gray-800"
                >
                    Create
                </button>

                <a
                    href="{{ route('magazine.index') }}"
                    class="rounded-lg border px-4 py-2 hover:bg-gray-50"
                >
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
