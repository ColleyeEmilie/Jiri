<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (empty($jiris))
            {{ __("Création d'une nouvelle épreuve") }}
            @else
            {{ __("Épreuves") }}
            @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <livewire:display-jiri.lastJiriCreated/>
                    <livewire:display-jiri.futureJiris/>
                    <livewire:display-jiri.oldJiris/>
        </div>
    </div>

</x-app-layout>
