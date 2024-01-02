<div>
    <div class="bg-white relative content-position">
        <table>
            <thead>
            <tr class="flex mb-6">
                <th class="w-48 font-bold">{{ __('NOM') }}</th>
                <th class="w-48 font-bold">{{ __('PRENOM') }}</th>
                <th class="w-72 font-bold" >{{ __('EMAIL') }}L</th>
            </tr>
            </thead>

            <tbody>
            @foreach($contacts as $contact)
                <tr class="mb-6 flex">
                    <td> <a class="flex w-12 h-12 mr-10" href="/contacts/{{ $contact->id }}" ><img src="{{ asset($contact->image ?? 'uploads/default.jpeg') }}" alt="avatar"
                             class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm"></a></td>
                    <td class="self-center w-48"> <a class="flex" href="/contacts/{{ $contact->id }}">{{ $contact->name }}</a></td>
                    <td class="self-center ml-10 w-48"> <a class="flex" href="/contacts/{{ $contact->id }}">{{ $contact->firstname }}</a></td>
                    <td class="self-center ml-10 w-72"> <a class="flex" href="/contacts/{{ $contact->id }}">{{ $contact->email }}</a></td>
                    <td class="flex"><a class="self-center ml-4" href="/contacts/{{ $contact->id }}/edit"><img class="w-6 h-6" src="{{asset('icons/crayon.svg')}}" alt="icon de modification d'utilisateur"></a></td>
                    <td class="flex"><form class="self-center ml-4 h-6" action="/contacts/{{ $contact->id }}" method="post">
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
