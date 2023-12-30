@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex p-6 px-6 text-sm font-bold leading-5 text-orange-300 text-left focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out bg-yellow'

                : 'inline-flex p-6 px-6 border-b-2 border-transparent w-48 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-orange-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
