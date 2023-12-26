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

    public $jiri;
    public $users;
    public $name = '';
    public $firstname = '';
    public $email = '';
    public $currentUser = '';
    public $infoCurrentUser;
    public ?int $juryId;
    public $lastJury;


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

        $this->lastJury();
        $this->addJuryRole();
        $this->reset('currentUser', 'name', 'firstname', 'email');
    }
    public function addJuryRole(): void
    {
        auth()
            ->user()
            ?->attendances()
            ->firstOrCreate(
                [
                    'contact_id' => $this->lastJury->id,
                    'jiri_id' => $this->jiri->id,
                ],
                [
                    'role' => 'jury',
                    'token' => bin2hex(random_bytes(16)),
                    'contact_id' => $this->lastJury->id,
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
    private function parseCurrentUser(): void
    {
        if ($this->email === '') {
            $this->infoCurrentUser = preg_split('/[,:]+/', $this->currentUser);
            $this->firstname = $this->infoCurrentUser[0];
            $this->name = $this->infoCurrentUser[1];
            $this->email = $this->infoCurrentUser[2];
        }
    }

}
