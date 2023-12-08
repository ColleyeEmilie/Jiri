<?php

namespace App\Livewire\CreateJiri;

use App\Models\Contact;
use App\Models\Jiri;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Students extends Component
{
    public $students;
    public $studentName = '';
    public $studentFirstname = '';
    public $studentEmail = '';
    public $currentStudent = '';
    public $infoCurrentStudent;
    public $lastJiri;
    public ?int $studentId;
    public $lastStudent;

    #[computed]
    public function users()
    {
        return $this->currentStudent ? Contact::where('name', 'like', '%'.$this->studentName.'%')->get() : new Collection();
    }

    public function addStudents()
    {
        $this->students = Contact::join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->select('contacts.name', 'contacts.firstname', 'attendances.role', 'attendances.token', 'attendances.jiri_id', 'attendances.contact_id')
            ->where('role', '=', 'student')
            ->where('jiri_id', '=', $this->lastJiri->id)
            ->get()->toArray();
    }

    public function lastJiri()
    {
        $this->lastJiri = Jiri::orderBy('created_at', 'desc')->first();
    }

    public function lastStudent()
    {
        $this->lastStudent = Contact::where('email', '=', $this->studentEmail)->first();
    }

    public function mount($studentId = 0): void
    {
        $this->studentId = $studentId;
        if ($studentId) {
            $student = auth()
                ->user()
                ?->jiris()
                ->findOrFail($studentId);

            $this->studentName = $student->name;
            $this->studentFirstname = $student->firstname;
            $this->studentEmail = $student->email;
        } else {
            $this->studentName = '';
            $this->studentFirstname = '';
            $this->studentEmail = '';
        }
        $this->lastJiri();
        $this->addStudents();
    }

    public function newStudent()
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
        $this->addStudents();
        $this->reset('currentStudent', 'studentName', 'studentFirstname', 'studentEmail');

    }

    public function addStudentRole()
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
}
