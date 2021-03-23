<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FamilyCountControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_results_page_with_ascendants_and_descendants()
    {
        $users = User::factory()->count(3)->create();

        $parent = $users->first();
        $middle = $users[1];
        $child = $users->last();

        $parent->saveAsRoot();
        $parent->appendNode($middle);
        $middle->appendNode($child);

        $this->assertDatabaseCount('users', 3);

        $this->get('/get-family-count?email=' . $middle->email)
            ->assertSessionDoesntHaveErrors()
            ->assertViewIs('results')
            ->assertViewHasAll([
                'ascendants' => 1,
                'descendants' => 1
            ]);
    }
}
