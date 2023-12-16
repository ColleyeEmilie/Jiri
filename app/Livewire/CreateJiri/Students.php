<?php

namespace App\Livewire\CreateJiri;

use App\Models\Jiri;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use LaravelIdea\Helper\App\Models\_IH_Attendance_C;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Students extends Component
{

    public Jiri $lastJiri;

    #[Computed]
    public function lastJiri(): Jiri
    {
        return Jiri::orderBy('created_at', 'desc')->first();
    }

    #[Computed]
    public function addedStudents(): Collection|array|_IH_Attendance_C
    {
        return $this
            ->lastJiri()
            ->attendances()
            ->with('contact')
            ->where('role','student')
            ->get();
    }

    #[Computed]
    public function addedProjects()
    {
        return auth()->user()
            ->projects()
            ->join('duties', 'projects.id', '=', 'duties.project_id')
            ->where('duties.deleted_at', null)
            ->where('jiri_id', '=', $this->lastJiri()->id)
            ->get();
    }

    public function deleteContactRole($contact_id, $jiri_id): void
    {
        auth()->user()->attendances()
            ->where([
                ['contact_id', '=', $contact_id],
                ['jiri_id', '=', $jiri_id]
            ])
            ->delete();
        unset($this->addStudents);
        unset($this->addJurys);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-jiri.students');
    }
}
