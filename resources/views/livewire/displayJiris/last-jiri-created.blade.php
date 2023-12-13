<div class="mb-4">
    <div x-data="{open:false}" class="bg-gray-50">
        <div @click="open=!open" class=" cursor-pointer flex justify-between px-5 py-4 mb-2 border-b-2">
            <h3 class="text-lg font-semibold"> {{ __("Dernière épreuve créée") }} </h3>
            <button x-html="open ? '-' :'+' " ></button>
        </div>
        <div x-show="open" x-cloak x-transition>
            <ul class="list-none ml-4">
                @foreach($lastJiris as $jiri)
                    <li class="mb-2 py-2 flex" ><a href="/jiris/{{ $jiri->id }}"> {{ $jiri->name }} - pour le {{ $jiri->starting_at }} </a>
                        <a class="self-center ml-4" href="/jiris/{{ $jiri->id }}/edit"><img class="w-6 h-6" src="{{asset('icons/crayon.svg')}}" alt="icon de modification de jiri"></a>
                        <form  class="self-center ml-4 h-6" action="/jiris/{{ $jiri->id }}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit"><img class="w-6 h-6" src="{{asset('icons/delete.svg')}}" alt="icon de suppression d'utilisateur"></button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

