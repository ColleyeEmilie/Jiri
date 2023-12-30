<div>
    @if(session('success'))
        <div
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto sm:px-6 lg:px-8"
            role="alert">
                <span>
                    {{ session('success') }}
                </span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3"></span>
        </div>
    @endif
    <div class="bg-white relative content-position">
        <table>
            <thead>
            <tr class="flex pl-6 ml-6 mb-6">
                <th class="w-48 font-bold">NOM</th>
                <th class="w-48 font-bold">PRENOM</th>
                <th class="w-72 font-bold" >EMAIL</th>
            </tr>
            </thead>

            <tbody>
            @foreach($contacts as $contact)
                <tr class="mb-6 flex">
                    <td> <a class="flex" href="/contacts/{{ $contact->id }}"><img src="{{ asset($contact->image ?? 'uploads/default.jpeg') }}" alt="avatar"
                             class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm"></a></td>
                    <td class="self-center ml-10 w-48"> <a class="flex" href="/contacts/{{ $contact->id }}">{{ $contact->name }}</a></td>
                    <td class="self-center ml-10 w-48"> <a class="flex" href="/contacts/{{ $contact->id }}">{{ $contact->firstname }}</a></td>
                    <td class="self-center ml-10 w-72"> <a class="flex" href="/contacts/{{ $contact->id }}">{{ $contact->email }}</a></td>
                    <td><a class="self-center ml-4" href="/contacts/{{ $contact->id }}/edit"><img class="w-6 h-6" src="{{asset('icons/crayon.svg')}}" alt="icon de modification d'utilisateur"></a></td>
                    <td><form class="self-center ml-4 h-6" action="/contacts/{{ $contact->id }}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit"><img class="w-6 h-6" src="{{asset('icons/delete.svg')}}"
                                                       alt="icon de suppression d'utilisateur"></button>
                        </form></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $contacts->links() }}
</div>
