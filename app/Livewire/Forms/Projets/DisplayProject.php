<?php

namespace App\Livewire\Forms\Projets;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class DisplayProject extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.projets.display-project', ['projects' => Project::orderBy('name', 'asc')->paginate(15)]);
    }
}
