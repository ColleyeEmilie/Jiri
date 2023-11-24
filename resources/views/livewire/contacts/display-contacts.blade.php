<div>
    <ul>
        @foreach($contacts as $contact)
            <li class="mb-1"><a href="/contacts/{{ $contact->id }}"> {{ $contact->name }} {{ $contact->firstname }} </a>
                <a href="/contacts/{{ $contact->id }}/edit">EDITER LE CONTACT</a>
                <form action="/contacts/{{ $contact->id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit">{{ __('Supprimer ce contact') }}</button>
                </form>
            </li>
        @endforeach
    </ul>
    {{ $contacts->links() }}
</div>
