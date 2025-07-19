@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
$alignmentClasses = match ($align) {
    'left' => 'dropdown-menu-start',
    'top' => '', // Bootstrap doesn't support top alignment for dropdown menus by default
    default => 'dropdown-menu-end',
};

$widthClass = match ($width) {
    '48' => 'w-48', // Bootstrap does not have w-48, so we’ll handle this with inline style below
    default => $width,
};
@endphp

<div class="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $trigger }}
    </button>

    <div
        class="dropdown-menu {{ $alignmentClasses }}"
        aria-labelledby="dropdownMenuButton"
        style="{{ $width === '48' ? 'width: 12rem;' : '' }}"
    >
        <div class="rounded-3 {{ $contentClasses }}" style="box-shadow: 0 0 0 1px rgba(0,0,0,0.05);">
            {{ $content }}
        </div>
    </div>
</div>
