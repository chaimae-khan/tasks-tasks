@extends('layouts.admin-dash-layout')

@section('content')



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
          <h6 class="text-uppercase d-inline-block mb-0">Historical</h6>
        </div>
       
        <div class="col d-flex align-items-center justify-content-between justify-content-md-end">
          <div class="actions d-inline-block">
            <a href="#" class="action-item mr-3" data-action="search-open" data-target="#actions-search"><i class="fas fa-search"></i></a>
            <a href="javascript:;" id="grid-view" class="action-item mr-3"><i class="fas fa-th-large"></i></a>
          </div>
         
        </div>
        
      </div>
    </div>
    <div class="card-body">
    @if (Auth::user()->is_admin !==1)
       <div class="card-body">
         <p>You are not authorized to access this page.</p>
        </div>
    @else    
<div class="table-responsive list-content">
        <table class="table table-striped projects"> 
             
            
          <thead>
            <tr>
              <th scope="col">Description</th>
              <th scope="col" class="sort">Event</th>
              <th scope="col" class="sort">User</th>
              <th scope="col" class="sort">Created_at</th>
              <th scope="col">Properties</th>
              
            </tr>
          </thead>
        <tbody>
            @foreach ($logs as $log)
                    <tr>
                        <th>{{ $log->description  }}</th>
                        <td>{{ $log->event  }}</td>
                    @foreach ($users as $user)
                     @if($log->causer_id === $user->id)
                        <td value="{{ $user->id }}" >{{ $user->name }}</td>
                     @endif
                    @endforeach
                       <td>{{$log->created_at}}</td>
                        
                       
                       <td><div>
                        <i class="fa fa-ellipsis-h" onclick="toggleButtons({{ $log->id }})"></i>
                        <div id="buttonsContainer{{ $log->id}}" style="display: none;">{{$log->properties}}</div></td>
            @endforeach
        </tbody>
    </table>

   @endif 
</div>
<script>
    function toggleButtons(logId) {
      var buttonsContainer = document.getElementById("buttonsContainer" + logId);
      if (buttonsContainer.style.display === "none") {
        buttonsContainer.style.display = "block";
      } else {
        buttonsContainer.style.display = "none";
      }
    }
</script>
@endsection