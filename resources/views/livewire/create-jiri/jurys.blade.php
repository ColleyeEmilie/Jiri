<div>
    <div x-data="{open:false}" class="bg-gray-50">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Ajouter des jurys") }} </h3>
            <button @click="open=!open" x-html="open ? '-' :'+' "></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <div class="mb-8  px-5" x-data="contactsList">
                <div>
                    @if($jurys)
                        @foreach($jurys as $jury)
                            <p>
                                {{$jury['name'] }}, {{$jury['firstname']}},{{$jury['role'] }},{{$jury['token'] }},{{$jury['jiri_id'] }}, {{$jury['contact_id'] }}
                            </p>
                        @endforeach
                    @endif
                </div>
                <form wire:submit="newUser">
                    @csrf
                    <div class="mb-4">
                        <label for="currentUser" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Rechercher
                            un contact par nom </label>
                        <input type="text" id="currentUser" name="currentUser" wire:model.live="currentUser"
                               @input="splitString($wire.currentUser)" list="jury"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <datalist id="jury">
                            @foreach($this->users as $user)
                                <option wire:key="{{$user->id}}"
                                        value="{{$user->firstname}},{{$user->name}}:{{$user->email}}">
                            @endforeach
                        </datalist>
                        @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nom </label>
                        <input type="text" id="name" name="name" wire:model="name" :value="currentUser[1]"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                            Prénom </label>
                        <input type="text" id="firstname" name="firstname" wire:model="firstname"
                               :value="currentUser[0]"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('firstname') <p class="text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Email </label>
                        <input type="email" id="email" name="email" wire:model="email" :value="currentUser[2]"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('email') <p class="text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" @click="noValue()"
                            class="transition duration-150 bg-gray-300 hover:bg-gray-300 rounded-lg px-6 py-4 border-solid border-2 border-light-blue-500">
                        Ajouter un contact
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('contactsList', () => {
                return ({
                    currentUser: [],

                    splitString(name) {
                        this.currentUser = name.split(/[,:]+/);
                        return this.currentUser;
                    },
                    noValue() {
                        return this.currentUser = [];
                    }
                });
            })
        })
    </script>
</div>
