@props(['active'])

@php
$classes = ($active ?? false)
    ? 'd-inline-flex align-items-center px-1 pt-1 border-bottom border-2 border-primary text-sm fw-medium text-dark transition'
    : 'd-inline-flex align-items-center px-1 pt-1 border-bottom border-2 border-transparent text-sm fw-medium text-secondary hover:text-dark hover:border-secondary transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
