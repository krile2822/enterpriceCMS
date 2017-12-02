<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title>{{ trans('translate.admin') }}</title>
    <link rel="stylesheet" href="/lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/login.css">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- Designed with ♥ by Frondor -->
<div class="container-fluid">
    <div class="row">
        <div class="faded-bg animated"></div>
        <div class="hidden-xs col-sm-8 col-md-9">
            <div class="clearfix">
                <div class="col-sm-12 col-md-10 col-md-offset-2">
                    <div class="logo-title-container">
                    </div> <!-- .logo-title-container -->
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-3 login-sidebar animated fadeInRightBig">
            <div class="login-container animated fadeInRightBig">

                <h2>{{trans('translate.sign_in')}}:</h2>

                <form action="{{ route('postLogin') }}" method="POST">
                {{ csrf_field() }}
                @if ($confirmation_code != null)
                  <input type="hidden" name="code" value="{{ $confirmation_code }}">
                @endif
                <div class="group">
                  <input type="text" name="email" value="{{ old('email') }}">
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label><i class="glyphicon glyphicon-user"></i><span class="span-input"> {{trans('translate.email')}}</span></label>
                </div>

                <div class="group">
                  <input type="password" name="password">
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label><i class="glyphicon glyphicon-lock"></i><span class="span-input"> {{trans('translate.password')}}</span></label>
                </div>

                <button type="submit" class="btn btn-block btn-primary login-button">
                    <span class="signin">{{trans('translate.login')}}</span>
                </button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">

                <br>

              </form>
              <button type="submit" class="btn btn-block btn-primary">
                <a href="{{ route('register') }}" style="color:white;"> {{trans('translate.register')}} </a>
                </button>

                @include ('admin::admin.includes.message-block')
            </div> <!-- .login-container -->

        </div> <!-- .login-sidebar -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
<script>
    var btn = document.querySelector('button[type="submit"]');
    var form = document.forms[0];
    btn.addEventListener('click', function(ev){
        if (form.checkValidity()) {
            btn.querySelector('.signingin').className = 'signingin';
            btn.querySelector('.signin').className = 'signin hidden';
        } else {
            ev.preventDefault();
        }
    });
</script>
</body>
</html>
