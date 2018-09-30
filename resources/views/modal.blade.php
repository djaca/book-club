<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">
    Choose which book you want to trade with '{{ $book->title }}' from
    <a href="{{ route('profile', $book->user) }}">{{ $book->user->name }}</a>
  </h5>

  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-body">
  @guest
    Please <a href="{{ route('login') }}">sign in</a> to add book
  @endguest

  @auth
    <form method="POST" action="{{ route('trade') }}" id="request-form">
      @csrf

      <input type="hidden" name="requested_book_id" value="{{ $book->id }}">

      @forelse($books as $userBook)
        <div class="custom-control custom-radio">
          <input
            type="radio"
            id="book-{{ $userBook->id }}"
            name="offered_book_id"
            value="{{ $userBook->id }}"
            class="custom-control-input"
          >
          <label
            class="custom-control-label"
            for="book-{{ $userBook->id }}"
          >
            {{ $userBook->title }}
          </label>
        </div>
      @empty
        Please <a href="{{ route('profile', auth()->user()) }}">add book</a> in order to swap with this one
      @endforelse
    </form>
  @endauth
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  @auth
    @if(auth()->user()->id !== $book->user->id)
      <button
        type="button"
        class="btn btn-primary"
        onclick="event.preventDefault();document.getElementById('request-form').submit();"
      >
        Submit request
      </button>
    @endif
  @endauth
</div>
