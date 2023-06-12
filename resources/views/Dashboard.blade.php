@extends('layouts.admin-dash-layout')

@section('content')
   
                <div class="">
                   <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">Welcome back
                                <span>{{Auth::user()->name}}</span>
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->

            <!-- STATISTIC-->
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">{{$adminCount}}</h2>
                                <span class="desc">Admins</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">{{$memberCount}}</h2> 
                                <span class="desc">Members</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">{{$report}}</h2>
                                <span class="desc">Completed tasks</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">{{$project}}</h2>
                                <span class="desc">Projects</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                            </div>
                           
                           
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
            <section class="statistic statistic2">
                <div class="container">
                   <div class="row">
                       <div class="col-md-6 col-lg-3">
                           <div class="statistic__item statistic__item--red">
                               <h2 class="number">{{$tasks}}</h2>
                               <span class="desc">Pending Tasks</span>
                               <div class="icon">
                                   <i class="zmdi "></i>
                               </div>
                           </div>
                       </div>
                       {{-- <div class="col-md-6 col-lg-3">
                        <div class="statistic__item statistic__item--blue">
                            <h2 class="number">{{$report}}</h2>
                            <span class="desc">Completed tasks</span>
                            <div class="icon">
                                <i class="zmdi zmdi-calendar-note"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item statistic__item--blue">
                            <h2 class="number">{{$report}}</h2>
                            <span class="desc">Completed tasks</span>
                            <div class="icon">
                                <i class="zmdi zmdi-calendar-note"></i>
                            </div>
                        </div> --}}
                    </div>
                       </div>
                      
                               
           </section>
                </div>
            
            </div>
       

@endsection
