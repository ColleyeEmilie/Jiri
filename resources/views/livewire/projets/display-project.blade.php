<div class="bg-white relative content-position">
    <table>
        <thead>
        <tr class="flex mb-6">
            <th class="w-48 flex font-bold">{{ __('NOM DU PROJET') }}</th>
            <th class="w-48 flex ml-10 font-bold">{{ __('LIEN DES CONSIGNES') }}</th>
            <th class="w-72 flex ml-10 font-bold">{{ __('DESCRIPTION') }}</th>
        </tr>
        </thead>

        <tbody>
        @foreach($projects as $project)
            <tr class="mb-6 flex">
                <td class="self-center w-48"><a class="flex" href="/projets/{{ $project->id }}">{{ $project->name }}</a>
                </td>
                <td class="self-center ml-10 w-48"><a class="flex"
                                                      href="/projets/{{ $project->id }}">{{ $project->link }}</a></td>
                <td class="self-center ml-10 w-72"><a class="flex"
                                                      href="/projets/{{ $project->id }}">{{ $project->description }}</a>
                </td>
                <td class="flex"><a class="self-center ml-4" href="/projets/{{ $project->id }}/edit"><img
                            class="w-6 h-6" src="{{asset('icons/crayon.svg')}}"
                            alt="icon de modification d'utilisateur"></a></td>
                <td class="flex">
                    <form class="self-center ml-4 h-6" action="/projets/{{ $project->id }}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit"><img class="w-6 h-6" src="{{asset('icons/delete.svg')}}"
                                                   alt="icon de suppression d'utilisateur"></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}
</div>
