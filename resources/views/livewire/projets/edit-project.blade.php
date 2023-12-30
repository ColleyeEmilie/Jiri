<div class="bg-white relative content-position">
    <form action="{{ route('projets.update', $project) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-8">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900"> {{ __('Nom') }} </label>
            <input type="text" id="name" name="name" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 " value="{{ $project->name }}" required>
        </div>
        <div class="mb-8">
            <label for="link" class="block mb-2 text-sm font-medium text-gray-900"> {{ __('Lien') }} </label>
            <input type="text" id="link" name="link" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 " value="{{ $project->link }}" >
        </div>
        <div class="mb-8">
            <label for="ponderation" class="block mb-2 text-sm font-medium text-gray-900"> {{ __('Pondération') }} </label>
            <input type="number" id="ponderation" name="ponderation" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 " value="{{ $project->ponderation }}">
        </div>
        <div class="mb-8">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900"> {{ __('Description') }} </label>
            <textarea id="description" name="description" rows="4" cols="50" class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 " value="{{ $project->description }}" required></textarea>
        </div>
        <div class="mb-8">
            <button class="bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded" type="submit">
                {{ __(('Modifier le projet')) }}
            </button>
        </div>
    </form>
</div>
