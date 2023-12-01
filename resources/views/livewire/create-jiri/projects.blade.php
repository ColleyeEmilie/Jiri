<div>
    <div x-data="{open:false}" class="bg-gray-50">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Projets") }} </h3>
            <button @click="open=!open" x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <div>
                @if($students)
                    @foreach($students as $student)
                    <p>
                        {{$student['name']}} {{$student['firstname']}}
                    </p>
                @endforeach
                @endif

                @if($projects)
                    @foreach($projects as $project)
                        <p>
                            {{$project['name'] }}}}
                        </p>
                    @endforeach
                @endif
            </div>
            <form wire:submit="newProject">
                @csrf
                <div>
                    <div class="mb-4">
                        <label for="currentProject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Rechercher un projet par nom </label>
                        <input type="text" id="currentProject" name="currentPProject" wire:model.live="currentProject"
                               list="projectsList"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <datalist id="projectsList">
                            @foreach($this->projectsList as $project)
                                <option wire:key="{{$project->id}}"
                                        value="{{$project->name}}">
                            @endforeach
                        </datalist>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
