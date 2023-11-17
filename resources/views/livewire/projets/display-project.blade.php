<div>
    <ul>
        @foreach($projects as $project)
            <li><a href="/projets/{{ $project->id }}"> {{ $project->name }} </a></li>
        @endforeach
    </ul>
</div>
