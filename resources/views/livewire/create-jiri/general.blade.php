<div>
    <div x-data="{open:false}" class="bg-gray-50">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Informations générales") }} </h3>
            <button @click="open=!open" x-html="open ? '-' :'+' " ></button>
        </div>

        <div x-show="open" x-cloak x-transition>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form action="{{ route('jiris.store') }}" method="post">
                    @csrf
                    <div>
                        <label for="name">Nom de l'épreuve</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div>
                        <label for="starting_at">Date de l'épreuve</label>
                        <input type="datetime-local" name="starting_at" id="starting_at">
                    </div>
                    <div>
                        <button class="bg-transparent hover:bg-orange-400 text-orange-400 font-semibold hover:text-white py-2 px-4 border border-orange-400 hover:border-transparent rounded" type="submit">
                            Créer le jury
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
