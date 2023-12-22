<?php

namespace App\Livewire\DisplayJiri;

use App\Models\Jiri;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class lastJiriCreated extends Component
{
    public $lastJiris;

    public function mount(): void
    {
        $this->lastJiris = Jiri::orderBy('created_at', 'desc')->take(1)->get();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.displayJiris.last-jiri-created');
    }
}
