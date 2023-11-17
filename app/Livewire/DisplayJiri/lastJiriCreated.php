<?php

namespace App\Livewire\DisplayJiri;

use App\Models\Jiri;
use Livewire\Component;

class lastJiriCreated extends Component
{
    public $lastJiris;
    public function mount()
    {
        $this->lastJiris = Jiri::orderBy('created_at','desc')->take(1)->get();
    }
    public function render()
    {
        return view('livewire.displayJiris.last-jiri-created');
    }
}
