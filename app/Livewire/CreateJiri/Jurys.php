<?php

namespace App\Livewire\CreateJiri;

use App\Models\Jiri;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Jurys extends Component
{
    public $contactsList;
    public $users;
    public $name = '';
    public $firstname = '';
    public $email = '';
    public $currentUser = '';
    public $infoCurrentUser;
    public $lastJiri;
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
    public function addedJurys()
    {
        return $this
            ->lastJiri
            ->attendances()
            ->with('contact')
            ->where('role','jury')
            ->get();
    }
    #[Computed]
    public function addProjects()
    {
        return auth()->user()->projects()
            ->join('duties', 'projects.id', '=', 'duties.project_id')
            ->select('*')
            ->where('duties.deleted_at', null)
            ->where('jiri_id', '=', $this->lastJiri->id)
            ->get()->toArray();
    }
    #[Computed]
    public function addedStudents()
    {
        return $this
            ->lastJiri
            ->attendances()
            ->with('contact')
            ->where('role','student')
            ->get();
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

    public function lastJiri(): void
    {
        $this->lastJiri = Jiri::orderBy('created_at', 'desc')->first();
    }
    public function lastStudent(): void
    {
        $this->lastStudent = auth()->user()->contacts()->where('email', '=', $this->studentEmail)->first();
    }
    public function lastJury(): void
    {
        $this->lastJury = auth()->user()->contacts()->where('email', '=', $this->email)->first();
    }
    public function mount(): void
    {
        $this->lastJiri();
    }
    public function newUser(): void
    {
        if ($this->email === '') {
            $this->infoCurrentUser = preg_split('/[,:]+/', $this->currentUser);
            if (count($this->infoCurrentUser) === 3) {
                $this->firstname = $this->infoCurrentUser[0];
                $this->name = $this->infoCurrentUser[1];
                $this->email = $this->infoCurrentUser[2];
            }
            $this->firstname = $this->infoCurrentUser[0];
            $this->name = $this->infoCurrentUser[1];
            $this->email = $this->infoCurrentUser[2];
        }
        $this->juryId = auth()
            ->user()
            ?->contacts()
            ->updateOrCreate(
                ['email' => $this->email],
                [
                    'name' => $this->name,
                    'firstname' => $this->firstname,
                    'email' => $this->email,
                    'user_id' => auth()->id(),
                ]
            )->id;

        $this->lastJiri();
        $this->lastJury();
        $this->addJuryRole();
        $this->reset('currentUser', 'name', 'firstname', 'email');
    }
    public function newStudent(): void
    {
        if ($this->studentEmail === '') {
            $this->infoCurrentStudent = preg_split('/[,:]+/', $this->currentStudent);
            if (count($this->infoCurrentStudent) === 3) {
                $this->studentFirstname = $this->infoCurrentStudent[0];
                $this->studentName = $this->infoCurrentStudent[1];
                $this->studentEmail = $this->infoCurrentStudent[2];
            }
            $this->studentFirstname = $this->infoCurrentStudent[0];
            $this->studentName = $this->infoCurrentStudent[1];
            $this->studentEmail = $this->infoCurrentStudent[2];
        }
        $this->studentId = auth()
            ->user()
            ?->contacts()
            ->updateOrCreate(
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
                    'jiri_id' => $this->lastJiri->id,
                ],
                [
                    'role' => 'student',
                    'token' => bin2hex(random_bytes(16)),
                    'contact_id' => $this->lastStudent->id,
                    'jiri_id' => $this->lastJiri->id,
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
                    'jiri_id' => $this->lastJiri->id,
                ],
                [
                    'role' => 'jury',
                    'token' => bin2hex(random_bytes(16)),
                    'contact_id' => $this->lastJury->id,
                    'jiri_id' => $this->lastJiri->id,
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
        unset($this->addStudents);
        unset($this->addJurys);
    }
    public function addImplementations(): void
    {
        foreach ($this->addedStudents() as $index => $student){
            foreach ($this->addProjects() as $index2 => $project){
                $this->addImplementations = auth()
                    ->user()
                    ->implementations()
                    ->create(
                        [
                            'project_id' => $this->addProjects()[$index2]['id'],
                            'jiri_id' => $this->lastJiri->id,
                            'contact_id' => $this->addedStudents()[$index]['id'],
                        ],
                        [
                            'contact_id' => $this->addedStudents()[$index]['id'],
                            'jiri_id' => $this->lastJiri->id,
                            'project_id' => $this->addProjects()[$index2]['id'],
                        ]
                    );
            }
        }
    }

}
