@extends('layouts.app')

@section('content')
  <div class="row">
    <ul class="list-group w-100">
      @forelse($requests as $request)
        <li class="list-group-item lead mb-3">

          <a href="{{ route('profile', $request->offeredBook->user) }}">
            {{ $request->offeredBook->user->name }}
          </a> wants to give
          "{{ $request->offeredBook->title }}" in exchange for
          "{{ $request->requestedBook->title }}" from
          <a href="{{ route('profile', $request->requestedBook->user) }}">
            {{ $request->requestedBook->user->name }}
          </a>

          <div class="float-right">
            @auth
              @if(auth()->id() == $request->offeredBook->user->id)
                <button
                  type="button"
                  data-href="{{ route('trade.destroy', $request) }}"
                  class="btn btn-outline-danger btn-sm"
                  data-toggle="tooltip"
                  title="Cancel request"
                >
                  X
                </button>
              @endif

              @if(auth()->id() == $request->requestedBook->user->id)
                <form method="POST" action="{{ route('trade.review', $request) }}">
                  @csrf
                  <input type="submit" class="btn btn-primary btn-sm" value="Accept" name="accept" role="button">
                  <input type="submit" class="btn btn-danger btn-sm" value="Reject" name="reject" role="button">
                </form>
              @endif
            @endauth
          </div>
        </li>
      @empty
        <h4>No book requests at this moment</h4>
      @endforelse
    </ul>

    <form method="POST" id="delete-form" class="invisible">
      @csrf
      {{ method_field('DELETE') }}
    </form>
  </div>
@endsection

@if(!$requests->isEmpty())
@section('js')
  <script>
    $(document).ready(function () {
      $('.btn-outline-danger').on('click', function () {
        $('#delete-form').attr('action', $(this).attr('data-href')).submit()
      })
    })
  </script>
@endsection
@endif
