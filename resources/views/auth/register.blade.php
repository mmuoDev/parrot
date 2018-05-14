<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/auth_/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/auth_/css/my-login.css')}}">
</head>
<body class="my-login-page">
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                {{--<div class="brand">--}}
                    {{--<img src="img/logo.jpg">--}}
                {{--</div>--}}
                <div class="card fat">
                    <div class="card-body">
                        <h4 class="card-title">Register</h4>
                        @include('partials.errors')
                        <form method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required data-eye>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="password">Confirm Password</label>--}}
                                {{--<input id="password" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="aggree" value="1"> I agree to the Terms and Conditions
                                </label>
                            </div>

                            <div class="form-group no-margin">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Register
                                </button>
                            </div>
                            <div class="margin-top20 text-center">
                                Already have an account? <a href="{{url('/login')}}">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="footer">
                    Only one sign up required per company. <br>
                    Copyright &copy; 2018 &mdash; Happy Parrot <br>
                    <a href="{{url('/')}}">Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{asset('/auth_/js/jquery.min.js')}}"></script>
<script src="{{asset('/auth_/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/auth_/js/my-login.js')}}"></script>
</body>
</html>