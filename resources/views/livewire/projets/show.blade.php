<div class="bg-white relative content-position">
    <div class="flex-col mb-8 bg-white px-6 py-8">
        <div class="ml-6 mb-6">
            <p class="mb-2 text-slate-500">{{ __("Nom du projet") }}</p>
            <p class="block mb-2 text-sm font-medium text-gray-900">{{$project->name }}</p>
        </div>
        <div class="ml-6 mb-6 w-96">
            <p class="mb-2 text-slate-500">{{ __("Lien du projet") }}</p>
            <p class="block mb-2 text-sm font-medium text-gray-900" >{{$project->link}}</p>
        </div>
        <div class="ml-6 mb-6 w-96">
            <p class="mb-2 text-slate-500">{{ __("Description du projet") }}</p>
            <p class="block mb-2 text-sm font-medium text-gray-900" >{{$project->description}}</p>
        </div>
        <div class="ml-6 mb-6">
            <p class="mb-2 text-slate-500">{{ __("Pondération du projet") }}</p>
            <p class="block mb-2 text-sm font-medium text-gray-900" >{{$project->ponderation.' %' }}</p>
        </div>
    </div>
</div>
