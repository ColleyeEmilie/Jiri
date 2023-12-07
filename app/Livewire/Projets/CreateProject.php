<?php

namespace App\Livewire\Projets;

use App\Models\Project;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateProject extends Component
{
    #[Rule('required', message: 'Le nom du projet doit être entré!')]
    public $name = '';
    #[Rule('required', message: 'L URL doit être entrée')]
    public $link = '';
    #[Rule('required', message: 'Il doit y avoir une pondération')]
    public $ponderation = '';
    public $description = '';
    public function render()
    {
        return view('livewire.projets.create-project');
    }
    public function newProject(){
        $this->validate();

        Project::factory()->create([
            'name' => $this->name,
            'link' => $this->link,
            'ponderation' => $this->ponderation,
            'description' => $this->description,
            'user_id' => auth()->id(),
        ]);
    }


}
