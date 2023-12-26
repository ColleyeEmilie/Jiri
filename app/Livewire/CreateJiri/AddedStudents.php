<?php

namespace App\Livewire\CreateJiri;

use App\Traits\CreateJiri;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use LaravelIdea\Helper\App\Models\_IH_Attendance_C;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddedStudents extends Component
{
    use CreateJiri;

    public $jiri;
    public $name;
    public $studentName = '';
    public $studentFirstname = '';
    public $studentEmail = '';
    public $currentStudent = '';
    public $infoCurrentStudent;
    public $lastStudent;
    public ?int $studentId;

    public function mount($jiri): void
    {
        $this->jiri = $jiri;
    }
    #[Computed]
    public function addedJurys(): Collection|array|_IH_Attendance_C
    {
        return $this->listOfJiriJurys($this->jiri);
    }
    #[Computed]
    public function addedProjects()
    {
        return $this->listOfJiriProjects($this->jiri);
    }
    #[Computed]
    public function addedStudents(): Collection|array|_IH_Attendance_C
    {
        return $this->listOfJiriStudents($this->jiri);
    }
    #[Computed]
    public function filteredAvailableContacts($jiri_id)
    {
        return auth()->
        user()->
        contacts()
            ->where(function ($q) use ($jiri_id) {
                $q->where('name', 'like', '%' . $this->name . '%')
                    ->whereDoesntHave('attendances', function ($query) use ($jiri_id) {
                        $query->where('jiri_id', $jiri_id);
                    });
            })
            ->get();
    }
    public function lastStudent(): void
    {
        $this->lastStudent = auth()->user()->contacts()->where('email', '=', $this->studentEmail)->first();
    }

    public function newStudent(): void
    {
        $this->parseCurrentStudent();

        $this->studentId = auth()->user()->contacts()->updateOrCreate(
            ['email' => $this->studentEmail],
            [
                'name' => $this->studentName,
                'firstname' => $this->studentFirstname,
                'email' => $this->studentEmail,
                'user_id' => auth()->id(),
            ]
        )->id;

        $this->lastStudent();
        $this->addStudentRole();
        $this->addImplementations();
        $this->reset('currentStudent', 'studentName', 'studentFirstname', 'studentEmail');
    }
    public function addStudentRole(): void
    {
        auth()
            ->user()
            ?->attendances()
            ->firstOrCreate(
                [
                    'contact_id' => $this->lastStudent->id,
                    'jiri_id' => $this->jiri->id,
                ],
                [
                    'role' => 'student',
                    'token' => bin2hex(random_bytes(16)),
                    'contact_id' => $this->lastStudent->id,
                    'jiri_id' => $this->jiri->id,
                ]
            );
    }
    public function deleteContactRole($contact_id, $jiri_id): void
    {
        auth()->user()->attendances()
            ->where([
                ['contact_id', '=', $contact_id],
                ['jiri_id', '=', $jiri_id]
            ])
            ->delete();
    }
    public function addImplementations(): void
    {
        $lastJiriId = $this->jiri->id;

        foreach ($this->addedStudents() as $student) {
            foreach ($this->addedProjects() as $project) {
                auth()->user()->implementations()
                    ->firstOrCreate(
                        [
                            'project_id' => $project->id,
                            'jiri_id' => $lastJiriId,
                            'contact_id' => $student->id,
                        ],
                        [
                            'contact_id' => $student->id,
                            'jiri_id' => $lastJiriId,
                            'project_id' => $project->id,
                        ]
                    );
            }
        }
    }
    private function parseCurrentStudent(): void
    {
        if ($this->studentEmail === '') {
            $this->infoCurrentStudent = preg_split('/[,:]+/', $this->currentStudent);
            $this->studentFirstname = $this->infoCurrentStudent[0];
            $this->studentName = $this->infoCurrentStudent[1];
            $this->studentEmail = $this->infoCurrentStudent[2];
        }
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-jiri.added-students');
    }
}
