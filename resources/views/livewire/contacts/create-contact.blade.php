<div class="bg-white relative content-position">
    <form wire:submit="newContact" action="{{ route('contacts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex mb-4">
            @if ($image)
                <div class="relative w-12 h-12 ml-4 ">
                    <img class="w-12 h-12 rounded-full border border-gray-100" src="{{ $image->temporaryUrl() }}" alt="">
                </div>
            @else
                <div class="relative w-12 h-12 ml-4 ">
                    <img class="w-12 h-12 rounded-full border border-gray-100" src="{{ asset('uploads/default.jpeg') }}" alt="default image">
                </div>
            @endif
            <input accept="image/png, image/jpeg, image/jpg" type="file" wire:model="image" class="ml-4 self-center">
        </div>


        <div class="mb-4">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nom</label>
            <input wire:model.live="name" type="text" name="name" id="name"
                   class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" >
                   @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900">Prenom</label>
            <input wire:model.live="firstname" type="text" name="firstname" id="firstname"
                   class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" >
            @error('firstname') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input wire:model.live="email" type="email" name="email" id="email"
                   class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" >
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <button @if($errors->any()) disabled @endif @if(empty($email || $firstname || $name)) disabled @endif class="bg-white hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded" type="submit">
                {{ __(('+ Ajouter le contact')) }}
            </button>
        </div>
    </form>
</div>
