<!DOCTYPE html>
<html lang="en">

<head>
    <title>SYSMAX - Login</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="CodedThemes" />

    <!-- Favicon icon -->
    <link rel="icon" href="http://html.codedthemes.com/datta-able/bootstrap/assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{url('dattaable/assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{url('dattaable/assets/plugins/animation/css/animate.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{url('dattaable/assets/css/style3.css')}}">

</head>

<body>
<div class="auth-wrapper">

    <form method="POST" action="{{ route('login') }}">
        @csrf

    <div class="auth-content subscribe">
        <div class="card">
            <div class="row no-gutters">
                <div class="col-md-4 col-lg-6 d-none d-md-flex d-lg-flex theme-bg align-items-center justify-content-center">
                    <img src="{{url('dattaable/assets/images/user/lock.png')}}" alt="lock images" class="img-fluid">
                </div>
                <div class="col-md-8 col-lg-6">
                    <div class="card-body text-center">
                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <h3 class="mb-4">Login</h3>
                                <div class="input-group mb-3">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span>
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control" placeholder="password" name="password" required>

                                    @if ($errors->has('password'))
                                        <span>
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif


                                </div>
                                <div class="form-group text-left">
                                    <div class="checkbox checkbox-fill d-inline">
                                        <input type="checkbox" name="remember" id="remember">
                                        <label for="remember" class="cr"> Lembrar?</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary shadow-2 mb-4">Login</button>
                                <p class="mb-2 text-muted">Esqueceu a senha? <a href="{{ route('password.request') }}">Resetar</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <ul class="nav nav-pills nav-fill mb-0 border-bottom" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="feather icon-unlock py-2"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="feather icon-user-plus py-2"></i></a>
        </li>
    </ul>
    <div class="tab-content text-center" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="mb-4">
                <i class="feather icon-unlock auth-icon"></i>
            </div>
            <h3 class="mb-4">Login</h3>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email">
            </div>
            <div class="input-group mb-4">
                <input type="password" class="form-control" placeholder="password">
            </div>
            <div class="form-group text-left">
                <div class="checkbox checkbox-fill d-inline">
                    <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
                    <label for="checkbox-fill-a1" class="cr"> Save Details</label>
                </div>
            </div>
            <button class="btn btn-primary shadow-2 mb-4">Login</button>
            <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html">Reset</a></p>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="mb-4">
                <i class="feather icon-user-plus auth-icon"></i>
            </div>
            <h3 class="mb-4">Sign up</h3>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username">
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email">
            </div>
            <div class="input-group mb-4">
                <input type="password" class="form-control" placeholder="password">
            </div>
            <div class="form-group text-left">
                <div class="checkbox checkbox-fill d-inline">
                    <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-1" checked="">
                    <label for="checkbox-fill-1" class="cr"> Save Details</label>
                </div>
            </div>
            <div class="form-group text-left">
                <div class="checkbox checkbox-fill d-inline">
                    <input type="checkbox" name="checkbox-fill-2" id="checkbox-fill-2">
                    <label for="checkbox-fill-2" class="cr">Send me the <a href="#!"> Newsletter</a> weekly.</label>
                </div>
            </div>
            <button class="btn btn-primary shadow-2 mb-4">Sign up</button>
        </div>
    </div> -->


    </form>


</div>
<!-- Required Js -->
<script src="{{url('dattaable/assets/js/vendor-all.min.js')}}"></script>
<script src="{{url('dattaable/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
</body>


<!-- Mirrored from html.codedthemes.com/datta-able/bootstrap/default/auth-signin-v4.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Mar 2019 12:39:32 GMT -->
</html>

