<div class="bg-white relative content-position">
    <div class="divide-y divide-slate-200">
        <div class="flex justify-between px-4 py-4">
            <h3 class="font-semibold text-lg"> {{ __("Informations générales") }} </h3>
        </div>
        <div class="flex ml-4 py-4">
            <form class="flex" wire:submit.prevent="editGeneral" method="post">
                @csrf
                @method('PUT')
            <div>
                <label for="jiriName" class="block mb-2 text-sm font-medium text-gray-900">
                    Nom de l'épreuve </label>
                <input type="text" id="jiriName" name="jiriName" wire:model="jiriName" autocomplete="off" value="{{$jiri->name}}"
                       class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
            </div>
            <div class="mb-4 ml-4">
                <label value="{{$jiri->starting_at}}" for="starting_at" wire:model="jiriDate" autocomplete="off"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Date de l'épreuve </label>
                <input type="date" id="starting_at" name="starting_at"
                       class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
            </div>
            <div class="self-end">
                <button class="mb-4 ml-4 hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent bg-gray-50 rounded" type="submit">
                    {{ __("Modifier le nom et/ou la date") }}
                </button>
            </div>
            </form>
        </div>
    </div>

</div>
