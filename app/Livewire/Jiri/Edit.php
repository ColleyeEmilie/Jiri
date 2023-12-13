<?php

namespace App\Livewire\Jiri;

use Livewire\Component;

class Edit extends Component
{
    public $jiri;

    public function mount($jiri): void
    {
        $this->jiri = $jiri;
    }

    public function render()
    {
        return view('livewire.jiri.edit', ['jiri']);
    }
}
