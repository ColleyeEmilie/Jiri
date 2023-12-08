<div class="mb-4">
    <div x-data="{open:false}" class="bg-gray-50">
        <div @click="open=!open" class=" cursor-pointer flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Épreuves prévues") }} </h3>
            <button x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <ul class="list-none ml-4">
                @foreach($futureJiris as $jiri)
                    <li class="mb-2"><a href="/jiris/{{ $jiri->id }}"> {{ $jiri->name }} - pour le {{ $jiri->starting_at }} </a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
