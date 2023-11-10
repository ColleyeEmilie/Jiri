<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (empty($contacts))
                {{ __("Création d'un nouveau contact ") }}
            @else
                {{ __("Contacts") }}
            @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (empty($contacts))
                <livewire:contacts.createContact/>
            @else
                <livewire:contacts.displayContacts/>
            @endif
        </div>
    </div>
</x-app-layout>
