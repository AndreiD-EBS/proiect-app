<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="px-4">
        <div class="h-12 flex items-center justify-between">
            
            {{-- LEFT --}}
            <div class="flex items-center gap-4 whitespace-nowrap">
                <div class="text-gray-900 dark:text-gray-100 whitespace-nowrap">
                    @auth
                        {{ __('Welcome,') }}
                        <strong>{{ auth()->user()->name }}</strong>
                    @endauth
                </div>
                <x-responsive-nav-link :href="route('magazine.index')" wire:navigate>
                    {{ __('Magazine') }}
                </x-responsive-nav-link>
            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-4 whitespace-nowrap">

                @auth
                    @if(auth()->user()->role === 'admin')
                        <x-responsive-nav-link :href="route('admin.users')" wire:navigate>
                            {{ __('User Management') }}
                        </x-responsive-nav-link>
                    @endif
                @endauth
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    @auth {{ __('Profile') }} @endauth
                    @guest {{ __('Login') }} @endguest
                </x-responsive-nav-link>

                @auth
                    <button wire:click="logout">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                @endauth
            </div>

        </div>
    </div>
</nav>
