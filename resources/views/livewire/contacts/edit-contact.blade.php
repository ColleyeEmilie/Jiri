<div class="bg-white relative content-position">
    <form action="{{ route('contacts.update', $contact) }}" method="post">
        @csrf
        @method('PUT')
        <div class="flex mb-4">
            <div class="relative w-12 h-12 ">
                <div class="relative w-12 h-12">
                    <img wire:model="image" src="{{ asset($contact->image ?? 'uploads/default.jpeg') }}" alt="avatar" class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                </div>
            </div>

            <div class="self-center ml-4" x-data="{ uploading: false, progress: 0 }"
                 x-on:livewire-upload-start="uploading = true"
                 x-on:livewire-upload-finish="uploading = false"
                 x-on:livewire-upload-error="uploading = false"
                 x-on:livewire-upload-psrogress="progress = $event.detail.progress">
                <input accept="image/png, image/jpeg, image/jpg" type="file" wire:model="image">
                <div x-show="uploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900" >Name</label>
            <input class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 " type="text" id="name" name="name" value="{{ $contact->name }}" required>
        </div>

        <div class="mb-4">
            <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900">Prénom</label>
            <input class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 " type="text" id="firstname" name="firstname" value="{{ $contact->firstname }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 " type="email" id="email" name="email" value="{{ $contact->email }}" required>
        </div>

        <div class="mb-4">
            <button class="bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded" type="submit">
                {{ __(('Modifier le contact')) }}
            </button>
        </div>
    </form>
</div>
