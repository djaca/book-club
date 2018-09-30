@extends('layouts.app')

@section('content')
  <div class="card mb-4">
    <h5 class="card-header">Profile</h5>
    <div class="card-body">
      @auth
        @if (auth()->user()->id === $user->id)
          @include('profile._form')
        @else
          @include('profile.show')
        @endif
      @endauth

      @guest
        @include('profile.show')
      @endguest
    </div>
  </div>

  @include('profile.books')

  @auth
    @if (auth()->user()->id === $user->id)
      @include('profile.add_book_form')
    @endif
  @endauth
@endsection
