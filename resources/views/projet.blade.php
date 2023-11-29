@extends('layouts.admin-dash-layout')

@section('content')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script> 
<div class="col d-flex align-items-center justify-content-between justify-content-md-end">
                <div class="actions d-inline-block">
                  <div class="col-auto d-flex align-items-center justify-content-between justify-content-md-end">
                   <a href="#" class="btn btn-sm btn-primary btn-icon rounded-pill" data-toggle="modal" data-target="#add-project"  id="addProjectButton">
                   <span class="btn-inner--icon" >Add A new project <i class="fas fa-plus ml-2"></i></span>
                   </a>
                  </div>
                </div>
               
              </div>
<!-- <div>
        
    <button class="w3-button w3-right"  id="addProjectButton">Add new </button>
  </div> -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">

                <div class="card-header">Projects</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                   
                    <table class="table" id="tableProjet">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Descrption</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projectts as $project)
                                <tr>
                                    <td>{{ $project->name_project }}</td>
                                    <td>{{ $project->Descrption  }}</td>
                                    <td>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this project?')"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                        
                                        <a  class="btn btn-info btn-sm btnupdate" id="btnupdate"  value="{{$project->id}}" style="color: white;"><i class="fas fa-pencil-alt"></i>  Edit</a>
                                        
                                           
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  
<div class="modal" tabindex="-1" role="dialog" id="modalUpdat">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">update project</h5>
          
           
        </div>
        <div class="modal-body">
                          <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name_project" id="name_project" class="form-control" required>
                          </div>
                           <div class="form-group">
                              <label for="Descrption">Descrption</label>
                              <textarea name="Descrption" id="Descrption" class="form-control" required></textarea>
                          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" id="btnUdapteProjet" >Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  

<script>
 var idprojet = 0;
$('#tableProjet tbody').on('click', '#btnupdate', function() {
    idprojet = $(this).attr('value');
   
    $.ajax({
        type: "get",
        url: "{{url('getproject')}}",
        data: {
            idprojet: $(this).attr('value'),
            
        },
        
        
        dataType: "json",
        success: function(response) {
            if (response.statut == 200 ) {
           
               console.log(response.data[0].name_project);
                $('#name_project').val(response.data[0].name_project);
                 $('#Descrption').val(response.data[0].Descrption); 
                 $('#modalUpdat').modal('show');
            }
        }
        
    });

});

$('#btnUdapteProjet').on('click', function() { 
    $.ajax({
        type: "get",
        url: "{{url('UpdateProjet')}}",
        data: {
          name_project: $('#name_project').val(),
            desc: $('#Descrption').val(), 
            id: idprojet,
        },
        dataType: "json",
        success: function(response) {
            if (response.statut == 200) {
                location.reload();
            }
        }
    });
});

  
    const addProjectButton = document.getElementById('addProjectButton');
const tableBody = document.querySelector('tbody');

addProjectButton.addEventListener('click', function() {
  const newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td><input type="text" name="name_project"></td>
    <td><input type="text" name="Descrption"></td>
    <td>
      <button class="saveButton">save</button>
    </td>
  `;
  tableBody.appendChild(newRow);

  const saveButton = newRow.querySelector('.saveButton');
  saveButton.addEventListener('click', function() {
    const name_project = newRow.querySelector('[name=name_project]').value;
    const Descrption = newRow.querySelector('[name=Descrption]').value;

    $.ajax({
      url: "{{url('store')}}",
      type: "POST",
      data: {
        "_token": "{{ csrf_token() }}",
        "name_project": name_project,
        "Descrption": Descrption
      },
      success: function(response) {
        // Display success message
        if (response.statut == 400) {

          alert('Something went wrong...');
        } else {
           
          location.reload();
        }
      },
      error: function(xhr, status, error) {
        // Display error message
        console.error(xhr.responseText);
        alert('An error occurred while processing the request.');
      }
    });
  });
});


    

</script>
@endsection
