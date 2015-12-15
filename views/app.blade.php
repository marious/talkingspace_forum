<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('browserTitle') Welcom To TalkingSpace @show</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/custom.css')  }}" rel="stylesheet">

</head>

<body>

@include('_partials._nav')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="push-left">@section('mainTitle') Welcome To TalkingSpace @show</h1>
                    <h4 class="pull-right">A simple PHP forum engine</h4>
                    <div class="clearfix"></div>
                    <hr>

                    @include('_partials._flash_success')
                    @include('_partials._flash_errors')

                    @yield('content')

                    @section('statistics')
                    <h3>Forum Statistics</h3>
                    <ul>
                        <li>Total Number Of Users: <strong>{{ App\models\User::count() }}</strong></li>
                        <li>Total Number Of Topics: <strong>{{ App\models\Topic::count() }}</strong></li>
                        <li>Total Number Of Categories: <strong>{{ App\models\Category::count() }}</strong></li>
                    </ul>
                    @show
                </div>
            </div>
        </div><!-- end col-md-8 -->
        <div class="col-md-4">
            <div id="sidebar">
                <div class="block">
                    <h3>Login Forum</h3>
                    @if (userLoggedIn())
                        <p>Welcome, {{ userLoggedIn()->username }}</p>
                        <p><a href="/logout" class="btn btn-primary">Logout</a></p>
                    @else
                    <form role="form" method="post" action="/">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Enter email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control"  placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="do_login">Login</button> <a href="/register" class="btn btn-default"> Create Account</a>
                    </form>
                    @endif
                </div>

                <div class="block">
                    <h3>Categories</h3>
                    <div class="list-group">
                        {!! App\models\Category::getCategories() !!}
                    </div>
                </div>
            </div>

        </div><!-- end col-md-4 -->
    </div><!-- end row -->
</div><!-- /.container -->



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('assets/js/jquery-1.11.2.min.js') }}"></script>
<script src="{{  asset("assets/js/bootstrap.js") }}"></script>

@yield('script')

</body>
</html>
