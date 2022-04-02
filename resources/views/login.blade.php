<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Ilyas Property">
    <meta name="keywords" content="Ilyas Property">
    <meta name="author" content="Ilyas Property">
    <title>Ilyas Properties</title>
    <link rel="apple-touch-icon" href="{{asset('assets/nav-icon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/nav-icon.png')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/dashboard/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/components.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/dashboard/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/pages/login-register.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    <style>
        .input-style {
            padding-left: 15px !important;
        }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image blank-page blank-page"
      data-open="click" data-menu="vertical-menu-modern" data-color="bg-gradient-x-purple-red" data-col="1-column">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success mb-2" style="width: 500px;position: absolute;right: 0;top: 50px;"
                 id="alert-success-message" role="alert">
                <strong>Success! </strong> {{$message}}
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger mb-2" id="alert-error-message"
                 style="width: 500px;position: absolute;right: 0;top: 50px;" role="alert">
                <strong>Error! </strong> {{$message}}
            </div>
        @endif
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0" style="opacity:0.9">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                {{--                                <div class="text-center mb-1">--}}
                                {{--                                    <img src="{{asset('assets/logo.png')}}" alt="branding logo" style="width:250px; height: 100px">--}}
                                {{--                                </div>--}}
                                <div class="font-large-1  text-center">
                                    Login
                                </div>
                            </div>
                            <div class="card-content">

                                <div class="card-body">
                                    <form class="form-horizontal" action="{{route('admin.login')}}" method="post"
                                          novalidate>
                                        @csrf
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="email" class="form-control round input-style" id="user-name"
                                                   name="email"
                                                   placeholder="Enter Email">
                                            @if($errors->has('email'))
                                                <div class="error"
                                                     style="color:red">{{$errors->first('email')}}</div>
                                            @endif
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control round input-style"
                                                   id="user-password"
                                                   name="password" placeholder="Enter Password">
                                            @if($errors->has('password'))
                                                <div class="error"
                                                     style="color:red">{{$errors->first('password')}}</div>
                                            @endif
                                        </fieldset>
                                        <div class="form-group text-center">
                                            <button type="submit"
                                                    class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">
                                                Login
                                            </button>
                                        </div>

                                    </form>
                                </div>
                                {{--                                <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-2 "><span>OR Sign Up Using</span></p>--}}
                                {{--                                <div class="text-center">--}}
                                {{--                                    <a href="#" class="btn btn-social-icon round mr-1 mb-1 btn-facebook"><span class="ft-facebook"></span></a>--}}
                                {{--                                    <a href="#" class="btn btn-social-icon round mr-1 mb-1 btn-twitter"><span class="ft-twitter"></span></a>--}}
                                {{--                                    <a href="#" class="btn btn-social-icon round mr-1 mb-1 btn-instagram"><span class="ft-instagram"></span></a>--}}
                                {{--                                </div>--}}
                                {{--                                <p class="card-subtitle text-muted text-right font-small-3 mx-2 my-1"><span>Don't have an account ? <a href="register.html" class="card-link">Sign Up</a></span></p>--}}
                                <p class="card-subtitle text-muted text-right font-small-3 mx-2 my-1"><span>Lost Password ? <a
                                            href="{{route('forgot.password')}}"
                                            class="card-link">Forgot Password</a></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->

@if ($message = Session::get('success'))
    <script>
        setTimeout(function () {
            document.getElementById('alert-success-message').style.display = 'none'
        }, 3000);
    </script>
@endif
@if ($message = Session::get('error'))
    <script>
        setTimeout(function () {
            document.getElementById('alert-error-message').style.display = 'none'
        }, 3000);
    </script>
@endif

<!-- BEGIN: Vendor JS-->
<script src="{{asset('assets/dashboard/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('assets/dashboard/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"
        type="text/javascript"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/dashboard/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/dashboard/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('assets/dashboard/app-assets/js/scripts/forms/form-login-register.js')}}"
        type="text/javascript"></script>
<!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
