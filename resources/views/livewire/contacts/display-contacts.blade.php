<div>
    <ul>
        @foreach($contacts as $contact)
            <li class="mb-4 flex">
                <a class="flex" href="/contacts/{{ $contact->id }}">
                    <div class="relative w-12 h-12">
                        <img src="{{ asset($contact->image ?? 'uploads/default.jpeg') }}" alt="avatar" class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                    </div>
                    <p class="self-center ml-4">{{ $contact->name }} {{ $contact->firstname }}</p>
                </a>
                <a class="self-center ml-4" href="/contacts/{{ $contact->id }}/edit"><img class="w-6 h-6" src="{{asset('icons/edit-user.png')}}" alt="icon de modification d'utilisateur"></a>
                <form  class="self-center ml-4 h-6" action="/contacts/{{ $contact->id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit"><img class="w-6 h-6" src="{{asset('icons/delete-user.png')}}" alt="icon de suppression d'utilisateur"></button>
                </form>
            </li>
        @endforeach
    </ul>
    {{ $contacts->links() }}
</div>
