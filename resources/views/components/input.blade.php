@props([
    'type' => 'text',
    'name' => '',
    'id' => null,
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'required' => true
])

<label class="form-label" for="{{ $id ?? $name }}">
    {{ $label }}
    @if($required)
        <span class="text-danger">*</span>
    @endif
</label>
<input
    type="{{ $type }}"
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}
    {{ $required ? 'required' : '' }}
    @unless($type === 'password')
        value="{{ old($name, $value) }}"
    @endif
>
@error($name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror
