@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex p-6 px-6 items-center text-sm font-medium leading-5 bg-orange-300 text-white focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out bg-yellow'

                : 'inline-flex p-6 px-6 items-center border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-yellow-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
