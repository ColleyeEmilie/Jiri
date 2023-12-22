<?php

namespace App\Livewire\DisplayJiri;

use App\Models\Jiri;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class OldJiris extends Component
{
    public $oldJiris;

    public function mount(): void
    {
        $this->oldJiris = Jiri::orderBy('created_at', 'asc')->whereDate('starting_at', '<', Carbon::today()->toDateString())->get();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.displayJiris.old-jiris');
    }
}
