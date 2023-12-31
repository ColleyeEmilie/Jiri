
<div class="mb-4" x-data="lists">
    <div class="bg-white divide-y divide-slate-200 px-4 py-2">
        <div @click="openStudent=!openStudent" class="cursor-pointer flex justify-between px-4 py-4">
            <h3 class="text-lg font-semibold"> {{ __("Ajouter des étudiants") }} </h3>
            <button x-html="openStudent ? '-' :'+' "></button>
        </div>
        <div x-show="openStudent" x-cloak x-transition>
            <div class="max-w-7xl mx-auto ml-4 py-4">
                <div class="flex flex-wrap">
                    @if($this->addedStudents->count())
                        @foreach($this->addedStudents as $student)
                            <div class="flex mr-8 mb-4" wire:key="{{$student->id}}-{{$student->email}}">
                                <div class="relative w-12 h-12">
                                    <img src="{{ asset($student->image ?? 'uploads/default.jpeg') }}"
                                         alt="avatar"
                                         class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                                </div>
                                <p class="self-center ml-4">
                                    {{$student->firstname }}, {{$student->name}}
                                </p>
                                <div class="relative w-8 ml-4 self-center cursor-pointer">
                                    <img src="{{asset('icons/delete.svg')}}"
                                         wire:click="deleteContactRole({{$student->id}},{{$this->jiri->id}})"
                                         class="w-6 h-6" alt="icon to delete a student">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <form wire:submit.prevent="newStudent">
                    <div>
                        <div class="mb-4">
                            <label for="currentStudent"
                                   class="block mb-2 text-sm font-medium text-gray-900">Rechercher
                                un contact par nom </label>
                            <input type="text" id="currentStudent" name="currentStudent"
                                   wire:model.live="currentStudent"
                                   @input="splitStringStudent($wire.currentStudent)" list="students"
                                   class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            <datalist id="students">
                                @foreach($this->filteredAvailableContacts($this->jiri->id) as $contact)
                                    <option wire:key="{{$contact->id}}"
                                            value="{{$contact->firstname}},{{$contact->name}}:{{$contact->email}}">
                                @endforeach
                            </datalist>
                            @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-4">
                            <label for="studentName"
                                   class="block mb-2 text-sm font-medium text-gray-900 ">Nom </label>
                            <input type="text" id="studentName" name="studentName" wire:model="studentName"
                                   :value="currentStudent[1]"
                                   class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="studentFirstname"
                                   class="block mb-2 text-sm font-medium text-gray-900 ">
                                Prénom </label>
                            <input type="text" id="studentFirstname" name="studentFirstname"
                                   wire:model="studentFirstname"
                                   :value="currentStudent[0]"
                                   class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            @error('firstname') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="studentEmail"
                                   class="block mb-2 text-sm font-medium text-gray-900 ">Email </label>
                            <input type="text" id="studentEmail" name="studentEmail" wire:model="studentEmail"
                                   :value="currentStudent[2]"
                                   class="w-72 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            @error('email') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="ml-4 self-end">
                            <button type="submit" @click="noValue()"
                                    class="mb-4 ml-4 bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded">
                                Ajouter un étudiant
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
