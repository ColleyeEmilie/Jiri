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
                @if (empty($jiris))
                    <livewire:createJiri/>
                @else
                    <livewire:lastJiriCreated/>
                    <livewire:futureJiris/>
                    <livewire:oldJiris/>
                @endif
            <p><a href="/jiris/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create a new jiri</a></p>
        </div>
    </div>

</x-app-layout>
