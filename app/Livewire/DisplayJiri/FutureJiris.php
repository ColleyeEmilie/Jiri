<?php

namespace App\Livewire\DisplayJiri;

use App\Models\Jiri;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class FutureJiris extends Component
{
    public $futureJiris;

    public function mount(): void
    {
        $this->futureJiris = Jiri::orderBy('created_at', 'desc')->whereDate('starting_at', '>', Carbon::today()->toDateString())->get();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.displayJiris.future-jiris');
    }
}
