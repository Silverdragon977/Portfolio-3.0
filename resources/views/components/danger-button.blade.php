<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger btn-sm text-white text-uppercase fw-semibold']) }}>
    {{ $slot }}
</button>
