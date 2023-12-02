<div>
    <div x-data="{open:false}" class="bg-gray-50">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Projets") }} </h3>
            <button @click="open=!open" x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <div x-data="projectsList">
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
                                {{$project['name'] }}
                            </p>
                        @endforeach
                    @endif
                </div>
                <form wire:submit="newProject">
                    @csrf
                    <div class="mb-4">
                        <label for="currentProject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Rechercher un projet par nom </label>
                        <input type="text" id="currentProject" name="currentProject" wire:model.live="currentProject"
                               list="projectsList" @input="splitStringProject($wire.currentProject)"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <datalist id="projectsList">
                            @foreach($this->projectsList as $project)
                                <option wire:key="{{$project->id}}"
                                        value="{{$project->name}},{{$project->link}}:{{$project->ponderation}};{{$project->description}}">
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mb-4">
                        <label for="projectName"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"> Nom du projet</label>
                        <input type="text" id="projectName" name="projectName" wire:model="projectName" :value="currentProject[0]"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="projectLink"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"> Lien des consignes </label>
                        <input type="text" id="projectLink" name="projectLink" wire:model="projectLink" :value="currentProject[1]"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="projectPonderation"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"> Ponderation </label>
                        <input type="number" id="projectPonderation" name="projectPonderation" wire:model="projectPonderation" :value="currentProject[2]"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="projectDescription"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"> Description du projet </label>
                        <textarea rows="4" cols="50" type="text" id="projectDescription" name="projectDescription" wire:model="projectDescription" :value="currentProject[3]"
                                  class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"> </textarea>
                    </div>
                    <button type="submit" @click="noValue()"
                            class="transition duration-150 bg-gray-300 hover:bg-gray-300 rounded-lg px-6 py-4 border-solid border-2 border-light-blue-500">
                       Ajouter un projet
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('projectsList', () => {
                return ({
                    currentProject: [],

                    splitStringProject(project) {
                        this.currentProject = project.split(/[,:;]+/);
                        return this.currentProject;
                    },
                    noValue() {
                        return this.currentProject = [];
                    }
                });
            })
        })
    </script>

</div>
