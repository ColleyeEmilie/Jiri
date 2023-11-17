<div>
    <ul>
        @foreach($contacts as $contact)
            <li><a href="/contacts/{{ $contact->id }}"> {{ $contact->name }} {{ $contact->firstname }} </a>
                <a href="/contacts/{{ $contact->id }}/edit">EDITER LE CONTACT</a></li>
        @endforeach
    </ul>
    {{ $contacts->links() }}
</div>
