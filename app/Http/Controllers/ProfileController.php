<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show profile page.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user)
    {
        $user->load('books');

        return view('profile.index', compact('user'));
    }

    /**
     * Update user profile.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User                $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        if(auth()->user()->id !== $user->id) {
            flash()->warning('You cannot update another user profile');

            return redirect()->home();
        }

        $user->update($request->all());

        flash()->success('Profile updated successfully');

        return back();
    }
}
