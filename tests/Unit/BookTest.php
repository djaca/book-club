<?php

namespace Tests\Unit;

use App\Book;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_all_fields()
    {
        $user = factory(User::class)->create();
        $book = factory(Book::class)->create([
            'title' => 'Laravel book',
            'img' => 'book-img',
            'user_id' => $user->id
        ]);

        $this->assertEquals('Laravel book', $book->title);
        $this->assertEquals(asset('book-img'), $book->img);
        $this->assertInstanceOf(User::class, $book->user);
    }
}
