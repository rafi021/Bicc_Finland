<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ButtonLink extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $href,
        public string $variant = 'primary',
        public string $size = 'md',
        public bool $icon = true,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     * 
     * {{-- Primary button with icon --}}
        <x-button-link href="{{ route('admin.create') }}">
            Create New
        </x-button-link>

        {{-- Accent color button --}}
        <x-button-link href="{{ route('admin.save') }}" variant="accent">
            Save Changes
        </x-button-link>

        {{-- Secondary button, small size --}}
        <x-button-link href="{{ route('admin.cancel') }}" variant="secondary" size="sm">
            Cancel
        </x-button-link>

        {{-- Outline primary, no icon --}}
        <x-button-link href="{{ route('admin.view') }}" variant="outline-primary" :icon="false">
            View Details
        </x-button-link>

        {{-- Large accent button --}}
        <x-button-link href="{{ route('admin.submit') }}" variant="accent" size="lg">
            Submit
        </x-button-link>
     */
    public function render(): View|Closure|string
    {
        return view('components.button-link');
    }

    /**
     * Get the button classes based on variant and size.
     */
    public function getClasses(): string
    {
        $baseClasses = 'inline-flex items-center gap-x-2 font-semibold rounded-lg border transition-all';
        
        $variantClasses = match($this->variant) {
            'primary' => 'border-transparent text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 shadow-md hover:shadow-lg',
            'accent' => 'border-transparent text-white bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 focus:outline-none focus:ring-2 focus:ring-accent-400 focus:ring-offset-2 shadow-md hover:shadow-lg',
            'secondary' => 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 shadow-sm',
            'outline-primary' => 'border-primary-200 text-primary-700 bg-primary-50 hover:bg-primary-100 hover:border-primary-300',
            'outline-accent' => 'border-accent-200 text-accent-700 bg-accent-50 hover:bg-accent-100 hover:border-accent-300',
            default => 'border-transparent text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 shadow-md hover:shadow-lg',
        };
        
        $sizeClasses = match($this->size) {
            'sm' => 'text-xs px-3 py-1.5',
            'md' => 'text-sm px-5 py-2.5',
            'lg' => 'text-base px-6 py-3',
            default => 'text-sm px-5 py-2.5',
        };
        
        return "$baseClasses $variantClasses $sizeClasses";
    }
}
