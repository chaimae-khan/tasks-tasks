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
                   <span class="btn-inner--icon" >Add Project <i class="fas fa-plus ml-2"></i></span>
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
                    <th scope="col">To-Do</th>      
                    <th scope="col">Employee</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Assigned Date</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
        <tbody>
            @foreach ($tasks as $task)
                
                    <tr>
                        {{-- <td>{{$task->id}}</td> --}}
                      
                        <td class="
                        @if ($task->projectname === 'low')
                            low-priority
                        @elseif ($task->projectname === 'not critical')
                            not-critical-priority
                        @elseif ($task->projectname === 'normal')
                            normal-priority
                        @elseif ($task->projectname === 'uregent')
                            urgent-priority
                        @endif">{{ $task->projectname }}</td>
                       
                        <th>{{ $task->name_project }}</th>
                        <td>{{ $task->todo }}</td>

                        <td>{{ $task->name }}</td>
                        <td>{{ $task->type }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->deadline }}</td>
                        <td>{{ $task->assigned_date }}</td>
                        <td class="project-actions">
                         
                          <div>
                              <i class="fa fa-cog" data-toggle="collapse" data-target="#buttonsContainer{{ $task->id }}"></i>
                              <div id="buttonsContainer{{ $task->id }}" class="collapse">
                                  <a class="btn btn-primary btn-sm iconDispalyhistory" value="{{$task->id}}" id="" style="background-color: #006600; color: white;"><i class="fa fa-eye"></i> View</a>
                                  <a class="btn btn-info btn-sm btnupdate" value={{$task->id}} style="color: white;"><i class="fas fa-pencil-alt"></i> Edit</a>
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



      <div class="modal" tabindex="-1" role="dialog" id="modalUpdate">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                @if(Auth::user()->is_admin == 1)
                <div class="col-md-6">
                 
                    <label for="">Priority</label>
                    <select name="PName" id="PName" class="form-control" >
                      @foreach($PriorityTask as $item)
                        <option value="{{$item}}">{{$item}}</option>
                      @endforeach
                    </select>
                   
                    <label for="">Employee</label>
                    <select name="" id="Employe" class="form-control" >
                      @foreach($emp as $item)
                        <option value="{{$item->name}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                   
                    <label for="">Status</label>
                    <select name="Statuts" id="Statuts" class="form-control" >
                      @foreach($statutTask as $item)
                        <option value="{{$item}}">{{$item}}</option>
                      @endforeach
                    </select>
                    
                   
                    
                  
                    <label for="">Assigned Date</label>
                    <input type="date" class="form-control" id="ADate">
                </div>
                <div class="col-md-6">
                  <label for="">To-Do</label>
                  <input type="text" class="form-control" id="Todo">
                  <label for="">Type</label>
                  <input type="text" class="form-control" id="Type">
                  <label for="">Deadline</label>
                  <input type="date" class="form-control" id="Deadline">
              </div>
              @else
                <div class="col-md-6">
                  
                  <label for="">Project Name</label>
                  <input type="text" class="form-control" id="PName" disabled>
                  <label for="">Employee</label>
                  <select name="" id="Employe" class="fomr-select" disabled>
                    @foreach($emp as $item)
                      <option value="{{$item->name}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                 
                
                  <label for="">Status</label>
                  <input type="text" class="form-control" id="Statuts" >
                  
                
                  
                
                  <label for="">Assigned Date</label>
                  <input type="date" class="form-control" id="ADate" disabled>
              </div>
              <div class="col-md-6">
                <label for="">To-Do</label>
                <input type="text" class="form-control" id="Todo" disabled>
                <label for="">Type</label>
                <input type="text" class="form-control" id="Type" disabled>
                <label for="">Deadline</label>
                <input type="date" class="form-control" id="Deadline" disabled>
            </div>
              @endif
            </div>
                
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" id="btnUpdateTask">Update</button>
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
              
              $('#PName').val(response.data[0].projectname);
              $('#Employe').val(response.data[0].name);
              $('#Statuts').val(response.data[0].status);
              $('#ADate').val(response.data[0].assigned_date);
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
        PName       : $('#PName').val(),
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
           
            <td><select class="browser-default custom-select" name="projectname" id="projectname">
                @foreach ($PriorityTask as $item)
                    <option value="{{ $item }}">{{ $item }}</option> 
                 @endforeach
                  
             </select></td>
            <td><select class="browser-default custom-select" name="project_name" id="project_name">
                @foreach ( $project as $p)
                    <option value="{{ $p->id }}">{{ $p->name_project }}</option>
                 @endforeach
                  
             </select></td>

        </select>
            <td><input type="text" name="todo"></td>
            <td><select class="browser-default custom-select" name="employee" id="employee">
                @foreach ($emp as $employee)
                    <option value="{{ $employee->name }}">{{ $employee->name }}</option>
                 @endforeach
                  
             </select></td>
            
            <td><input type="text" name="type"></td>

            <td><select class="browser-default custom-select" name="status" id="status">
                @foreach ($statutTask as $item)
                    <option value="{{ $item }}">{{ $item }}</option> 
                 @endforeach
                  
             </select></td>


            <td><input type="date" name="deadline"></td>
            <td><input type="date" name="assigned_date"></td>
            <td>
                <button class="saveButton">save</button>
            </td>
        `;
        tableBody.appendChild(newRow);

        const saveButton = newRow.querySelector('.saveButton');
        saveButton.addEventListener('click', function() {
            const projectname = newRow.querySelector('[name=projectname]').value;
            const todo = newRow.querySelector('[name=todo]').value;
            const employee = newRow.querySelector('[name=employee]').value;
            const type = newRow.querySelector('[name=type]').value;
            const status = newRow.querySelector('[name=status]').value;
            const deadline = newRow.querySelector('[name=deadline]').value;
            const project_name = newRow.querySelector('[name=project_name]').value;
            console.log(project_name);
            const assigned_date = newRow.querySelector('[name=assigned_date]').value;

            $.ajax({
                url: "{{ route('tasks.store') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "projectname": projectname,
                    "todo": todo,
                    "employee": employee,
                    "projct_id" :project_name, 
                    "type": type,
                    "status": status,
                    "deadline": deadline,
                    "assigned_date": assigned_date
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

@endsection