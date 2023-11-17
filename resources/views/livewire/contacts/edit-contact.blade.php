<div>
    <form action="{{ route('contacts.store') }}" method="post">
        @csrf
        <div>
            <label for="name">Nom </label>
            <input wire:model.live="name" type="text" name="name" id="name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="firstname">Prénom </label>
            <input wire:model.live="firstname" type="text" name="firstname" id="firstname">
            @error('firstname') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="email">Email </label>
            <input wire:model.live="email" type="email" name="email" id="email">
            @error('email') <span class="error">{{ $message }}</span> @enderror

        </div>
        <div>
            <button @if($errors->any()) disabled @endif @if(empty($email || $firstname || $name)) disabled @endif wire:click="editContact" class="bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded" type="submit">
                {{ __(('+ Ajouter le contact')) }}
            </button>
        </div>
    </form>
</div>
