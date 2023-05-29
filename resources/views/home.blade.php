@extends('layouts.admin-dash-layout')

@section('content')
   
                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                    @endif

                </div>
            <div>
                    <p>welcome </p>
                </div>
            </div>
       

@endsection
