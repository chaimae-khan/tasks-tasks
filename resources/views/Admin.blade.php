@extends('layouts.admin-dash-layout')

@section('content')
    
<style>

.low-priority {
  background-color: #CFE2F3;
}

.not-critical-priority {
  background-color: #a5d2a5;
}

.normal-priority {
  background-color: orange;
}

.urgent-priority {
  background-color: 
#e57f7f
;
}

</style>

    
    
        {{-- <div class="w3-bar w3-black"> --}}
          
   
            
           
          {{-- <button class="w3-button w3-right"   id="addTaskButton">Add new </button>
        </div> --}}
        
       
     
        <div class="card">
          <div class="card-header actions-toolbar">
            <div class="actions-search" id="actions-search">
              <div class="input-group input-group-merge input-group-flush">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control form-control-flush" placeholder="Type and hit enter ...">
                <div class="input-group-append">
                  <a href="#" class="input-group-text bg-transparent" data-action="search-close" data-target="#actions-search"><i class="fas fa-times"></i></a>
                </div>
              </div>
            </div>
            <div class="row justify-content-between align-items-center">
              <div class="col-lg col-md col-12">
                <h6 class="text-uppercase d-inline-block mb-0">All Tasks</h6>
              </div>
              <div class="col d-flex align-items-center justify-content-between justify-content-md-end">
                <div class="actions d-inline-block">
                  <div class="col-auto d-flex align-items-center justify-content-between justify-content-md-end">
                   <a href="#" class="btn btn-sm btn-primary btn-icon rounded-pill" data-toggle="modal" data-target="#add-project"  id="addTaskButton">
                   <span class="btn-inner--icon" >Add A new Task <i class="fas fa-plus ml-2"></i></span>
                   </a>
                  </div>
                </div>
               
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive list-content">
            <table class="table table-striped projects" id="tableTasks">
                <thead>
                  <tr>
                    <th scope="col">Priority</th>
                    <th scope="col">Project</th>
                    <th scope="col">name</th>
                    <th scope="col">To-Do</th>      
                    {{-- <th scope="col">Employee</th> --}}
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Assigned Date</th>
                    {{-- <th scope="col">Assigned Date</th> --}}
                    <th scope="col">Action</th>
                    {{-- <th scope="col"></th> --}}
                  </tr>
                </thead>
        <tbody>
            @foreach ($tasks as $task)
                
                    <tr>
                        {{-- <td>{{$task->id}}</td> --}}
                      
                        <td class="
                        @if ($task->priority === 'low')
                            low-priority
                        @elseif ($task->priority === 'not critical')
                            not-critical-priority
                        @elseif ($task->priority === 'normal')
                            normal-priority
                        @elseif ($task->priority === 'uregent')
                            urgent-priority
                        @endif">{{ $task->priority }}</td>
                       
                        <th>{{ $task->name_project }}</th>
                        <th>{{ $task->name}}</th>
                        <td>{{ $task->todo }}</td>

                        {{-- <td>{{ $task->name }}</td> --}}
                        <td>{{ $task->type }}</td>
                        <td>{{$task->status}}</td>
                        {{-- <td>{{ $task->status }}</td> --}}
                        <td>{{ $task->deadline }}</td>
                        {{-- <td>{{ $task->assigned_date }}</td> --}}
                        <td>{{ $task->assignedDate }}</td>
                        <td class="project-actions">
                          <div>
                            <i class="fa fa-cog" onclick="toggleButtons({{ $task->id }})"></i>
                            <div id="buttonsContainer{{ $task->id }}" style="display: none;">
                              <a class="btn btn-primary btn-sm iconDispalyhistory" value="{{$task->id}}" id="" style="background-color: #006600; color: white;"><i class="fa fa-eye"></i> View</a>
                              <a class="btn btn-info btn-sm btnupdate" value="{{$task->id}}" style="color: white;"><i class="fas fa-pencil-alt"></i> Edit</a>
                              <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline" onclick="return confirm('Are you sure you want to delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                              </form>
                            </div>
                          </div>
                          
                          
                          
                        
                      </td>
                  </tr>
              @endforeach
  
        
        </tbody>
    </table>

    <div class="modal" tabindex="-1" role="dialog" id="modalhistory">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">History</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover" id="tablehistory">
                    <thead>
                  <tbody id="tablehistory">   
                     </thead>
                 </table>
            </div>
          
          </div>
        </div>
      </div>



      <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalUpdate">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <div>
                <h5 class="modal-title" id="exampleModalLabel">Update task</h5>
                <p class="text-muted mb-0" style="max-width: 466px;">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.rro cupiditate tempora saepe. Quam, pariatur.
                </p>
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="row">
                  <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="settings-left-img mt-5">
                      <div class="account-img-upload">
                        <div class="img-upload">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                     @if(Auth::user()->is_admin == 1)
                    <div class="form-group">
                      <label class="form-control-label">To-Do</label>
                      <input class="form-control" type="text" placeholder="Enter your Client Name "id="Todo">
                    </div>
                    <div class="form-row mb-3">
                      <div class="col-lg col-md col-sm-12 col-12">
                        <label class="form-control-label">Priority </label>
                         <select name="priority" id="priority" class="form-control" data-toggle="select" >
                           @foreach($PriorityTask as $item)
                            <option value="{{$item}}">{{$item}}</option>
                           @endforeach
                          </select>
                        </select>
                      </div>
                      <div class="col-lg col-md col-sm-12 col-12">
                        <label class="form-control-label">status </label>
                         <select name="Statuts" id="Statuts" class="form-control" data-toggle="select" >
                        @foreach($statutTask as $item)
                          <option value="{{$item}}">{{$item}}</option>
                        @endforeach
                      </select>
                      </div>
                    </div>
                    <div class="form-row mb-3">
                      <div class="col-lg col-md col-sm-12 col-12">
                        <label class="form-control-label">Employee </label>
                        <select name="Employe" id="Employe" class="form-control" data-toggle="select">
                        @foreach($user as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                        
                      </div>
                      <div class="col-lg col-md col-sm-12 col-12">
                        <label class="form-control-label">Type</label>
                        <input type="text" class="form-control" placeholder="Nationality"id="Type">
                      </div>
                    </div>
                    <div class="form-row mb-3">
                      <div class="col-lg col-md col-sm-12 col-12-7">
                        <label class="form-control-label">Deadline Date</label>
                        <input type="date" class="form-control" placeholder="Address " id="Deadline">
                      </div>
                      <div class="col-lg col-md col-sm-12 col-12-7">
                        <label class="form-control-label">Assigned Date</label>
                        <input type="date" class="form-control" placeholder="Nationality"  id="ADate">
                      </div>
                    </div>
            @else
              <div class="form-group">
                      <label class="form-control-label">To-Do</label>
                      <input class="form-control" type="text" placeholder="Enter your Client Name "id="Todo" disabled>
                    </div>
                    <div class="form-row mb-3">
                      <div class="col-lg col-md col-sm-12 col-12">
                        <label class="form-control-label">Priority </label>
                       <select name="priority" id="priority" class="form-control" data-toggle="select" disabled >
                           @foreach($PriorityTask as $item)
                            <option value="{{$item}}">{{$item}}</option>
                           @endforeach
                          </select>
                        </select>
                      </div>
                      <div class="col-lg col-md col-sm-12 col-12">
                        <label class="form-control-label">status </label>
                         <select name="Statuts" id="Statuts" class="form-control" data-toggle="select" >
                        @foreach($statutTask as $item)
                          <option value="{{$item}}">{{$item}}</option>
                        @endforeach
                      </select>
                      </div>
                    </div>
                    <div class="form-row mb-3">
                      <div class="col-lg col-md col-sm-12 col-12">
                        <label class="form-control-label">Employee </label>
                        <select name="" id="Employe" class="form-control" data-toggle="select" disabled>
                        @foreach($emp as $item)
                          <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                        
                      </div>
                      <div class="col-lg col-md col-sm-12 col-12">
                        <label class="form-control-label">Type</label>
                        <input type="text" class="form-control" placeholder="Nationality"id="Type" disabled>
                      </div>
                    </div>
                    <div class="form-row mb-3">
                      <div class="col-lg col-md col-sm-12 col-12-7">
                        <label class="form-control-label">Deadline Date</label>
                        <input type="date" class="form-control" placeholder="Address " id="Deadline"disabled>
                      </div>
                      <div class="col-lg col-md col-sm-12 col-12-7">
                        <label class="form-control-label">Assigned Date</label>
                        <input type="date" class="form-control" placeholder="Nationality"  id="ADate" disabled>
                      </div>
                     @endif
                    </div>
               
                   
                      
                    
                
              </form>
              
                     
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="btnUpdateTask">Update</button>
            </div>
          </div>
        </div>
      </div>
    </div>

            </div>
      <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> 
     

      
<script>
  var idtaskUpdate = 0;
  $('#tableTasks tbody').on('click','.btnupdate',function(){
    idtaskUpdate =  $(this).attr('value');
      $.ajax({
        type: "get",
        url: "{{url('getTask')}}",
        data: {
          idtask : $(this).attr('value'),
        },
        dataType: "json",
        success: function (response) {
            if(response.statut == 200)
              {
                
              // console.log(response.data[0].assigned_date);
              
              $('#priority').val(response.data[0].priority);
              $('#Employe').val(response.data[0].user_id);
              $('#Statuts').val(response.data[0].status);
              $('#ADate').val(response.data[0].assignedDate);
              $('#Todo').val(response.data[0].todo);
              $('#Type').val(response.data[0].type);
              $('#Deadline').val(response.data[0].deadline);
              $('#modalUpdate').modal('show');
            }
        }
      });
      
  });

  $('#btnUpdateTask').on('click',function(){
   
    $.ajax({
      type: "get",
      url: "{{url('updateTask')}}",
      data: 
      {
        priority      : $('#priority').val(),
        Employe   :$('#Employe').val(),
        Statuts   :$('#Statuts').val(),
        ADate   :$('#ADate').val(),
        Todo   :$('#Todo').val(),
        Type   :  $('#Type').val(),
        Deadline   :   $('#Deadline').val(),
        id        : idtaskUpdate,

      },
      dataType: "json",
      success: function (response) {
          if(response.statut == 200)
          {
            location.reload();
          }
      }
    });
  });

  $('.iconDispalyhistory').on('click', function() {
    const check = <?php echo $is_admin ?>;
      if(check == 0)
      {
       
        alert("THIS ACTION IS UNAUTHORIZED.");
        return 0;
      }
    
    var idtask = $(this).attr('value');
    $('#modalhistory').show();
    $.ajax({
      type: 'get',
      url: '{{url("getHistory")}}',
      data: {
        id: idtask
      },
      dataType: 'json',
      success: function(response) {
        if (response.statut == 200) {
  $('#tablehistory').find('tbody').html('');
  $.each(response.Datahistory, function(index, value) {
    $('#tablehistory').find('tbody').append('<tr><td value="' + response.id + '">' + value + '</td></tr>');
  });
}
      },
      error: function() {
        alert('Error occurred while fetching data!');
      }
    });
  });
  
  $('#modalhistory .close').on('click', function() {
    $('#modalhistory').hide();
  });
  


   
    const addTaskButton = document.getElementById('addTaskButton');
    const tableBody = document.querySelector('tbody');

    addTaskButton.addEventListener('click', function() {
      
      const check = <?php echo $is_admin ?>;
      if(check == 0)
      {
         alert("THIS ACTION IS UNAUTHORIZED.");
        return 0;
      }
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
           
            <td><select class="browser-default custom-select" name="priority" id="priority">
                @foreach ($PriorityTask as $item)
                    <option value="{{ $item }}">{{ $item }}</option> 
                 @endforeach
                  
             </select></td>
            <td><select class="browser-default custom-select" name="project_name" id="project_name">
                @foreach ( $project as $p)
                    <option value="{{ $p->id }}">{{ $p->name_project }}</option>
                 @endforeach
                  
             </select></td>
            </select></td>
            <td><select class="browser-default custom-select" name="user_name" id="user_name">
                @foreach ( $user as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                 @endforeach
                  
             </select></td>

        </select>
            <td><input type="text" name="todo"></td>  
            <td><input type="text" name="type"></td>

            <td><select class="browser-default custom-select" name="status" id="status">
                @foreach ($statutTask as $item)
                    <option value="{{ $item }}">{{ $item }}</option> 
                 @endforeach
                  
             </select></td>


            <td><input type="date" name="deadline"></td>
            <td><input type="date" name="assignedDate"></td>
            <td>
                <button class="saveButton">save</button>
            </td>
        `;
        tableBody.appendChild(newRow);

        const saveButton = newRow.querySelector('.saveButton');
        saveButton.addEventListener('click', function() {
            const priority = newRow.querySelector('[name=priority]').value;
            const todo = newRow.querySelector('[name=todo]').value;
            // const employee = newRow.querySelector('[name=employee]').value;
            const type = newRow.querySelector('[name=type]').value;
            const status = newRow.querySelector('[name=status]').value;
            const deadline = newRow.querySelector('[name=deadline]').value;
            const project_name = newRow.querySelector('[name=project_name]').value;
            const user_name = newRow.querySelector('[name=user_name]').value;
            console.log(user_name);
            const assignedDate = newRow.querySelector('[name=assignedDate]').value;

            $.ajax({
                url: "{{ route('tasks.store') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "priority": priority,
                    "todo": todo,
                    // "employee": employee,
                    "projct_id" :project_name,
                    "user_id":user_name,
                    "type": type,
                    "status": status,
                    "deadline": deadline,
                    "assignedDate": assignedDate
                },
                success: function(response) {
                
                  if(response.statut == 400)
                    {
                      alert('samething ... ');
                    }
                    else{
                      location.reload();
                    }
                   
                },
               /*  error: function(xhr) {
                    // Display error message
                    
                    alertify.error('403 Unauthorized action');
                    console.log(xhr.responseText);
                } */
            });
        });
    });
</script>

<!-- [END] Omnisearch -->
<!-- Core JS - includes jquery, bootstrap, popper, in-view, and sticky-kit -->
<script src="assets/js/novato.core.js"></script>
<!-- Page JS -->
<script src="assets/libs/progressbar.js/dist/progressbar.min.js"></script>
<script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="assets/libs/moment/min/moment.min.js"></script>
<script src="assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.min.js"></script>
<script src="assets/libs/jquery-webui-popover/jquery.webui-popover.min.js"></script>
<!-- Novato JS -->
<script src="assets/js/novato.js"></script>
<script src="assets/js/main.js"></script>
<script>
                            function toggleButtons(taskId) {
                              var buttonsContainer = document.getElementById("buttonsContainer" + taskId);
                              if (buttonsContainer.style.display === "none") {
                                buttonsContainer.style.display = "block";
                              } else {
                                buttonsContainer.style.display = "none";
                              }
                            }
  </script>
@endsection