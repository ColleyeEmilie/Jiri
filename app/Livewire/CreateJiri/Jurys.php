<?php

namespace App\Livewire\CreateJiri;

use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Jiri;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Jurys extends Component
{
    public $jurys;
    public $name = '';
    public $firstname = '';
    public $email='';
    public $currentUser = '';
    public $infoCurrentUser;
    public $lastJiri;
    public int|null $juryId;
    public $lastJury;

    #[computed]
    public function users()
    {
        return $this->currentUser ? Contact::where('name', 'like', '%' . $this->name . '%')->get() : new Collection();
    }
    public function addJurys(){
        return $this->jurys = Contact::
        join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->where('role', '=', 'jury')
            ->select('contacts.*', 'attendances.*')
            ->get();
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
    }
    public function newUser()
    {
        if($this->email ===''){
            $this->infoCurrentUser = preg_split("/[,:]+/", $this->currentUser);
            $this->firstname = $this->infoCurrentUser[0];
            $this->name= $this->infoCurrentUser[1];
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
    }
    public function addJuryRole(){
        $this->addJury = Attendance::create([
            'role' => 'jury',
            'token' => bin2hex(random_bytes(16)),
            'contact_id' => $this->lastJury->id,
            'jiri_id' => $this->lastJiri->id,
        ]);

        $this->addJury = auth()
            ->user()
            ?->attendances()
            ->firstOrCreate(
                [
                    'contact_id' => $this->lastJury->id,
                    'jiri_id' => $this->lastJiri->id
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
