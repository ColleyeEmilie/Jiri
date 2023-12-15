<?php

namespace App\Livewire\Projets;

use Livewire\Component;


class Show extends Component
{
    public $project;

    public function mount($project){
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.projets.show');
    }
}
