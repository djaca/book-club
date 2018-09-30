<div class="card mb-4">
  <h5 class="card-header">Books</h5>
  <div class="card-body">
    <ul class="list-group">
      @forelse($user->books as $book)
        <li class="list-group-item">
          <span>{{ $book->title }}</span>

          @if(auth()->user()->id === $user->id)
            <button
              class="btn btn-danger btn-sm float-right"
              data-href="{{ route('books.destroy', $book) }}"
            >
              Delete
            </button>
          @else
            <button
              class="btn btn-info btn-sm float-right"
              data-href="{{ route('book', $book) }}"
            >
              Request
            </button>
          @endif
        </li>
      @empty
        <div>No books</div>
      @endforelse
    </ul>
  </div>
</div>

<form method="POST" id="delete-form" class="invisible">
  @csrf
  {{ method_field('DELETE') }}
</form>

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

@section('js')
  <script>
    $(document).ready(function () {
      // Delete book
      $('.btn-danger').on('click', function () {
        $('#delete-form').attr('action', $(this).attr('data-href')).submit()
      })

      // Request book modal
      $('.btn-info').on('click', function () {
        $('.modal-content').load($(this).attr('data-href'), function () {
          $('#myModal').modal({show: true})
        })
      })
    })
  </script>
@endsection
