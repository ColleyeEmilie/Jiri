<?php

namespace App\Livewire\Projets;

use App\Models\Project;
use Livewire\Component;

class DisplayProject extends Component
{
    public $projects;
    public function mount(){
        $this->projects = Project::orderBy('created_at','desc')->get();
    }
    public function render()
    {
        return view('livewire.projets.display-project');
    }
}
