<?php

namespace Tests\Feature\Livewire\CreateJiri;

use App\Livewire\CreateJiri\General;
use App\Models\Jiri;
use Livewire\Livewire;
use Tests\TestCase;

class GeneralTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(General::class)
            ->assertStatus(200);
    }

    /** @test */
    public function can_create_new_jiri()
    {
        $jiri = Jiri::where('name', 'Design web')->first();
        $this->assertNull($jiri);
        Livewire::test(General::class)
            ->set('name', 'Design web')
            ->set('starting_at', '2024-06-27 08:49:00')
            ->call('save');

        $jiri = Jiri::where('name', 'Design web')->first();
        $this->assertNotNull($jiri);
        $this->assertEquals('Design Web', $jiri->name);
    }
}
