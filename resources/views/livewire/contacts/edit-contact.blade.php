<div>
    <form action="{{ route('contacts.update', $contact) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $contact->name }}" required>
        </div>

        <div>
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" value="{{ $contact->firstname }}" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $contact->email }}" required>
        </div>
        <div>
            <button class="bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded" type="submit">
                {{ __(('Modifier le contact')) }}
            </button>
        </div>
    </form>
</div>
