<div>
    <div x-data="{open:false}" class="bg-gray-50">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Ajouter des jurys") }} </h3>
            <button @click="open=!open" x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <div class="mb-8  px-5" x-data="{contactsList : false, usersList:[]">
                <form wire:submit="add" class="">
                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom </label>
                        <input type="text" name="name" wire:model.live="name" list="jury" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <datalist id="jury">
                            @foreach($this->users as $user)
                                <option wire:key="{{$user->id}}" value="{{$user->name}}">
                            @endforeach
                        </datalist>
                        @error('username') <p class="text-red-400">{{ $message }}</p>  @enderror
                    </div>

                    <div class="mb-4">
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Prénom </label>
                        <input type="firstname" name="firstname" wire:model.live="firstname" value="@foreach($this->users as $user) {{$user->firstname}} @endforeach" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('firstname') <p class="text-red-400">{{ $message }}</p>  @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email </label>
                        <input type="email" name="email" wire:model.live="email" value="@foreach($this->users as $user) {{$user->email}} @endforeach" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('email') <p class="text-red-400">{{ $message }}</p>  @enderror
                    </div>
                    <button type="button" x-on:click="contactsList = true" wire:click="newUser" class="transition duration-150 bg-gray-300 hover:bg-gray-300 rounded-lg px-6 py-4 border-solid border-2 border-light-blue-500">Ajouter un contact</button>
                </form>

                <template x-if="contactsList">

                </template>
            </div>
        </div>
    </div>
</div>
