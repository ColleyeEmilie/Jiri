<?php

namespace App\Livewire\Projets;

use Livewire\Component;

class EditProject extends Component
{

    public $project;
    public function mount($project): void
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.projets.edit-project');
    }
}
