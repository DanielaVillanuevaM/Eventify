@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'nav-item px-4 py-2 rounded-md text-white font-medium bg-[rgba(138,75,255,0.3)] border-b-4 border-[#8a4bff]'
        : 'nav-item px-4 py-2 rounded-md text-gray-300 hover:text-white hover:bg-[rgba(138,75,255,0.2)] transition duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

