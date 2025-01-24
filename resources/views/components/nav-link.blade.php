@props(['active'])

@php
$classes = ($active ?? false)
? 'flex flex-1 flex-col items-center px-3 py-4 bg-emerald-500 text-white'
: 'flex flex-1 flex-col items-center px-3 py-4 hover:bg-emerald-500 hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
