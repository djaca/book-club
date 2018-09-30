<?php

namespace App\Http\Controllers;

use App\Book;

class HomeController extends Controller
{
    /**
     * Show home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->get();

        return view('home', compact('books'));
    }

    /**
     * Render view for modal.
     *
     * @param \App\Book $book
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function modal(Book $book)
    {
        $book = $book->load('user');

        $books = auth()->user() ? auth()->user()->books : collect();

        return view('modal', compact('book', 'books'));
    }
}
