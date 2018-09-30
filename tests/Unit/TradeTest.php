<?php

namespace Tests\Unit;

use App\Book;
use App\Trade;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TradeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_all_fields()
    {
        $requestedBook = factory(Book::class)->create();
        $offeredBook = factory(Book::class)->create();

        $trade = factory(Trade::class)->create([
            'requested_book_id' => $requestedBook->id,
            'offered_book_id' => $offeredBook->id,
            'status' => 'approved'
        ]);

        $this->assertInstanceOf(Book::class, $trade->requestedBook);
        $this->assertInstanceOf(Book::class, $trade->offeredBook);
        $this->assertEquals('approved', $trade->status);
    }
}
