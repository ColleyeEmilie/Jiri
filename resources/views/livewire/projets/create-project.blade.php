<div>
    <form action="{{ route('projets.store') }}" method="post">
        @csrf
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="name">{{ __('Nom du projet') }} </label>
            <input wire:model.live="name" type="text" name="name" id="name" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="link">{{ __('Lien vers le projet') }} </label>
            <input wire:model.live="link" type="text" name="link" id="link" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
            @error('link') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="ponderation"> {{ __('Pondération') }} </label>
            <input wire:model.live="ponderation" type="number" name="ponderation" id="ponderation" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
            @error('ponderation') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="description"> {{ __('Description') }} </label>
            <textarea id="description" name="description" rows="4" cols="50" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"></textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <button wire:click="newProject" @if($errors->any()) disabled @endif @if(empty($name || $ponderation || $link)) disabled @endif class="mb-4 mt-4 bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded" type="submit">
                {{ __('+ Ajouter le projet') }}
            </button>
        </div>
    </form>
</div>
