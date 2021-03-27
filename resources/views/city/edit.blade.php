@extends('layouts.app')

@section('content')
   <div class="row">
      <div class="col-md-12 mt-3">
         <div class="pull-left"><a class="btn btn-primary" href="{{ route('sm.city') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>
         <div class="pull-right">
             <h3>Cities</h3>
         </div>
         <div class="clearfix"></div>

      </div>
   	  <div class="col-md-12 mt-3">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{ route('sm.city.update', Crypt::encrypt($city->id)) }}">
                @csrf

                  <div class="form-group">
                    <label for="state">State:</label>
                      <select id="statestate" name="state" class="form-control" required>
                              <option value="">-- Select State --</option>
                          @foreach ($states as $state)
                              <option value="{{ $state->id }}" @if ($city->state == $state->id) {{ 'selected=selected' }}  @endif>{{ $state->name }}</option>
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
                    <input type="text" class="form-control" id="name" name="name" value="{{ $city->name }}">
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