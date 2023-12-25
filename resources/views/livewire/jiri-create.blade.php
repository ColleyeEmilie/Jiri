<div>
    <div class="mb-4">
        <div x-data="{open:true}" class="bg-white divide-y divide-slate-200 px-4 py-2">
            <div @click="open=!open" class=" cursor-pointer flex justify-between px-4 py-4">
                <h3 class="font-semibold text-lg"> {{ __("Informations générales") }} </h3>
                <button x-html="open ? '-' :'+' " ></button>
            </div>
            <div x-show="open" x-cloak x-transition>
                <div class="max-w-7xl mx-auto ml-4 py-4">
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 border-green-400 rounded-lg bg-green-50" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <form class="flex" wire:submit.prevent="createJiri" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Nom de l'épreuve<sup class="text-rose-600">*</sup></label>
                            <input type="text" id="name" name="name" wire:model="jiriName"
                                   class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                        </div>

                        <div class="mb-4 ml-4">
                            <label for="starting_at" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Date de l'épreuve<sup class="text-rose-600">*</sup></label>
                            <input wire:model="jiriDate" type="date" id="starting_at" name="starting_at"
                                   class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                        </div>
                        <div class="self-end">
                            <button class="mb-4 ml-4 hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent bg-gray-50 rounded" type="submit">
                                {{ __("Créer l'épreuve") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($jiri)
        <livewire:createJiri.projects :jiri="$jiri"/>
        <livewire:createJiri.contacts :jiri="$jiri"/>
        <livewire:createJiri.students :jiri="$jiri"/>
    @endif
</div>
