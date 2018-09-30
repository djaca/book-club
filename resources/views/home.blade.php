@extends('layouts.app')

@section('content')
  <div class="row">
    @forelse($books as $book)
      <div class="col-xs-3 col-sm-3 col-md-2 px-2 mb-3">
        <a
          href="#"
          class="openPopup"
          data-href="{{ route('book', $book) }}"
        >
          <img src="{{ $book->img }}" alt="Book" class="w-100">
        </a>
      </div>
      @empty
      <div class="h4">No books</div>
    @endforelse
  </div>

  <div
    class="modal fade"
    id="myModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content"></div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $(document).ready(function () {
      $('.openPopup').on('click', function () {
        let dataURL = $(this).attr('data-href')

        $('.modal-content').load(dataURL, function () {
          $('#myModal').modal({show: true})
        })
      })
    })
  </script>
@endsection
