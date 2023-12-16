<div class="mb-4">
    <div x-data="{open:true}" class="bg-white divide-y divide-slate-200 px-4 py-2">
        <div @click="open=!open" class=" cursor-pointer flex justify-between px-4 py-4">
            <h3 class="font-semibold text-lg"> {{ __("Gestion des étudiants") }} </h3>
            <button x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <div class="max-w-7xl mx-auto ml-4 py-4">
                <form wire:submit="newProject" class="flex flex-col" wire:poll>
                    @csrf
                    @if($this->addedStudents->count())
                        @foreach($this->addedStudents as $attendance)
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
                            </div>
                            <div class="flex">
                                @foreach($this->addedProjects as $project)
                                    <div wire:key="{{$attendance->id}}" class="ml-4 mb-4 ">
                                        <div class="flex-col">
                                            <label for="tasks">{{ $project['name'] }}</label>
                                            <select name="languages" id="tasks">
                                                <option value="presente">Presente</option>
                                                <option value="nepresentepas">Ne presente pas</option>
                                                <option value="reussi">Réussi</option>
                                            </select>
                                        </div>
                                        <div>
                                            <div>
                                                <input type="checkbox" id="design" name="design"/>
                                                <label for="design">Design</label>
                                            </div>

                                            <div>
                                                <input type="checkbox" id="front" name="front" />
                                                <label for="front">Intégration</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="back" name="back" />
                                                <label for="back">Back-end</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
