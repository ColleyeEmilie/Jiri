<?php

namespace App\Livewire\Jiri;

use App\Models\Contact;
use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Edit extends Component
{
    public $jiri;
    public $jurys;
    public $students;
    public $projects;

    public function mount($jiri): void
    {
        $this->jiri = $jiri;
        $this->addJurys();
        $this->students();
        $this->projects();

    }

    public function addJurys()
    {
        $this->jurys = auth()->user()->contacts()->join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->where('role', '=', 'jury')
            ->where('jiri_id', '=', $this->jiri->id)
            ->get()->toArray();
    }

    public function students(): void
    {
        $this->students = auth()->user()->contacts()->join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->where('role', '=', 'student')
            ->where('jiri_id', '=', $this->jiri->id)
            ->get()->toArray();
    }

    public function projects(): void
    {
        $this->projects = auth()->user()->jiris()->join('duties','projects.id', '=', 'duties.project_id' )
            ->where('jiri_id', '=', $this->jiri->id)
            ->get()->toArray();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.jiri.edit');
    }
}
