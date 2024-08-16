@props(['type' => 'text', 'name', 'id' => null, 'label' => '', 'placeholder' => '', 'value' => ''])

<label class="form-label" for="{{ $id ?? $name }}">{{ $label }}</label>
<input
    type="{{ $type }}"
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    placeholder="{{ $placeholder }}"
    value="{{ old($name, $value) }}"
    class="form-control @error($name) is-invalid @enderror"
>
@error($name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror
