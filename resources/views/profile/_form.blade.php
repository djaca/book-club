<form method="POST" action="{{ route('profile.update', $user) }}">
  @csrf
  {{ method_field('PATCH') }}

  <table class="table table-sm table-borderless">
    <tbody>
    <tr>
      <td class="font-weight-bold">Name</td>
      <td>
        <input
          type="text"
          class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
          name="name"
          value="{{ old('name', $user->name) }}"
          required
        >
      </td>
    </tr>

    <tr>
      <td class="font-weight-bold">Email</td>
      <td>
        <input
          type="text"
          class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
          name="email"
          value="{{ old('email', $user->email) }}"
          required
        >
      </td>
    </tr>

    <tr>
      <td class="font-weight-bold">City</td>
      <td>
        <input
          type="text"
          class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
          name="city"
          value="{{ old('city', $user->city) }}"
          required
        >
      </td>
    </tr>

    <tr>
      <td class="font-weight-bold">State</td>
      <td>
        <input
          type="text"
          class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}"
          name="state"
          value="{{ old('state', $user->state) }}"
          required
        >
      </td>
    </tr>

    <tr>
      <td></td>
      <td>
        <button type="submit" class="btn btn-primary">
          Save changes
        </button>
      </td>
    </tr>
    </tbody>
  </table>
</form>
