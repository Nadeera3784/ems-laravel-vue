@extends('layouts.app')

@section('content')
   <div class="row">
      <div class="col-md-12 mt-3">
         <div class="pull-left"><a class="btn btn-primary" href="{{ route('sm.country') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>
         <div class="pull-right">
             <h3>Country</h3>
         </div>
         <div class="clearfix"></div>

      </div>
   	  <div class="col-md-12 mt-3">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{ route('sm.country.store') }}">
                @csrf
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                      @error('name')
                          <div class="alert alert-danger" role="alert">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="country_code">Country Code:</label>
                    <input type="text" class="form-control" id="country_code" name="country_code">
                      @error('country_code')
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

