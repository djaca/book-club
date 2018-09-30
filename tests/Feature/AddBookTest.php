<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddBookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_book()
    {
        $this->post(route('books.store'), [])
             ->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_can_add_book()
    {
        Storage::fake('public');
        $img = UploadedFile::fake()->image('car.jpg');
        $user = factory(User::class)->create();

        $this->signIn($user)
             ->post(route('books.store'), [
                 'title' => 'Laravel book',
                 'img' => $img
             ]);

        $this->assertEquals('Laravel book', $user->books()->first()->title);
        Storage::disk('public')->assertExists('images/books/' . $img->hashName());
    }

    /** @test */
    public function it_requires_a_title()
    {
        $this->signIn()
             ->post(route('books.store'), ['title' => null])
             ->assertSessionHasErrors('title');
    }

    /** @test */
    public function image_must_be_valid_if_provided()
    {
        $this->signIn()
             ->post(route('books.store'), ['img' => 'not-an-image'])
             ->assertSessionHasErrors('img');
    }
}
