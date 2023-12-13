<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $emilie = User::factory()
            ->has(Jiri::factory()->count(7))
            ->has(Project::factory()->count(10))
            ->has(Contact::factory()->count(20))
            ->create([
                'name' => 'Emilie Colleye',
                'email' => 'colleyeemilie@hotmail.com',
                'password' => bcrypt('change_this'),
            ]);
        $myriam = User::factory()
            ->has(Jiri::factory()->count(2))
            ->has(Project::factory()->count(4))
            ->has(Contact::factory()->count(20))
            ->create([
                'name' => 'Myriam Dupont',
                'email' => 'myriam.dupont@hepl.be',
                'password' => bcrypt('change_this'),
            ]);

        $users = collect([$emilie, $myriam]);

        foreach ($users as $user) {
            foreach ($user->jiris as $jiri) {
                $selectedContacts = $user->contacts->random(random_int(3, 10));
                foreach ($selectedContacts as $contact) {
                    $role = random_int(0, 1) ? 'students' : 'evaluators';
                    $jiri->$role()->attach([
                        $contact->id => [
                            'role' => str($role)->beforeLast('s'),
                        ],
                    ]);

                    if ($role === 'students') {
                        $contact->projects()->attach(
                            $user->projects->random(2),
                            [
                                'jiri_id' => $jiri->id,
                                'urls' => json_encode([
                                    'github' => 'https://github.com',
                                    'trello' => 'https://trello.com'], JSON_THROW_ON_ERROR),
                            ]
                        );
                    }
                    if ($role === 'evaluators') {
                        //create access token for evaluator
                        $contact->jiris()->updateExistingPivot($jiri->id, [
                            'token' => Str::random(32),
                        ]);
                    }
                }
            }
        }

    }
}
