<?php

namespace App\Livewire\DisplayJiri;

use App\Models\Jiri;
use Carbon\Carbon;
use Livewire\Component;

class FutureJiris extends Component
{
    public $futureJiris;
    public function mount()
    {
        $this->futureJiris = Jiri::orderBy('created_at','desc')->whereDate('starting_at', '>', Carbon::today()->toDateString())->get();
    }

    public function render()
    {
        return view('livewire.displayJiris.future-jiris');
    }
}
