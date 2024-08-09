@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-weight-bold text-success small']) }}>
        {{ $status }}
    </div>
@endif

