<div>
    <div x-data="{open:false}" class="bg-gray-50">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Ajouter des étudiants") }} </h3>
            <button @click="open=!open" x-html="open ? '-' :'+' "></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <div class="mb-8  px-5" x-data="contactsListStudent">
                <div>
                    @if($students)
                        @foreach($students as $student)
                            <p>
                                {{$student['name'] }} {{$student['firstname']}} , {{$student['role'] }} , {{$student['jiri_id'] }} , {{$student['contact_id'] }}
                            </p>
                        @endforeach
                    @endif
                </div>
                <form wire:submit="newStudent">
                    <div class="mb-4">
                        <label for="currentStudent" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Rechercher
                            un contact par nom </label>
                        <input type="text" id="currentStudent" name="currentStudent" wire:model.live="currentStudent"
                               @input="splitStringStudent($wire.currentStudent)" list="students"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <datalist id="students">
                            @foreach($this->users as $user)
                                <option wire:key="{{$user->id}}"
                                        value="{{$user->firstname}},{{$user->name}}:{{$user->email}}">
                            @endforeach
                        </datalist>
                        @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="studentName"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nom </label>
                        <input type="text" id="studentName" name="studentName" wire:model="studentName" :value="currentStudent[1]"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('name') <p class="text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="studentFirstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                            Prénom </label>
                        <input type="text" id="studentFirstname" name="studentFirstname" wire:model="studentFirstname"
                               :value="currentStudent[0]"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('firstname') <p class="text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="studentEmail"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Email </label>
                        <input type="text" id="studentEmail" name="studentEmail" wire:model="studentEmail" :value="currentStudent[2]"
                               class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('email') <p class="text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" @click="noValue()"
                            class="transition duration-150 bg-gray-300 hover:bg-gray-300 rounded-lg px-6 py-4 border-solid border-2 border-light-blue-500">
                        Ajouter un étudiant
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
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
