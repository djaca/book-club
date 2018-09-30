<div class="mb-5 card">
  <h5 class="card-header">Add Book</h5>
  <div class="card-body">
    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="form-group row">
        <label for="title" class="col-form-label ml-3">Title</label>

        <div class="col-md-6">
          <input
            name="title"
            id="title"
            type="text"
            class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
            value="{{ old('title') }}"
            required>

          @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
          </span>
          @endif
        </div>

        <div>
          <button type="submit" class="btn btn-light">Add book</button>
        </div>
      </div>
      <input type="file" name="img" accept="image/*">

    </form>
  </div>
</div>
