@extends('layouts.app')

@section('content')


  <div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="images/icon/logo.png" alt="CoolAdmin">
                        </a>
                    </div>
         <form method="POST" class="signin-form" action="{{ route('login') }}">
         @csrf
                    <div class="login-form">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Email Address</label>
<input  id="email"class="au-input au-input--full" type="email" name="email" placeholder="Email" name="email" value="{{ old('email') }}"   required autocomplete="email" autofocus>
@error('email')  
<span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
       </span>
@enderror
</div>
                            <div class="form-group">
                                <label>Password</label>
                                  <input id="password" type="password" class="au-input au-input--full @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                 @error('password')
                                   <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                            </div>
                            <div class="login-checkbox">
                                <label>
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember')}}>Remember Me
                
                                </label>
                                {{-- <label>
                                    <a href="#">Forgotten Password?</a>
                                </label> --}}
         
                            </div>
                      @if (Route::has('password.request'))
                         <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                         </a>
                        @endif
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                           
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js">
</script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="js/main.js"></script>

@endsection
