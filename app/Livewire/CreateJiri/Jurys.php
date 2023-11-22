<?php

namespace App\Livewire\CreateJiri;

use App\Models\Contact;
use App\Models\Jiri;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Jurys extends Component
{
    public $first;
    public $name = '';
    public $firstname = '';
    public $email = '';
    public $lastJiri;
    public int|null $juryId;
    public $lastJury;

    #[computed]
    public function users(){
        return $this->name? Contact::where('name', 'like','%'.$this->name.'%')->get() : new Collection();
    }

    public function lastJiri(){
         $this->lastJiri = Jiri::orderBy('created_at','desc')->first();
    }

    public function lastJury(){
        $this->lastJury = Contact::orderBy('created_at','desc')->first();
    }

    public function mount($juryId = 0): void
    {
        $this->juryId= $juryId;

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

    public function newUser(){
        $this->lastJiri();
        $this->lastJury();
        dd($this->lastJiri, $this->lastJury);
        $this->juryId = auth()
            ->user()
            ?->contacts()
            ->updateOrCreate(
                ['id' => $this->juryId],
                [
                    'name' => $this->name,
                    'firstname' => $this->firstname,
                    'email' => $this->email,
                    'user_id' => auth()->id(),
                ]
            )->id;
    }
}
