@extends('app')

@section('browserTitle') TalkingSpace - Register @stop

@section('mainTitle') Register To TalkingSpace @stop

@section('content')

    @include('_partials._flash_errors')

    <form role="form" enctype="multipart/form-data" method="post" action="" id="register-form">
        <div class="form-group">
            <label for="name" class="control-label">Name*</label>
            <input type="text" class="form-control"  placeholder="Enter your name" name="name" id="name" value="{{ set_value('name') }}">
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email Address*</label>
            <input type="email" class="form-control"  placeholder="Enter your email" name="email" id="email" value="{{ set_value('email') }}">
        </div>
        <div class="form-group">
            <label for="username" class="control-label">Choose User Name*</label>
            <input type="text" class="form-control"  placeholder="Enter user name" name="username" id="username" value="{{ set_value('username') }}">
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Password*</label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="verify_password" class="control-label">Confirm Password*</label>
            <input type="password" class="form-control" placeholder="Enter Password Again" name="verify_password" id="verify_password">
        </div>
        <div class="form-group">
            <label>Upload Avatar</label>
            <input type="file" name="avatar">
        </div>
        <div class="form-group">
            <label>About Me</label>
            <textarea class="form-control" rows="7" name="about"></textarea>
        </div>
        <div class="form-group">
            <p><strong>Vertifivation Code</strong></p>
            <div class="col-md-2">
                <img src="/captcha" alt="" id="captcha">
            </div>
           <div class="col-md-4">
               <input type="text" class="form-control" name="captcha">
           </div>
        </div>


        <div class="form-group" style="clear: both;">
            <br>
            <button type="submit" class="btn btn-default" name="submit">Submit</button>
        </div>

    </form>

@stop


@section('statistics')
@stop

@section('script')
    <script src="{!! asset('assets/js/jquery-validate.min.js') !!}"></script>
    <script>
        $('#register-form').validate({
            rules: {
                name: {required: true},
                username: {required: true},
                email: {required: true, email: true},
                password: {required: true},
                verify_password: {required: true, equalTo: '#password'}
            }
        });

        $('#register-form').on('submit', function() {
            var error = $('div.form-group').siblings('.error').html();
            if (error != '') {
                $('.error').closest('div.form-group').addClass('has-error');
            }
        });

        $('input').on('blur', function() {
            var error = $(this).siblings('.error').html();
            if (error == "") {
                $(this).parents('div.form-group').removeClass('has-error');
            }
        });


        $('#register-form').on('click', 'img#captcha', function() {
            $(this).attr("src", "/captcha?r=" + Math.random());
        });
    </script>
@stop