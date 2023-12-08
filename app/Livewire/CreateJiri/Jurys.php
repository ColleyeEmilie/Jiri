<?php

namespace App\Livewire\CreateJiri;

use App\Models\Contact;
use App\Models\Jiri;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Jurys extends Component
{
    public $jurys;
    public $users;
    public $name = '';
    public $firstname = '';
    public $email = '';
    public $students;
    public $currentUser = '';
    public $infoCurrentUser;
    public $lastJiri;
    public ?int $juryId;
    public $lastJury;
    public function addJurys()
    {
        $this->jurys = Contact::join('attendances', 'contacts.id', '=', 'attendances.contact_id')
           ->select('contacts.id','contacts.name', 'contacts.firstname', 'attendances.role', 'attendances.token', 'attendances.jiri_id', 'attendances.contact_id')
           ->where('role', '=', 'jury')
           ->where('jiri_id', '=', $this->lastJiri->id)
           ->get()->toArray();
    }

    public function addStudents()
    {
        $this->students = Contact::join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->select('contacts.id','contacts.name', 'contacts.firstname', 'attendances.role', 'attendances.token', 'attendances.jiri_id', 'attendances.contact_id')
            ->where('role', '=', 'student')
            ->where('jiri_id', '=', $this->lastJiri->id)
            ->get()->toArray();
    }

    public function allContacts(){
        $query = Contact::where('name', 'like', '%'.$this->name.'%')->get();

        $jurysID = collect($this->jurys)->pluck('id')->toArray();

        $studentsID = collect($this->students)->pluck('id')->toArray();

        //dd($this->users->whereNotIn('id',$jurysID));
        $query->whereNotIn('id',$jurysID);
        $this->users = $query->whereNotIn('id',$studentsID);

        //dd($jurysID, $studentsID);
    }
    public function lastJiri()
    {
        $this->lastJiri = Jiri::orderBy('created_at', 'desc')->first();
    }

    public function lastJury()
    {
        $this->lastJury = Contact::where('email', '=', $this->email)->first();
    }

    public function mount($juryId = 0): void
    {
        $this->juryId = $juryId;
        if ($juryId) {
            $jury = auth()
                ->user()
                ?->jiris()
                ->findOrFail($juryId);

            $this->name = $jury->name;
            $this->firstname = $jury->firstname;
            $this->email = $jury->email;
        } else {
            $this->name = '';
            $this->firstname = '';
            $this->email = '';
        }


        $this->lastJiri();
        $this->addJurys();
        $this->addStudents();
        $this->allContacts();
    }

    public function newUser()
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
        $this->addJurys();
        $this->reset('currentUser', 'name', 'firstname', 'email');

    }

    public function addJuryRole()
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
}
