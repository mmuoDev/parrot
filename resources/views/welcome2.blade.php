<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Happy Parrot</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="page-header">
            </div>
            <div class="jumbotron">
                <h1>Happy Parrot!</h1>
                <p >Lets help you keep and increase your customers!
                </p>
                <p class="help-block"><em>Happy Parrot is the best Customer Relationship Manager for Supermarkets.</em></p>
                <p><a class="btn btn-primary btn-lg" href="{{url('/register')}}" role="button">Try Us</a></p>
                <p class="help-block" style="font-size: 15px">
                    Returning customer? <a href="{{url('/login')}}">Login here</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>