<?php

namespace App\Livewire\Projets;

use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class DisplayProject extends Component
{
    use WithPagination;
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.projets.display-project', ['projects' => Project::orderBy('name','asc')->paginate(15)]);
    }
}
