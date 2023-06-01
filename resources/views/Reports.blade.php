@extends('layouts.admin-dash-layout')

@section('content')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script> 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">

                <div class="card-header">Report</div>

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
                                    <td>{{ $report->deadline }}</td>
                                    <td>{{ $report->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection
  
