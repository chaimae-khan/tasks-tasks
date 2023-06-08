@extends('layouts.admin-dash-layout')

@section('content')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script> 
<div class="card-body p-0">
    <div class="row justify-content-center">
        <div class="col-md-8">   
            <div class="card">
                <div class="card-header">users</div>
                @if (Auth::user()->is_admin !==1)
                  <div class="card-body">
                          <p>You are not authorized to access this page.</p>
                        </div> 
                    </div>   
               </div> 
           </div> 
                       @else
               
        <div class="card-body p-0">
        
            <table class="table table-striped projects" id="tableuser">
            <thead>
              <tr>
                  {{-- <th>id</th> --}}
                  <th> Name</th>
                  <th> email </th>
                  <th>phone_number </th>
                  <th>picture  </th>
                  <th>status</th>
                  <th>Status</th>
                  <th>skills</th>
                  <th>Action</th>
                  
              </tr>
            </thead>
          <tbody>
              @foreach ($users as $user)
                  
                      <tr>
                          
                          <td>{{ $user->name }}</td>
                          <th>{{ $user->email }}</th>
                          <td>{{ $user->phone_number}}</td>
  
                          <td>{{ $user->picture  }}</td>
                          <td>{{ $user->status }}</td>
                          <td>{{ $user->status }}</td>
                          <td>{{ $user->skills }}</td>
                        <td class="project-actions ">
                            {{-- <a class="btn  btn-primary  btn-sm iconDispalyhistory "   value="{{$user->id}}" id='' > <i class="fa fa-eye">  </i> View</a> --}}
                            
                            <a class="btn btn-info btn-sm btnupdate" id="btnupdate" value={{$user->id}}>  <i class="fas fa-pencil-alt">  </i> Edit </a>
                            <form action="{{ route('register.destroy', $user->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this user?')" >Delete</button>
                            </form>
                         
                   </td> 
                   </tr>
                  
              @endforeach
          
          </tbody>
      </table>
  
      
  
        @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalUpdat">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
             
                              <div class="col-md-6">          
                                   <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email">
                                    <label for="phone_number">phone_number</label>
                                    <input type="text" class="form-control" id="phone_number">
                                </div>
                               
                                    <div class="col-md-6">
                                       <label for="picture">Picture</label>
                                        <input type="text" class="form-control" id="picture">
                                        <label for="status">status</label>
                                        <input type="text" class="form-control" id="status">
                                        <label for="skills">skills</label>
                                        <input type="text" class="form-control" id="skills">
                                    </div>
                                  </div>
                                </div>
                                
        <div class="modal-footer">
            <button class="btn btn-primary btnUdapteUser"id="btnUpdateUser"   >Update</button>
        </div>
      </div>
    </div>
 
<script>
               var iduser = 0;
               $('#tableuser tbody').on('click', '#btnupdate', function() {
               iduser = $(this).attr('value');
                                   $.ajax({
                                       type: "get",
                                       url: "{{url('getuser')}}",
                                       data: {
                                      iduser: $(this).attr('value'),
                                           
                                       },
                                       dataType: "json",
                                       success: function(response) {
                                           if (response.statut == 200 ) {
                                          
                                               console.log(response.data[0].name);
                                               $('#name').val(response.data[0].name);
                                                $('#email').val(response.data[0].email);
                                                $('#phone_number').val(response.data[0].phone_number); 
                                                $('#picture').val(response.data[0].picture); 
                                                $('#status').val(response.data[0].status); 
                                                $('#skills').val(response.data[0].skills);  
                                                $('#modalUpdat').modal('show');
                                           }
                                       }
                                       
                                   });
                               
                               });
  $('#btnUpdateUser').on('click', function() { 
   
    $.ajax({
        type: "get",
        url: "{{ url('updateUser') }}",
        data: {
            name: $('#name').val(),
            email: $('#email').val(),
            phone_number: $('#phone_number').val(),
            picture: $('#picture').val(),
            status: $('#status').val(),
            skills: $('#skills').val(),
            id: iduser,
        },
        dataType: "json",
        success: function(response) {
            if (response.status == 200) {
                location.reload();
            }
        }
    });
});

               
                               </script>                      
  
@endsection
