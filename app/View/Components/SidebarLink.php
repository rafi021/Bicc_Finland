<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SidebarLink extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $href,
        public string $icon,
        public ?string $route = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-link');
    }

    /**
     * Determine if the link is active.
     */
    public function isActive(): bool
    {
        if ($this->route) {
            return request()->is($this->route);
        }

        return request()->is($this->href);
    }

    /**
     * Get the link classes based on active state.
     * 
        * {{-- Active sidebar link --}}
            <x-sidebar-link href="/dashboard" icon="home" route="dashboard">
                Dashboard
            </x-sidebar-link>
    
            {{-- Inactive sidebar link --}}
            <x-sidebar-link href="/settings" icon="settings" route="settings">
                Settings
            </x-sidebar-link>
        */
    public function getClasses(): string
    {
        $baseClasses = 'flex items-center gap-x-3 py-2.5 px-3 text-sm rounded-lg transition-all';

        if ($this->isActive()) {
            return "$baseClasses bg-gradient-to-r from-accent-500 to-accent-600 text-white shadow-md font-medium";
        }

        return "$baseClasses text-primary-100 hover:bg-primary-700/50 hover:text-white";
    }
}
