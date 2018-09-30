<?php

namespace App\Policies;

use App\User;
use App\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the book.
     *
     * @param  \App\User $user
     * @param  \App\Book $book
     *
     * @return mixed
     */
    public function delete(User $user, Book $book)
    {
        return $user->id === $book->user->id;
    }
}
