<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Happy Parrot</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/welcome_/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="{{asset('/welcome_/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('/welcome_/css/coming-soon.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/welcome_/css/coming-soon.css')}}">

</head>

<body>

<div class="overlay"></div>

<div class="masthead">
    <div class="masthead-bg"></div>
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-12 my-auto">
                <div class="masthead-content text-white py-5 py-md-0">
                    <h1 class="mb-3">Happy Parrot!</h1>
                    <p >Lets help you keep and increase your customers!
                    </p>
                    <p class="help-block"><em>Happy Parrot is the best Customer Relationship Manager for Supermarkets.</em></p>
                    <a href="{{url('/register')}}" class="btn btn-lg btn-danger">Try Us</a>
                    <a href="" class="btn btn-lg btn-success">More Details</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{--<div class="social-icons">--}}
    {{--<ul class="list-unstyled text-center mb-0">--}}
        {{--<li class="list-unstyled-item">--}}
            {{--<a href="#">--}}
                {{--<i class="fa fa-twitter"></i>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li class="list-unstyled-item">--}}
            {{--<a href="#">--}}
                {{--<i class="fa fa-facebook"></i>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li class="list-unstyled-item">--}}
            {{--<a href="#">--}}
                {{--<i class="fa fa-instagram"></i>--}}
            {{--</a>--}}
        {{--</li>--}}
    {{--</ul>--}}
{{--</div>--}}

<!-- Bootstrap core JavaScript -->
<script src="{{asset('/welcome_/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/welcome_/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Plugin JavaScript -->
<script src="{{asset('/welcome_/vendor/vide/jquery.vide.min.js')}}"></script>

<!-- Custom scripts for this template -->
<script src="{{asset('/welcome_/js/coming-soon.min.js')}}"></script>

<script>
    //made by vipul mirajkar thevipulm.appspot.com
    var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
        }

        setTimeout(function() {
            that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
                new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
</script>
</body>

</html>
