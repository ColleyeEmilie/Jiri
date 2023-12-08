<div class="mb-4">
    <div x-data="{open:false, contactsList} " class="bg-gray-50">
        <div @click="open=!open" class=" cursor-pointer flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Ajouter des jurys") }} </h3>
            <button x-html="open ? '-' :'+' "></button>
        </div>
        <div x-show="open" x-cloak x-transition x-data="contactsList">
            <div class="mb-8 px-5">
                <div class="mb-8 flex">
                    @if($jurys)
                        @foreach($jurys as $jury)
                            <div class="flex mr-8">
                                <div class="relative w-12 h-12">
                                    <img src="{{ asset($jury['image'] ?? 'uploads/default.jpeg') }}" alt="avatar" class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                                </div>
                                <p class="self-center ml-4">
                                    {{$jury['firstname'] }}, {{$jury['name']}}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>
                <form wire:submit="newUser" class="flex flex-col">
                    @csrf
                    <div>
                        <div class="mb-4">
                            <label for="currentUser" class="block mb-2 text-sm font-medium text-gray-900">Rechercher
                                un contact par nom </label>
                            <input type="text" id="currentUser" name="currentUser" wire:model.live="currentUser"
                                   @input="splitString($wire.currentUser)" list="jury"
                                   class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                            <datalist id="jury">
                                @foreach($this->users as $user)
                                    <option wire:key="{{$user->id}}"
                                            value="{{$user->firstname}},{{$user->name}}:{{$user->email}}">
                                @endforeach
                            </datalist>
                            @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-4">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nom </label>
                            <input type="text" id="name" name="name" wire:model="name" :value="currentUser[1]"
                                   class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                            @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                Prénom </label>
                            <input type="text" id="firstname" name="firstname" wire:model="firstname"
                                   :value="currentUser[0]"
                                   class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                            @error('firstname') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="email"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Email </label>
                            <input type="email" id="email" name="email" wire:model="email" :value="currentUser[2]"
                                   class="w-72 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                            @error('email') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="ml-4 self-end">
                            <button type="submit" @click="noValue()"
                                    class="mb-4 ml-4 bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded">
                                Ajouter un Jury
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script defer>
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
