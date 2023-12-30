<div class="bg-white relative content-position">
    @if(session('success'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto sm:px-6 lg:px-8"
             role="alert">
                <span>
                    {{ session('success') }}
                </span>
        </div>
            @endif
            <ul>
                @foreach($projects as $project)
                    <li class="mb-4 flex">
                        <a href="/projets/{{ $project->id }}"> {{ $project->name }} </a>
                        <a class="ml-2 self-center" href="/projets/{{ $project->id }}/edit"><img class="w-6 h-6"
                                                                                                 src="{{asset('icons/crayon.svg')}}"
                                                                                                 alt="icon de modification d'utilisateur"></a>
                        <form class="ml-2 self-center" action="/projets/{{ $project->id }}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit"><img class="w-6 h-6" src="{{asset('icons/delete.svg')}}"
                                                       alt="icon de suppression d'utilisateur"></button>
                        </form>
                    </li>
                @endforeach
                {{ $projects->links() }}
    </ul>
</div>
