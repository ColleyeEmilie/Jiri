<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Jiri;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class JiriCreate extends Component
{
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('livewire.jiri-create');
    }
}
