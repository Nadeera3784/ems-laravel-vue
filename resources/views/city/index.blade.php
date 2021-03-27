@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
   <div class="row">
      <div class="col-md-12 mt-3">
         <div class="pull-left"><h3>Cities</h3></div>
         <div class="pull-right">
              <a class="btn btn-primary" href="{{ route('sm.city.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> New City</a>
         </div>
         <div class="clearfix"></div>

      </div>
   	  <div class="col-md-12 mt-3">
   	  	<table id="cityTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>State</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)
                <tr>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->state_id->name }}</td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="{{ route('sm.city.edit', Crypt::encrypt($city->id)) }}">Update</a>
                      <button class="btn btn-sm btn-danger" id="deleteCity" data-id="{{  $city->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
       </table>
   	  </div>
   <div>
@endsection

@section('js')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function(){
           $('#cityTable').DataTable();

           $('#cityTable').delegate('#deleteCity', 'click', function(){
              var id = $(this).attr('data-id');  
                swal({
                  title: "Are you sure?",
                  text: "Are you sure you want to delete this?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                    if(willDelete) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: "{{ config('app.url') }}/sm/city/delete/"+id,
                            dataType  : 'json',
                            success: function(response){
                                if(response.type == "success"){
                                   location.reload();
                                }else{
                                  swal("Error", "Something went wrog, please try again later!", "warning", {button: false});
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                swal("Error", "Something went wrog, please try again later!", "warning", {button: false});
                            }
                        });  
                    }
                });
           });
        });
    </script> 
@endsection
