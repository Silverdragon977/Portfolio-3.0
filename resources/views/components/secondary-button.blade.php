<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-sm btn-light border rounded fw-semibold text-uppercase text-secondary shadow-sm']) }}>
    {{ $slot }}
</button>
