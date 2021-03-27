@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
   <div class="row">
      <div class="col-md-12 mt-3">
         <div class="pull-left"><h3>Users</h3></div>
         <div class="pull-right">
              <a class="btn btn-primary" href="{{ route('um.user.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> New User</a>
         </div>
         <div class="clearfix"></div>

      </div>
   	  <div class="col-md-12 mt-3">
   	  	<table id="userTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                 <th>Role</th>
                <th>Created</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->first_name . " " . $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role_id->name }}</td>
                    <td>{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="{{ route('um.user.edit', Crypt::encrypt($user->id)) }}">Update</a>
                      <button class="btn btn-sm btn-danger" id="deleteUser" data-id="{{  $user->id }}">Delete</button>
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
           $('#userTable').DataTable();

           $('#userTable').delegate('#deleteUser', 'click', function(){
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
                            url: "{{ config('app.url') }}/um/user/delete/"+id,
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
