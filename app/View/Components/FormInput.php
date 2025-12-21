<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FormInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $label,
        public string $type = 'text',
        public ?string $placeholder = null,
        public bool $required = false,
        public mixed $value = null,
        public ?string $helper = null,
        public ?string $width = null,
    ) {
        $this->placeholder = $placeholder ?? "Enter {$label}";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }

    /**
     * Get the input classes.
     * 
     * <x-form-input 
        name="title" 
        label="Title" 
        :required="true" 
        placeholder="Enter innovation title" 
        />
     */
    public function getInputClasses(): string
    {
        $baseClasses = 'block border-gray-300 rounded-lg shadow-sm text-sm px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all';
        
        $widthClass = $this->width ? $this->width : 'w-full';
        
        return "$baseClasses $widthClass";
    }

    /**
     * Get the value for the input.
     */
    public function getValue(): mixed
    {
        return old($this->name, $this->value);
    }
}
