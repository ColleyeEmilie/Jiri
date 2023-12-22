<?php

namespace App\Livewire\Projets;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class EditProject extends Component
{
    public $project;

    public function mount($project): void
    {
        $this->project = $project;
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.projets.edit-project');
    }
}
