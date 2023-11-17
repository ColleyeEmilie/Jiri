<div>
    <form action="{{ route('projets.store') }}" method="post">
        @csrf
        <div>
            <label for="name">{{ __('Nom du projet') }} </label>
            <input wire:model.live="name" type="text" name="name" id="name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="link">{{ __('Lien vers le projet') }} </label>
            <input wire:model.live="link" type="text" name="link" id="link">
            @error('link') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="ponderation"> {{ __('Pondération') }} </label>
            <input wire:model.live="ponderation" type="number" name="ponderation" id="ponderation">
            @error('ponderation') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="description"> {{ __('Description') }} </label>
            <textarea id="description" name="description" rows="4" cols="50"></textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <button wire:click="newProject" @if($errors->any()) disabled @endif @if(empty($name || $ponderation || $link)) disabled @endif class="bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded" type="submit">
                {{ __('+ Ajouter le projet') }}
            </button>
        </div>
    </form>
</div>
