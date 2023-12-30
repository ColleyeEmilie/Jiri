<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight title">
            {{ __('Modification de : ' . $contact->name . ' ' . $contact->firstname) }}
        </h2>
    </x-slot>
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:contacts.edit-contact :contact="$contact"/>
        </div>
    </div>
</x-app-layout>
