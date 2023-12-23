<?php

namespace App\Livewire\CreateJiri;

use App\Traits\CreateJiri;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Attendance_C;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Contacts extends Component
{
    use CreateJiri;

    public $contactsList;
    public $users;
    public $name = '';
    public $firstname = '';
    public $email = '';
    public $currentUser = '';
    public $infoCurrentUser;
    public ?int $juryId;
    public ?int $studentId;
    public $lastJury;
    public $studentName = '';
    public $studentFirstname = '';
    public $studentEmail = '';
    public $currentStudent = '';
    public $infoCurrentStudent;
    public $lastStudent;


    #[Computed]
    public function getLastJiri()
    {
        return $this->lastJiri();
    }
    #[Computed]
    public function addedJurys(): Collection|array|_IH_Attendance_C
    {
        return $this->listOfJiriJurys();
    }
    #[Computed]
    public function addedProjects()
    {
        return $this->listOfJiriProjects();
    }
    #[Computed]
    public function addedStudents(): Collection|array|_IH_Attendance_C
    {
        return $this->listOfJiriStudents();
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
    public function lastJury(): void
    {
        $this->lastJury = auth()->user()->contacts()->where('email', '=', $this->email)->first();
    }
    public function newUser(): void
    {
        $this->parseCurrentUser();

        $this->juryId = auth()->user()->contacts()->updateOrCreate(
            ['email' => $this->email],
            [
                'name' => $this->name,
                'firstname' => $this->firstname,
                'email' => $this->email,
                'user_id' => auth()->id(),
            ]
        )->id;

        $this->getLastJiri();
        $this->lastJury();
        $this->addJuryRole();
        $this->reset('currentUser', 'name', 'firstname', 'email');
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
        $this->addStudent = auth()
            ->user()
            ?->attendances()
            ->firstOrCreate(
                [
                    'contact_id' => $this->lastStudent->id,
                    'jiri_id' => $this->getLastJiri()->id,
                ],
                [
                    'role' => 'student',
                    'token' => bin2hex(random_bytes(16)),
                    'contact_id' => $this->lastStudent->id,
                    'jiri_id' => $this->getLastJiri()->id,
                ]
            );
    }
    public function addJuryRole(): void
    {
        $this->addJury = auth()
            ->user()
            ?->attendances()
            ->firstOrCreate(
                [
                    'contact_id' => $this->lastJury->id,
                    'jiri_id' => $this->getLastJiri()->id,
                ],
                [
                    'role' => 'jury',
                    'token' => bin2hex(random_bytes(16)),
                    'contact_id' => $this->lastJury->id,
                    'jiri_id' => $this->getLastJiri()->id,
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
        $lastJiriId = $this->getLastJiri()->id;

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

    private function parseCurrentUser(): void
    {
        if ($this->email === '') {
            $this->infoCurrentUser = preg_split('/[,:]+/', $this->currentUser);
            $this->firstname = $this->infoCurrentUser[0];
            $this->name = $this->infoCurrentUser[1];
            $this->email = $this->infoCurrentUser[2];
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

}
