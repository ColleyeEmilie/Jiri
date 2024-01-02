<div class="flex items-center min-h-screen overflow-hidden text-gray-700 relative bg-white">
    <div class="shrink-0">
        <div class="flex flex-col mt-10 py-2">
            <x-nav-link :href="route('login')" :active="request()->routeIs('login') "> {{ __("Connexion") }} </x-nav-link>
            <x-nav-link :href="route('register')" :active="request()->routeIs('register')"> {{ __("Inscription") }} </x-nav-link>
        </div>
    </div>
</div>
