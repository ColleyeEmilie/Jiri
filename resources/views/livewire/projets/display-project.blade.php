<div>
    <ul>
        @foreach($projects as $project)
            <li>
                <a href="/projets/{{ $project->id }}"> {{ $project->name }} </a>
                <a href="/projets/{{ $project->id }}/edit">EDITER LE PROJET</a>
                <form action="/projets/{{ $project->id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit">{{ __('Supprimer ce projet') }}</button>
                </form>
            </li>
        @endforeach
            {{ $projects->links() }}
    </ul>
</div>
