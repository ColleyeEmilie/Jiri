<div class="bg-white relative content-position">
    <div class="px-6 py-4 divide-y bg-white mb-8 divide-slate-200">
        <div class="flex justify-between px-4 py-4">
            <h3 class="font-semibold text-lg"> {{ __("Informations générales") }} </h3>
        </div>
        <div class="flex pt-6">
            <div class="relative w-12 h-12">
                <img src="{{ asset($contact->image ?? 'uploads/default.jpeg') }}" alt="avatar"
                     class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
            </div>
            <div class="ml-6">
                <p class="mb-2 text-slate-500">{{ __("Nom") }}</p>
                <p class="block mb-2 text-sm font-medium text-gray-900">{{$contact->name }}</p>
            </div>
            <div class="ml-6">
                <p class="mb-2 text-slate-500">{{ __("Prenom") }}</p>
                <p class="block mb-2 text-sm font-medium text-gray-900">{{$contact->firstname}}</p>
            </div>
            <div class="ml-6">
                <p class="mb-2 text-slate-500">{{ __("Email") }}</p>
                <p class="block mb-2 text-sm font-medium text-gray-900">{{$contact->email}}</p>
            </div>
        </div>
    </div>

    @if(!empty($this->jirisAsJury()))
        @foreach($this->jirisAsJury() as $jury)
            <div class="px-6 py-4 divide-y mb-8 bg-white divide-slate-200">
                <div class="flex justify-between px-4 py-4">
                    <h3 class="font-semibold text-lg"> {{ __("Épreuves dans lesquelles ") }}{{$contact->firstname}} {{__(" est présent.e en tant que jury")}} </h3>
                </div>
                <div class="flex pt-6">
                    <div class="ml-6">
                        <p class="mb-2 text-slate-500">{{ __("Nom du projet") }}</p>
                        <p class="block mb-2 text-sm font-medium text-gray-900">{{$jury->jiri->name}}</p>
                    </div>
                    <div class="ml-6">
                        <p class="mb-2 text-slate-500">{{ __("Date de l'épreuve") }}</p>
                        <p class="block mb-2 text-sm font-medium text-gray-900">{{$jury->jiri->starting_at}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if(!empty($this->jirisAsStudent()))
        @foreach($this->jirisAsStudent() as $student)
            <div class="px-6 py-4 divide-y mb-8 bg-white divide-slate-200">
                <div class="flex justify-between px-4 py-4">
                    <h3 class="font-semibold text-lg"> {{ __("Épreuves dans lesquelles ") }}{{$contact->firstname}} {{__("est présent.e en tant qu'étudiant.e")}} </h3>
                </div>
                <div class="flex pt-6">
                    <div class="ml-6">
                        <p class="mb-2 text-slate-500">{{ __("Nom du projet") }}</p>
                        <p class="block mb-2 text-sm font-medium text-gray-900">{{$student->jiri->name}}</p>
                    </div>
                    <div class="ml-6">
                        <p class="mb-2 text-slate-500">{{ __("Date de l'épreuve") }}</p>
                        <p class="block mb-2 text-sm font-medium text-gray-900">{{$student->jiri->starting_at}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

