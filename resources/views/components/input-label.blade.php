@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm dark:text-white text-black']) }}>
    {{ $value ?? $slot }}
</label>
