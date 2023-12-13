<div class="bg-white px-4 py-4">

    <form action="{{ route('jiris.update', $jiri) }}" method="post">
        @csrf
        @method('PUT')
        <div class="divide-y divide-slate-200">
            <div class="flex justify-between px-4 py-4">
                <h3 class="font-semibold text-lg"> {{ __("Informations générales") }} </h3>
            </div>
            <div class="flex ml-4 py-4">
                <div>
                    <label for="jiriName" class="block mb-2 text-sm font-medium text-gray-900">
                        Nom de l'épreuve </label>
                    <input type="text" id="jiriName" name="jiriName" value="{{$jiri->name}}"
                           class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                </div>
                <div class="ml-6">
                    <p class="mb-2 text-slate-500">{{ __("Date de l'épreuve") }}</p>
                    <p class="block mb-2 text-sm font-medium text-gray-900"> {{$jiri->starting_at}}</p>
                </div>
            </div>
        </div>
        <div class="divide-y divide-slate-200">
            <div class="flex justify-between px-4 py-4">
                <h3 class="text-lg font-semibold"> {{ __("Projets évalués") }} </h3>
            </div>
            <div class="flex-col ml-4 py-4">
                @if($projects)
                    @foreach($projects as $project)
                        <div class="flex mb-8">
                            <div>
                                <p class="mb-2 text-slate-500">{{ __("Nom du projet") }}</p>
                                <p class="block mb-2 text-sm font-medium text-gray-900">{{$project['name'] }}</p>
                            </div>
                            <div class="ml-6 w-96">
                                <p class="mb-2 text-slate-500">{{ __("Lien du projet") }}</p>
                                <p class="block mb-2 text-sm font-medium text-gray-900">{{$project['link'] }}</p>
                            </div>
                            <div class="ml-6 w-96">
                                <p class="mb-2 text-slate-500">{{ __("Description du projet") }}</p>
                                <p class="block mb-2 text-sm font-medium text-gray-900">{{$project['description'] }}</p>
                            </div>
                            <div class="ml-6">
                                <p class="mb-2 text-slate-500">{{ __("Pondération du projet") }}</p>
                                <p class="block mb-2 text-sm font-medium text-gray-900">{{$project['ponderation'].' %' }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="divide-y divide-slate-200">
            <div class="flex justify-between px-4 py-4 ">
                <h3 class="text-lg font-semibold"> {{ __("Jurys présents ") }} </h3>
            </div>
            <div class="flex ml-4 py-4">
                @if($jurys)
                    @foreach($jurys as $jury)
                        <div class="flex mr-8 mb-4">
                            <div class="relative w-12 h-12">
                                <img src="{{ asset($jury['image'] ?? 'uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                            </div>
                            <p class="self-center ml-4 block mb-2 text-sm font-medium text-gray-900">
                                {{$jury['firstname'] }} {{$jury['name']}}
                            </p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="divide-y divide-slate-200">
            <div class="flex justify-between px-4 py-4">
                <h3 class="text-lg font-semibold"> {{ __("Étudiants présentants") }} </h3>
            </div>
            <div class="flex ml-4 py-4">
                @if($students)
                    @foreach($students as $student)
                        <div class="flex mr-8 mb-4">
                            <div class="relative w-12 h-12">
                                <img src="{{ asset($student['image'] ?? 'uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                            </div>
                            <p class="self-center ml-4 block mb-2 text-sm font-medium text-gray-900">
                                {{$student['firstname'] }}, {{$student['name']}}
                            </p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </form>
</div>
