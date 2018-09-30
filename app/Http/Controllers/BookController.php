<?php

namespace App\Http\Controllers;

use App\Book;
use App\Trade;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Add book.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'img' => 'image'
        ]);

        auth()->user()->addBook($request->only(['title', 'img']));

        flash()->success('Book added successfully');

        return back();
    }

    /**
     * Delete book.
     *
     * @param \App\Book $book
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        if ($this->hasPendingRequests($book)) {
            flash()->warning('You have pending requests for this book');

            return back();
        }

        $book->delete();

        flash()->success('Book deleted successfully');

        return back();
    }

    /**
     * Check if book has pending trade requests.
     *
     * @param \App\Book $book
     *
     * @return mixed
     */
    private function hasPendingRequests(Book $book)
    {
        return Trade::where('requested_book_id', $book->id)
                    ->orWhere('offered_book_id', $book->id)
                    ->pending()
                    ->exists();
    }
}
