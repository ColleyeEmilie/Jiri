<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new jiri') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('jiris.store') }}" method="post">
                @csrf
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                </div>
                <div>
                    <label for="starting_at">Starting date and time</label>
                    <input type="datetime-local" name="starting_at" id="starting_at">
                </div>
                <div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded" type="submit">Create this jiri</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
