@props(['href' => null, 'variant' => 'primary', 'type' => 'link'])

@if ($type === 'submit')
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'button button--'.$variant]) }}>
        {{ $slot }}
    </button>
@else
    <a href="{{ $href ?? '#' }}" {{ $attributes->merge(['class' => 'button button--'.$variant]) }}>
        {{ $slot }}
    </a>
@endif
