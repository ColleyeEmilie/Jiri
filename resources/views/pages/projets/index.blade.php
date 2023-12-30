<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight  title">
            @if (empty($projects))
                {{ __("Création d'un nouveau projet") }}
            @else
                {{ __("Projets") }}
            @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (empty($projects))
                <livewire:projets.create-project/>
            @else
                <livewire:projets.display-project/>
            @endif
        </div>
    </div>
</x-app-layout>
