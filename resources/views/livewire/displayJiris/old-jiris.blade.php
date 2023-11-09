<div>
    <div x-data="{open:false}" class="bg-gray-50">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Anciennes épreuves") }} </h3>
            <button @click="open=!open" x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            @foreach($oldJiris as $jiri)
                <li>{{ $jiri->name }} - crée le {{ $jiri->created_at }} - pour le {{ $jiri->starting_at }}</li>
            @endforeach
        </div>
    </div>
</div>
