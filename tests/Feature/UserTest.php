<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_user()
    {
        $parent = User::factory()->create();
        $parent->saveAsRoot();

        $attributes = [
            'email' => 'test@mail.com',
            'parent' => $parent->email,
            'children' => []
        ];

        $this->post('/users', $attributes)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('users', [
            'email' => 'test@mail.com',
            'parent_id' => $parent->id
        ]);
    }

    /** @test */
    public function it_allows_searching_for_a_user()
    {
        User::factory()->create([
            'email' => 'test@mail.com'
        ]);

        $this->get('/users?query=' . 'test')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                [ 'email' => 'test@mail.com' ]
            ]);
    }
}
