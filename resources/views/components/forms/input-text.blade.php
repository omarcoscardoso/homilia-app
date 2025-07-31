@props(['name', 'type' => 'text', 'placeholder' => '', 'value' => '', 'class' => ''])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    placeholder="{{ $placeholder }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->merge(['class' => 'w-full px-5 py-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-300 ' . ($errors->has($name) ? 'border-red-500 dark:border-red-500' : 'border-gray-400 dark:border-gray-500') . ' ' . $class ]) }}
    wire:loading.attr="disabled"
    wire:target="generateHomilia"
    wire:loading.class="opacity-70 cursor-not-allowed bg-gray-100 dark:bg-gray-700"
>

@error($name)
    <div class="text-red-500 text-sm mt-1">
        {{ $message }}
    </div>
@enderror