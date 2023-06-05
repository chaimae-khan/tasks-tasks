@extends('layouts.admin-dash-layout')

@section('content')

    

       
     
        <div class="card-body p-0">
        
          <table class="table table-striped projects" id="tableTasks">
        <thead>
            <tr>
                {{-- <th>id</th> --}}
                <th> description  </th>
                <th>event </th>
                {{-- <th>causer_type</th> --}}
                <th>user</th>
                <th></th>
                <th> subject_type  </th>
                <th>Properties</th>
                <th>created_at</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            
                
                    <tr>

                        <th>{{ $log->description  }}</th>
                
                        <td>{{ $log->event  }}</td>
                        {{-- <td>{{ $log->causer_type }}</td> --}}
                        @foreach ($users as $user)
                         @if($log->causer_id === $user->id)
                        <td value="{{ $user->id }}" >{{ $user->name }}</td>
                         @endif
                        @endforeach
                    
                        @php
                        $data = json_decode($log->properties, true);
                        @endphp
                       <td>
                        @if ($log->subject_type === 'App\Models\User')
                        <td>User</td>
                        <td> name  : {{ $data['attributes']['name'] }}<br>
                             email  : {{$data['attributes']['email']}}</td> 
                        @elseif($log->subject_type=== 'App\Models\Projectt')
                        <td>Project</td>
                        <td> Descrption  : {{ $data['attributes']['Descrption'] }}<br>
                             project name : {{$data['attributes']['name_project']}}</td> 
                        @elseif($log->subject_type=== 'App\Models\Task')
                        <td>Task</td>
                        <td> status  : {{ $data['attributes']['status'] }}<br>
                            Priority: {{$data['attributes']['projectname']}}</td> 
                    @endif
                       <td>{{$log->created_at}}</td>
                      
       
        @endforeach
        </tbody>
    </table>

   
      @endsection