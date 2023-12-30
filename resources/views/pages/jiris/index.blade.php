<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight  title">
            @if (empty($jiris))
            {{ __("Création d'une nouvelle épreuve") }}
            @else
            {{ __("Épreuves") }}
            @endif
        </h2>
    </x-slot>
    @if(session('success'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto sm:px-6 lg:px-8" role="alert">
                <span>
                    {{ session('success') }}
                </span>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white relative content-position">
                <livewire:display-jiri.lastJiriCreated/>
                <livewire:display-jiri.futureJiris/>
                <livewire:display-jiri.oldJiris/>
            </div>
        </div>
    </div>

</x-app-layout>
