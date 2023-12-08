<div class="bg-white px-4 py-4">
    <div class="mb-4">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Informations générales") }} </h3>
        </div>
        <div class="flex ml-4">
            <div>
                <p class="mb-2">{{ __("Nom de l'épreuve") }}</p>
                <p>{{$jiri->name}}</p>
            </div>
            <div class="ml-6">
                <p class="mb-2">{{ __("Date de l'épreuve") }}</p>
                <p> {{$jiri->starting_at}}</p>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Projets évalués") }} </h3>
        </div>
        <div class="flex ml-4">
            @if($projects)
                @foreach($projects as $project)
                    <p>
                        {{$project['name'] }}
                    </p>
                @endforeach
            @endif
        </div>
    </div>
    <div class="mb-4">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Jurys présents ") }} </h3>
        </div>
        <div class="flex ml-4">
            @if($jurys)
                @foreach($jurys as $jury)
                    <div class="flex mr-8">
                        <div class="relative w-12 h-12">
                            <img src="{{ asset($jury['image'] ?? 'uploads/default.jpeg') }}" alt="avatar"
                                 class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                        </div>
                        <p class="self-center ml-4">
                            {{$jury['firstname'] }}, {{$jury['name']}}
                        </p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="mb-4">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Étudiants présentants") }} </h3>
        </div>
        <div class="flex ml-4">
            @if($students)
                @foreach($students as $student)
                    <div class="flex mr-8">
                        <div class="relative w-12 h-12">
                            <img src="{{ asset($student['image'] ?? 'uploads/default.jpeg') }}" alt="avatar" class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                        </div>
                        <p class="self-center ml-4">
                            {{$student['firstname'] }}, {{$student['name']}}
                        </p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
