<div>
    <ul>
        @foreach($projects as $project)
            <li>
                <a href="/projets/{{ $project->id }}"> {{ $project->name }} </a>
                <a href="/projets/{{ $project->id }}/edit">EDITER LE PROJET</a>
            </li>
        @endforeach
            {{ $projects->links() }}
    </ul>
</div>
