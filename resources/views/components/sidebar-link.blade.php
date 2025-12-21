<li>
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $getClasses()]) }}>
        <i data-lucide="{{ $icon }}" class="w-4 h-4 shrink-0"></i>
        <span class="sidebar-text">{{ $slot }}</span>
    </a>
</li>
