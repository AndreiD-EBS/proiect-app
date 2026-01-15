<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between gap-4 mb-6">
        <h1 class="text-3xl font-bold tracking-tight">User Management</h1>

        <div class="flex items-center gap-3">
            <input
                type="search"
                wire:model.live="q"
                placeholder="Search name, email, role..."
                class="w-80 rounded-lg border-gray-300 focus:border-black focus:ring-black"
            />
        </div>
    </div>

    <div class="bg-white border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="text-left font-medium px-4 py-3">Name</th>
                        <th class="text-left font-medium px-4 py-3">Email</th>
                        <th class="text-left font-medium px-4 py-3">Role</th>
                        <th class="text-right font-medium px-4 py-3">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($users as $user)
                        @php
                            $isMe = $user->id === $meId;
                            $isAdmin = $user->role === 'admin';
                            $roleLocked = $isMe || $isAdmin;
                            $deleteLocked = $isMe || $isAdmin;
                        @endphp

                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">
                                    {{ $user->name }}
                                    @if($isMe)
                                        <span class="ml-2 text-xs text-gray-500">(you)</span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                {{ $user->email }}
                            </td>

                            <td class="px-4 py-3">
                                @if($roleLocked)
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-1 text-gray-700">
                                        {{ $user->role }}
                                    </span>
                                @else
                                    <select
                                        class="rounded-lg border-gray-300 focus:border-black focus:ring-black"
                                        wire:change="updateRole({{ $user->id }}, $event.target.value)"
                                    >
                                        <option value="user" @selected($user->role === 'user')>user</option>
                                        <option value="editor" @selected($user->role === 'editor')>editor</option>
                                    </select>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-right">
                                <button
                                    type="button"
                                    wire:click="deleteUser({{ $user->id }})"
                                    class="inline-flex rounded-lg border px-3 py-1.5 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                                    @disabled($deleteLocked)
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-4 py-4">
            {{ $users->links() }}
        </div>
    </div>

    <div class="mt-4 text-sm text-gray-500">
        You can only assign <span class="font-medium">user</span> or <span class="font-medium">editor</span>,
        admins cannot be changed.
    </div>
</div>
