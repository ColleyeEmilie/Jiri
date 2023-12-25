<div class="mb-4">
    <div x-data="{open:false}" class="bg-white divide-y divide-slate-200 px-4 py-2">
        <div @click="open=!open" class=" cursor-pointer flex justify-between px-4 py-4">
            <h3 class="font-semibold text-lg"> {{ __("Gestion des étudiants") }} </h3>
            <button x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <div class="max-w-7xl flex-col mx-auto ml-4 py-4" wire:poll>

                    @if($this->addedStudents()->count())
                        @foreach($this->addedStudents() as $student)
                        <form wire:submit.prevent="enregistrer({{$student}})">
                            @csrf
                            <div class="flex mr-8 mb-4" wire:key="{{$student->id}}-{{$student->email}}">
                                <div class="relative w-12 h-12">
                                    <img src="{{ asset($student->image ?? 'uploads/default.jpeg') }}"
                                         alt="avatar"
                                         class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                                </div>
                                <p class="self-center ml-4">
                                    {{$student->firstname }}, {{$student->name}}
                                </p>
                            </div>
                            <div class="flex">
                                @foreach($this->addedProjects() as $project)
                                    <div class="flex-col" >
                                        <div wire:key="{{$student->id}}" class="ml-4 mb-4 ">
                                            <div>
                                                <p class="mb-4">{{$project->name}}</p>
                                                <div>
                                                    <input type="checkbox"  class="accent-orange-400" id="design-{{$project['project_id']}}-{{$student->id}}" name="design-{{$project['project_id']}}-{{$student->id}}" wire:model="tasks.{{$project['project_id']}}-{{$student->id}}.design"/>
                                                    <label for="design-{{$project['project_id']}}-{{$student->id}}">Design</label>
                                                </div>
                                                <div>
                                                    <input type="checkbox" class="accent-orange-400" id="front-{{$project['project_id']}}-{{$student->id}}" name="front-{{$project['project_id']}}-{{$student->id}}" wire:model="tasks.{{$project['project_id']}}-{{$student->id}}.front"/>
                                                    <label for="front-{{$project['project_id']}}-{{$student->id}}">Intégration</label>
                                                </div>
                                                <div>
                                                    <input type="checkbox" class="accent-orange-400" id="back-{{$project['project_id']}}-{{$student->id}}" name="back-{{$project['project_id']}}-{{$student->id}}" wire:model="tasks.{{$project['project_id']}}-{{$student->id}}.back" />
                                                    <label for="back">Back-end</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="mb-4 ml-4 bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded"> ENVOYER</button>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                        @endforeach
                    @endif
            </div>
        </div>
    </div>
</div>
