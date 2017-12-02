<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title>{{trans('translate.register')}}</title>
    <link rel="stylesheet" href="/lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/login.css">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <style>
            body{
            /* Safari 4-5, Chrome 1-9 */
              background: -webkit-gradient(radial, center center, 0, center center, 460, from(#1a82f7), to(#2F2727));

            /* Safari 5.1+, Chrome 10+ */
              background: -webkit-radial-gradient(circle, #1a82f7, #2F2727);

            /* Firefox 3.6+ */
              background: -moz-radial-gradient(circle, #1a82f7, #2F2727);

            /* IE 10 */
              background: -ms-radial-gradient(circle, #1a82f7, #2F2727);
              height:600px;
            }

            .centered-form{
                    margin-top: 60px;
            }

            .centered-form .panel{
                    background: rgba(255, 255, 255, 0.8);
                    box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
            }

            label.label-floatlabel {
                font-weight: bold;
                color: #46b8da;
                font-size: 11px;
            }
        </style>
    @include ('admin::admin.includes.message-block')
    <div class="container">
            <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align:center">ICBTech CMS</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{ route('postRegister') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control input-sm" placeholder="{{trans('translate.username')}}">
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control input-sm" placeholder="{{trans('translate.email_address')}}">
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control input-sm" placeholder="{{trans('translate.password')}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="{{trans('translate.confirm_pass')}}">
                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="{{trans('translate.register')}}" class="btn btn-info btn-block">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </body>
</hmtl>
