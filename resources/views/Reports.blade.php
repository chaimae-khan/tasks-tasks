@extends('layouts.admin-dash-layout')

@section('content')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script> 
    <div class="card-body p-0">
        <div class="row justify-content-center">
            <div class="col-md-8">   
                <div class="card">
                    <div class="card-header">Rapport</div>
                    @if (Auth::user()->is_admin !==1)
                      <div class="card-body">
                              <p>You are not authorized to access this page.</p>
                            </div> 
                        </div>   
                   </div> 
               </div> 
                @else
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                   
                    <table class="table" id="tableProjet">
                        <thead>
                            <tr>
                                <th>Priority</th>
                                <th>todo</th>
                                <th>type</th>
                                <th>deadline</th>
                                <th>status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Reports as $report)
                           
                                <tr>
                                    <td>{{ $report->projectname }}</td>
                                    <td>{{ $report->todo }}</td>
                                    <td>{{ $report->type }}</td>
                                    <td>{{ $report->dateDeadline }}</td>
                                    <td>{{ $report->status }}</td>
                                </tr>
                            @endforeach
                            @endif
 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @endsection
  
