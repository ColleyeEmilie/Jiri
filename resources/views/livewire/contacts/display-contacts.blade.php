<div>
    <ul>
        @foreach($contacts as $contact)
            <li><a href="/contacts/{{ $contact->id }}"> {{ $contact->name }} {{ $contact->firstname }} </a></li>
        @endforeach
    </ul>
</div>
