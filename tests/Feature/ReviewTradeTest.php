<?php

namespace Tests\Feature;

use App\Book;
use App\Trade;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewTradeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_review_trade()
    {
        $trade = factory(Trade::class)->create();

        $this->post(route('trade.review', $trade), [])
             ->assertRedirect(route('login'));
    }

    /** @test */
    public function user_can_reject_trade_for_his_book()
    {
        $user = factory(User::class)->create();
        $requestedBook = factory(Book::class)->create(['user_id' => $user->id]);
        $trade = factory(Trade::class)->create(['requested_book_id' => $requestedBook->id]);

        $this->signIn($user)
             ->post(route('trade.review', $trade), ['reject' => 'Reject']);

        $this->assertEquals('rejected', $trade->fresh()->status);
    }

    /** @test */
    public function user_can_accept_trade_for_his_book()
    {
        $userOfRequestedBook = factory(User::class)->create();
        $requestedBook = factory(Book::class)->create(['user_id' => $userOfRequestedBook->id]);

        $userOfOfferedBook = factory(User::class)->create();
        $offeredBook = factory(Book::class)->create(['user_id' => $userOfOfferedBook->id]);

        $trade = factory(Trade::class)->create([
            'requested_book_id' => $requestedBook->id,
            'offered_book_id' => $offeredBook->id
        ]);

        $this->signIn($userOfRequestedBook)
             ->post(route('trade.review', $trade), ['accept' => 'Accept']);

        $this->assertEquals('approved', $trade->fresh()->status);
        $this->assertEquals($requestedBook->fresh()->user->id, $userOfOfferedBook->id);
        $this->assertEquals($offeredBook->fresh()->user->id, $userOfRequestedBook->id);
    }
}
