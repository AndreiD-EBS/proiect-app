<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    public string $q = '';
    public int $perPage = 20;

    protected $queryString = [
        'q' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount(): void
    {
        abort_unless(Auth::check() && Auth::user()->role === 'admin', 403);
    }

    public function updatingQ(): void
    {
        $this->resetPage();
    }

    public function updateRole(int $userId, string $role): void
    {
        abort_unless(Auth::user()->role === 'admin', 403);

        if (!in_array($role, ['user', 'editor'], true)) {
            return;
        }

        $user = User::findOrFail($userId);

        if ($user->id === Auth::id()) {
            return;
        }

        if ($user->role === 'admin') {
            return;
        }

        $user->role = $role;
        $user->save();
    }

    public function deleteUser(int $userId): void
    {
        abort_unless(Auth::user()->role === 'admin', 403);

        $user = User::findOrFail($userId);

        if ($user->id === Auth::id()) {
            return;
        }

        if ($user->role === 'admin') {
            return;
        }

        $user->delete();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->q !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->q . '%')
                      ->orWhere('email', 'like', '%' . $this->q . '%')
                      ->orWhere('role', 'like', '%' . $this->q . '%');
                });
            })
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.admin.user-management', [
            'users' => $users,
            'meId' => Auth::id(),
        ]);
    }
}
