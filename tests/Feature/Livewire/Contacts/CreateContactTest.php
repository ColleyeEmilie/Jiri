<?php
use App\Livewire\Contacts\CreateContact;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;

it('renders successfully', function () {
    Livewire::test(CreateContact::class)
        ->assertStatus(200);
});


it('allows auth user to access to the page "contacts"', function(){
    $user = User::factory()->create();
    $this->actingAs($user)
        ->get(route('contacts.index'))
        ->assertOk();
});



