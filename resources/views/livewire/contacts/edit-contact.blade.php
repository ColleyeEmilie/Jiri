<div>
    <form action="{{ route('contacts.update', $contact) }}" method="post">
        @csrf
        @method('PUT')
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
