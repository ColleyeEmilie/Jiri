<div>
    <form action="{{ route('projets.update', $project) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="name"> {{ __('Nom') }} </label>
            <input type="text" id="name" name="name" value="{{ $project->name }}" required>
        </div>

        <div>
            <label for="link"> {{ __('Lien') }} </label>
            <input type="text" id="link" name="link" value="{{ $project->link }}" >
        </div>

        <div>
            <label for="ponderation" > {{ __('Pondération') }} </label>
            <input type="number" id="ponderation" name="ponderation" value="{{ $project->ponderation }}">
        </div>
        <div>
            <label for="description"> {{ __('Description') }} </label>
            <textarea id="description" name="description" rows="4" cols="50" value="{{ $project->description }}" required></textarea>
        </div>
        <div>
            <button class="bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded" type="submit">
                {{ __(('Modifier le projet')) }}
            </button>
        </div>
    </form>
</div>
