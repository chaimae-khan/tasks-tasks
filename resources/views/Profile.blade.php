@extends('layouts.admin-dash-layout')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                  src="{{Auth::user()->picture}}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

              <p class="text-muted text-center">{{Auth::user()->status}}</p>
<!-- About Me Box -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">About Me</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <strong><i class="fas fa-book mr-1"></i> Education</strong>

    <p class="text-muted">
      B.S. in Computer Science from the University of Tennessee at Knoxville
    </p>

    <hr>

    <strong><i class="fas fa-map-marker-alt mr-1"></i> Phone number</strong>

    <p class="text-muted">{{Auth::user()->phone_number}}</p>

    <hr>

    <strong><i class="fas fa-pencil-alt mr-1"></i>skills</strong>

    <p class="text-muted">
      <span class="tag tag-danger">{{Auth::user()->skills}}</span>
    
    </p>

    <hr>

    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
  </div>
              
            
            </div>
            <!-- /.card-body -->
          </div>
          


@endsection