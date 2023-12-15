<div class="mb-4">
    <div x-data="{open:false}" class="bg-white divide-y divide-slate-200 px-4 py-2">
        <div @click="open=!open" class="cursor-pointer flex justify-between px-4 py-4">
            <h3 class="text-lg font-semibold"> {{ __("Projets") }} </h3>
            <button  x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <div x-data="projectsList" class="max-w-7xl mx-auto ml-4 py-4">
                <div class=" flex flex-wrap">
                    @if($this->addProjects())
                        @foreach($this->addProjects() as $project)
                            <div class="flex mb-4 ml-4">
                                <p>
                                    {{$project['name'] }}
                                </p>
                                <div class="relative w-8 ml-2 self-center cursor-pointer">
                                    <img src="{{asset('icons/delete.svg')}}"
                                         wire:click="deleteProjectFromJiri({{$project['project_id']}},{{$lastJiri['id']}})"
                                         class="w-6 h-6" alt="icon to delete a jury">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <form wire:submit="newProject" class="flex flex-col">
                    @csrf
                    <div>
                        <div class="mb-4">
                            <label for="currentProject" class="block mb-2 text-sm font-medium text-gray-900">Rechercher un projet par nom </label>
                            <input type="text" id="currentProject" name="currentProject" wire:model.live="currentProject"
                                   list="projectsList" @input="splitStringProject($wire.currentProject)"
                                   class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                            <datalist id="projectsList">
                                @foreach($this->filteredAvailableProjects($lastJiri->id) as $project)
                                    <option wire:key="{{$project->id}}"
                                            value="{{$project->name}},{{$project->link}}:{{$project->ponderation}};{{$project->description}}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-4">
                            <label for="projectName"
                                   class="block mb-2 text-sm font-medium text-gray-900"> Nom du projet</label>
                            <input type="text" id="projectName" name="projectName" wire:model="projectName" :value="currentProject[0]"
                                   class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="projectLink"
                                   class="block mb-2 text-sm font-medium text-gray-900 "> Lien des consignes </label>
                            <input type="text" id="projectLink" name="projectLink" wire:model="projectLink" :value="currentProject[1]"
                                   class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="projectPonderation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"> Ponderation </label>
                            <input type="number" id="projectPonderation" name="projectPonderation" wire:model="projectPonderation" :value="currentProject[2]"
                                   class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="projectDescription"
                                   class="block mb-2 text-sm font-medium text-gray-900"> Description du projet </label>
                            <textarea rows="4" cols="50" type="text" id="projectDescription" name="projectDescription" wire:model="projectDescription" :value="currentProject[3]"
                                      class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 "> </textarea>
                        </div>
                        <div class="mb-4 ml-4 mt-6">
                            <button type="submit" @click="noValue()"
                                    class="mb-4 ml-4 bg-grey-50 hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded">
                                Ajouter un projet
                            </button>
                        </div>
                    </div>
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
