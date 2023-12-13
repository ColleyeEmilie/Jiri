<div>
    @if(session('success'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto sm:px-6 lg:px-8"
             role="alert">
                <span>
                    {{ session('success') }}
                </span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path
                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
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
