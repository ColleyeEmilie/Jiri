<div>
    <h3>display contacts</h3>
    <ol>
        @foreach($contacts as $contact)
            <li><a href="/contacts/{{ $contact->id }}"> {{ $contact->name }} </a></li>
        @endforeach
    </ol>
</div>
