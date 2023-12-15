<div class="bg-white px-6 py-4">
    <div class="divide-y divide-slate-200">
        <div class="flex justify-between px-4 py-4">
            <h3 class="font-semibold text-lg"> {{ __("Informations générales") }} </h3>
        </div>
        <div class="flex pt-6">
            <div class="relative w-12 h-12">
                <img src="{{ asset($contact->image ?? 'uploads/default.jpeg') }}" alt="avatar" class=" w-12 h-12 rounded-full border border-gray-100 shadow-sm">
            </div>
            <div class="ml-6">
                <p class="mb-2 text-slate-500">{{ __("Nom") }}</p>
                <p class="block mb-2 text-sm font-medium text-gray-900">{{$contact->name }}</p>
            </div>
            <div class="ml-6">
                <p class="mb-2 text-slate-500">{{ __("Prenom") }}</p>
                <p class="block mb-2 text-sm font-medium text-gray-900" >{{$contact->firstname}}</p>
            </div>
            <div class="ml-6">
                <p class="mb-2 text-slate-500">{{ __("Email") }}</p>
                <p class="block mb-2 text-sm font-medium text-gray-900" >{{$contact->email}}</p>
            </div>
        </div>
    </div>
</div>

