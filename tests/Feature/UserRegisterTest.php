<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function user_can_view_register_page()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function user_can_register()
    {
        $user = factory('App\User')->make();
    }

}
