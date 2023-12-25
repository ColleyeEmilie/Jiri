<?php

namespace App\Livewire;

use App\Models\Jiri;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class JiriCreate extends Component
{
    public Jiri $jiri;
    public $jiriName;
    public $jiriDate;

    public function createJiri(): void
    {
        $this->jiri = auth()->user()->jiris()->create([
            'name' => $this->jiriName,
            'starting_at' => $this->jiriDate,
            'user_id' => auth()->id(),
        ]);
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('livewire.jiri-create');
    }
}
