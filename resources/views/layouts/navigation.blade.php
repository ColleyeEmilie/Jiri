<div class="flex flex-col mt-2 items-center min-h-screen overflow-hidden text-gray-700 relative bg-white">
    <div class="shrink-0">
        <div class="flex flex-col items-centermt-10">
            <x-nav-link :href="route('jiris.index')" :active="request()->routeIs('jiris.index') "> {{ __("Épreuves") }} </x-nav-link>
            <x-nav-link :href="route('jiris.create')" :active="request()->routeIs('jiris.create')"> {{ __("Créer une épreuve") }} </x-nav-link>
            <x-nav-link :href="route('contacts.index')" :active="request()->routeIs('contacts.index')"> {{ __("Contacts") }} </x-nav-link>
            <x-nav-link :href="route('contacts.create')" :active="request()->routeIs('contacts.create')"> {{ __("Créer un contact") }} </x-nav-link>
            <x-nav-link :href="route('projets.index')" :active="request()->routeIs('projets.index')"> {{ __("Projets") }} </x-nav-link>
            <x-nav-link :href="route('projets.create')" :active="request()->routeIs('projets.create')"> {{ __("Créer un projet") }} </x-nav-link>
        </div>
    </div>
</div>
