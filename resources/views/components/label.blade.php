@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-md text-gray-600 form-label ']) }}>
    {{ $value ?? $slot }}
</label>
