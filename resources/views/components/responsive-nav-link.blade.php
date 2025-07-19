@props(['active'])

@php
$classes = ($active ?? false)
    ? 'd-block w-100 ps-3 pe-4 py-2 border-start border-4 border-primary text-start fw-medium text-primary bg-primary bg-opacity-10 focus-outline-none transition'
    : 'd-block w-100 ps-3 pe-4 py-2 border-start border-4 border-transparent text-start fw-medium text-secondary hover:text-dark hover:bg-light border-hover focus-outline-none transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
