<div class="mb-4">
    <div x-data="{open:false, contactsList} " class="bg-white divide-y divide-slate-200 px-4 py-2 mb-4">
        <div @click="open=!open" class="cursor-pointer flex justify-between px-4 py-4">
            <h3 class="text-lg font-semibold"> {{ __("Ajouter des jurys") }} </h3>
            <button x-html="open ? '-' :'+' "></button>
        </div>
        <div x-show="open" x-cloak x-transition x-data="contactsList">
            <div class="max-w-7xl mx-auto ml-4 py-4">
                <div class="mb-8 flex flex-wrap">
                    @if($jurys)
                        @foreach($jurys as $jury)
                            <div class="flex mr-8 mb-4">
                                <div class="relative w-12 h-12">
                                    <img src="{{ asset($jury['image'] ?? 'uploads/default.jpeg') }}" alt="avatar"
                                         class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                                </div>
                                <p class="self-center ml-4">
                                    {{$jury['firstname'] }}, {{$jury['name']}}
                                </p>
                                <div class="relative w-8 ml-4 self-center cursor-pointer">
                                    <img src="{{asset('icons/delete.svg')}}"
                                         wire:click="deleteContactRole({{$jury['id']}},{{$lastJiri['id']}})"
                                         class="w-6 h-6">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <form wire:submit.prevent="newUser" class="flex flex-col">
                    @csrf
                    <div>
                        <div class="mb-4">
                            <label for="currentUser" class="block mb-2 text-sm font-medium text-gray-900">Rechercher
                                un contact par nom </label>
                            <input type="text" id="currentUser" name="currentUser" wire:model.live="currentUser"
                                   @input="splitString($wire.currentUser)" list="jury"
                                   class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                            <datalist id="jury">
                                @foreach($this->filteredAvailableContacts($lastJiri->id) as $contact)
                                    <option wire:key="{{$contact->id}}"
                                            value="{{$contact->firstname}},{{$contact->name}}:{{$contact->email}}">
                                @endforeach
                            </datalist>
                            @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-4">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nom </label>
                            <input type="text" id="name" name="name" wire:model="name" :value="currentUser[1]"
                                   class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                            @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                Prénom </label>
                            <input type="text" id="firstname" name="firstname" wire:model="firstname"
                                   :value="currentUser[0]"
                                   class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                            @error('firstname') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="email"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Email </label>
                            <input type="email" id="email" name="email" wire:model="email" :value="currentUser[2]"
                                   class="w-72 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                            @error('email') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="ml-4 self-end">
                            <button type="submit" @click="noValue()"
                                    class="mb-4 ml-4 bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded">
                                Ajouter un Jury
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-data="{open:false}" class="bg-white divide-y divide-slate-200 px-4 py-2">
        <div @click="open=!open" class="cursor-pointer flex justify-between px-4 py-4">
            <h3 class="text-lg font-semibold"> {{ __("Ajouter des étudiants") }} </h3>
            <button x-html="open ? '-' :'+' "></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <div class="max-w-7xl mx-auto ml-4 py-4" x-data="contactsListStudent">
                <div class="flex mb-8 flex-wrap">
                    @if($students)
                        @foreach($students as $student)
                            <div class="flex mr-8 mb-4">
                                <div class="relative w-12 h-12">
                                    <img src="{{ asset($student['image'] ?? 'uploads/default.jpeg') }}" alt="avatar"
                                         class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
                                </div>
                                <p class="self-center ml-4">
                                    {{$student['firstname'] }}, {{$student['name']}}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>
                <form wire:submit.prevent="newStudent">
                    <div>
                        <div class="mb-4">
                            <label for="currentStudent"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Rechercher
                                un contact par nom </label>
                            <input type="text" id="currentStudent" name="currentStudent"
                                   wire:model.live="currentStudent"
                                   @input="splitStringStudent($wire.currentStudent)" list="students"
                                   class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            <datalist id="students">
                                @foreach($this->filteredAvailableContacts($lastJiri->id) as $contact)
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
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nom </label>
                            <input type="text" id="studentName" name="studentName" wire:model="studentName"
                                   :value="currentStudent[1]"
                                   class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="studentFirstname"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                Prénom </label>
                            <input type="text" id="studentFirstname" name="studentFirstname"
                                   wire:model="studentFirstname"
                                   :value="currentStudent[0]"
                                   class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            @error('firstname') <p class="text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-4 ml-4">
                            <label for="studentEmail"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Email </label>
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

    <script defer>
        document.addEventListener('alpine:init', () => {
            Alpine.data('contactsList', () => {
                return ({
                    currentUser: [],
                    splitString(name) {
                        this.currentUser = name.split(/[,:]+/);
                        return this.currentUser;
                    },
                    noValue() {
                        return this.currentUser = [];
                    }
                });
            })
        })
        document.addEventListener('alpine:init', () => {
            Alpine.data('contactsListStudent', () => {
                return ({
                    currentStudent: [],

                    splitStringStudent(name) {
                        console.log(name)
                        this.currentStudent = name.split(/[,:]+/);
                        console.log(this.currentStudent);
                        return this.currentStudent;
                    },
                    noValue() {
                        return this.currentStudent = [];
                    }
                });
            })
        })
    </script>
</div>
