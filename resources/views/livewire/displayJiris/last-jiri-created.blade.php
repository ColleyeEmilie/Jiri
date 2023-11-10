<div>
    <div x-data="{open:false}" class="bg-gray-50">
        <div class="flex justify-between px-5 py-2 mb-2 border-b-2">
            <h3> {{ __("Dernière épreuve créée") }} </h3>
            <button @click="open=!open" x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            @foreach($lastJiris as $jiri)
                <li><a href="/jiris/{{ $jiri->id }}"> {{ $jiri->name }} - pour le {{ $jiri->starting_at }} </a></li>
            @endforeach
        </div>
    </div>
</div>

