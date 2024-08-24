@props([
    'name' => '',
    'id' => null,
    'label' => '',
    'placeholder' => '',
    'required' => false,
])

<label class="form-label" for="{{ $id ?? $name }}">
    {{ $label }}
    @if($required)
        <span class="text-danger">*</span>
    @endif
</label>
<textarea
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}
    {{ $required ? 'required' : '' }}
    rows="4"
>{{ $slot }}</textarea>
@error($name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror
