<div class="mb-4">
    <div x-data="{open:true}" class="bg-white divide-y divide-slate-200 px-4 py-2">
        <div @click="open=!open" class=" cursor-pointer flex justify-between px-4 py-4">
            <h3 class="font-semibold text-lg"> {{ __("Gestion des étudiants") }} </h3>
            <button x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <div class="max-w-7xl flex-col mx-auto ml-4 py-4" wire:poll>

                    @if($this->addedStudents->count())
                        @foreach($this->addedStudents as $attendance)
                        <form wire:submit.prevent="enregistrer({{$attendance}})">
                            @csrf
                            <div class="flex mr-8 mb-4" wire:key="{{$attendance->contact->id}}-{{$attendance->contact->email}}">
                                <div class="relative w-12 h-12">
                                    <img src="{{ asset($attendance->contact->image ?? 'uploads/default.jpeg') }}"
                                         alt="avatar"
                                         class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                                </div>
                                <p class="self-center ml-4">
                                    {{$attendance->contact->firstname }}, {{$attendance->contact->name}}
                                </p>
                                <div class="relative w-8 ml-4 self-center cursor-pointer">
                                    <img src="{{asset('icons/delete.svg')}}"
                                         wire:click="deleteContactRole({{$attendance->contact->id}},{{$this->lastJiri()->id}})"
                                         class="w-6 h-6" alt="icon to delete a student">
                                </div>
                                <p>{{$attendance->contact->id }}</p>
                            </div>
                            <div class="flex">
                                @foreach($this->addedProjects as $project)
                                    <div wire:key="{{$attendance->id}}" class="ml-4 mb-4 ">
                                        <div class="flex-col">
                                            <label for="tasks">{{ $project['name'] }}</label>
                                            <select name="languages" id="tasks" wire:model.live="option">
                                                <option value="presente">Presente</option>
                                                <option value="nepresentepas">Ne presente pas</option>
                                                <option value="reussi">Réussi</option>
                                            </select>
                                        </div>
                                        <p>{{ $project['project_id'] }}, {{$attendance->contact->id }}</p>
                                        <div>
                                            <div>
                                                <input type="checkbox" id="design-{{$project['project_id']}}-{{$attendance->contact->id}}" name="design-{{$project['project_id']}}-{{$attendance->contact->id}}" wire:model="tasks.{{$project['project_id']}}-{{$attendance->contact->id}}.design"/>
                                                <label for="design-{{$project['project_id']}}-{{$attendance->contact->id}}">Design</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="front-{{$project['project_id']}}-{{$attendance->contact->id}}" name="front-{{$project['project_id']}}-{{$attendance->contact->id}}" wire:model="tasks.{{$project['project_id']}}-{{$attendance->contact->id}}.front" />
                                                <label for="front-{{$project['project_id']}}-{{$attendance->contact->id}}">Intégration</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="back-{{$project['project_id']}}-{{$attendance->contact->id}}" name="back-{{$project['project_id']}}-{{$attendance->contact->id}}" wire:model="tasks.{{$project['project_id']}}-{{$attendance->contact->id}}.back"/>
                                                <label for="back">Back-end</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit"> ENVOYER</button>
                                @endforeach
                            </div>
                        </form>
                        @endforeach
                    @endif
            </div>
        </div>
    </div>
</div>
