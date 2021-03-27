@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
   <div class="row">
      <div class="col-md-12 mt-3">
         <div class="pull-left"><h3>States</h3></div>
         <div class="pull-right">
              <a class="btn btn-primary" href="{{ route('sm.state.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> New State</a>
         </div>
         <div class="clearfix"></div>

      </div>
   	  <div class="col-md-12 mt-3">
   	  	<table id="stateTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Country</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($states as $state)
                <tr>
                    <td>{{ $state->name }}</td>
                    <td>{{ $state->country_id->name }}</td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="{{ route('sm.state.edit', Crypt::encrypt($state->id)) }}">Update</a>
                      <button class="btn btn-sm btn-danger" id="deleteState" data-id="{{  $state->id }}">Delete</button>
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
           $('#stateTable').DataTable();

           $('#stateTable').delegate('#deleteState', 'click', function(){
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
                            url: "{{ config('app.url') }}/sm/state/delete/"+id,
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
