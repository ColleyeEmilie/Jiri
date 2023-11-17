<?php

namespace App\Livewire\DisplayJiri;

use App\Models\Jiri;
use Carbon\Carbon;
use Livewire\Component;

class OldJiris extends Component
{
    public $oldJiris;
    public function mount()
    {
        $this->oldJiris = Jiri::orderBy('created_at','asc')->whereDate('starting_at', '<', Carbon::today()->toDateString())->get();
    }

    public function render()
    {
        return view('livewire.displayJiris.old-jiris');
    }
}
