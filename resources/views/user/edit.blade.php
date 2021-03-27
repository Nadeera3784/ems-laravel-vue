@extends('layouts.app')

@section('content')
   <div class="row">
      <div class="col-md-12 mt-3">
         <div class="pull-left"><a class="btn btn-primary" href="{{ route('um.user') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>
         <div class="pull-right">
             <h3>Users</h3>
         </div>
         <div class="clearfix"></div>

      </div>
   	  <div class="col-md-12 mt-3">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{ route('um.user.update', Crypt::encrypt($user->id)) }}">
                @csrf
                  <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                      @error('username')
                          <div class="alert alert-danger" role="alert">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                      @error('first_name')
                          <div class="alert alert-danger" role="alert">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                      @error('last_name')
                          <div class="alert alert-danger" role="alert">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                      @error('email')
                          <div class="alert alert-danger" role="alert">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="role">Role:</label>
                      <select id="role" name="role" class="form-control" required>
                              <option value="">-- Select Role --</option>
                          @foreach ($roles as $role)
                              <option value="{{ $role->id }}" @if ($user->role == $role->id) {{ 'selected=selected' }}  @endif>{{ $role->name }}</option>
                          @endforeach
                      </select>
                      @error('role')
                          <div class="alert alert-danger" role="alert">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small id="password" class="form-text text-muted">Password: (if changing password)</small>
                      @error('password')
                          <div class="alert alert-danger" role="alert">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>


                  <button type="submit" class="btn btn-primary">Create</button>
              </form>
            </div>
          </div>
   	  </div>
   <div>
@endsection