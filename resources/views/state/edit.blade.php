@extends('layouts.app')

@section('content')
   <div class="row">
      <div class="col-md-12 mt-3">
         <div class="pull-left"><a class="btn btn-primary" href="{{ route('sm.state') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>
         <div class="pull-right">
             <h3>States</h3>
         </div>
         <div class="clearfix"></div>

      </div>
   	  <div class="col-md-12 mt-3">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{ route('sm.state.update', Crypt::encrypt($state->id)) }}">
                @csrf

                  <div class="form-group">
                    <label for="country">Country:</label>
                      <select id="country" name="country" class="form-control" required>
                              <option value="">-- Select Country --</option>
                          @foreach ($countries as $country)
                              <option value="{{ $country->id }}" @if ($state->country == $country->id) {{ 'selected=selected' }}  @endif>{{ $country->name }}</option>
                          @endforeach
                      </select>
                      @error('country')
                          <div class="alert alert-danger" role="alert">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $state->name }}">
                      @error('name')
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
