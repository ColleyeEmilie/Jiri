<div>
    @if(session('success'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto sm:px-6 lg:px-8"
             role="alert">
                <span>
                    {{ session('success') }}
                </span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3"></span>
        </div>
    @endif
    <div class="bg-white relative content-position">
        <ul class="flex pl-6 ml-6 mb-6">
            <li class="self-center ml-10 w-48 font-bold">NOM</li>
            <li class="self-center ml-4 w-48 font-bold">PRENOM</li>
            <li class="self-center ml-4 w-72 font-bold">EMAIL</li>
        </ul>
        <ul class="top-16">
            @foreach($contacts as $contact)
                <li class="mb-6 flex">
                    <a class="flex" href="/contacts/{{ $contact->id }}">
                        <div class="relative w-12 h-12">
                            <img src="{{ asset($contact->image ?? 'uploads/default.jpeg') }}" alt="avatar" class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                        </div>
                        <p class="self-center ml-10 w-48">{{ $contact->name }} </p>
                        <p class="self-center ml-4 w-48">{{ $contact->firstname }} </p>
                        <p class="self-center ml-4 w-72">{{ $contact->email }} </p>
                    </a>
                    <a class="self-center ml-4" href="/contacts/{{ $contact->id }}/edit"><img class="w-6 h-6" src="{{asset('icons/crayon.svg')}}" alt="icon de modification d'utilisateur"></a>
                    <form  class="self-center ml-4 h-6" action="/contacts/{{ $contact->id }}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit"><img class="w-6 h-6" src="{{asset('icons/delete.svg')}}" alt="icon de suppression d'utilisateur"></button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
    {{ $contacts->links() }}
</div>
