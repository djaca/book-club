<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_additional_fields()
    {
        $user = factory(User::class)->create([
            'city' => 'Belgrade',
            'state' => 'Serbia',
        ]);

        $this->assertEquals('Belgrade', $user->city);
        $this->assertEquals('Serbia', $user->state);
    }
}
