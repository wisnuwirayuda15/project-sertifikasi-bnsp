@props(['label', 'value', 'checked' => null, 'disabled' => false])

<label {{ $disabled ? 'disabled' : '' }} class="inline-flex items-center">
    <input type="radio" {!! $attributes->merge(['class' => 'form-radio text-indigo-600']) !!} value="{{ $value }}" {{ $value == $checked ? 'checked' : '' }}>
    <span class="ml-2">{{ $label }}</span>
</label>
