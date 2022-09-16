@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-gray-900 text-xl font-bold font-mono font-large leading-5 text-gray-900 focus:outline-none focus:border-gray-900 transition'
            : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-xl font-bold font-mono font-large leading-5 text-gray-500 hover:text-gray-900 hover:border-gray-900 focus:outline-none focus:text-gray-900 focus:border-gray-900 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
