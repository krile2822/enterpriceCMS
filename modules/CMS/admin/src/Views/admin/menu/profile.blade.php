@extends ('admin::admin.layouts.master')

@section('css')
<!-- <link rel="stylesheet" type="text/css" href="/css/ga-embed.css"> -->
@endsection

@section ('content')

<?php
    $username = auth()->user()->name;
    $id = auth()->user()->id;
?>

<div class="content">
    <h2>{{ trans('translate.profile') }}</h2>
</div>

<div class="content">
    <div class='row'>
        <div class="col-md-offset-3 col-md-6">
            <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{ $username }}</h3>

              <?php
                $user = auth()->user()->is_admin;
                if ($user == true) {
                    $admin = "Admin";
                } else {
                    $admin = "User";
                }
              ?>
              <h5 class="widget-user-desc">Role: {{$admin}}</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="/admin/dist/img/user2-160x160.jpg" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Created pages</h5>
                    <?php
                        $pages = count(CMS\admin\Page::where('author_id', $id)->get());
                    ?>
                    <span class="description-text">{{ $pages }}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Created articles</h5>
                    <?php
                        $articles = count(CMS\admin\Article::where('user_id', $id)->get());
                    ?>
                    <span class="description-text">{{$articles}}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">???</h5>
                    <span class="description-text">??????</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-offset-2 col-md-4">
        <form action="{{ route('pass.change') }}" method="POST" id="pass">
            <h2>Change password</h2><hr style="border-top-color:#3c8dbc"><br><br>
            {{ csrf_field() }}
            <div class='form-group'>
                <label name='password'>{{trans('translate.old_pass')}}: </label>
                <input type='password' class='form-control' name='old_password' required>
            </div>
            <div class='form-group'>
                <label name='new_password'>{{trans('translate.new_pass')}}: </label>
                <input type='password' class='form-control' name='password' id="password" required>
            </div>
            <div class='form-group'>
                <label name='confirm_password'>{{trans('translate.confirm_new_pass')}}: </label>
                <input type='password' class='form-control' name='password_confirmation' required>
            </div>

            <button type="submit" class="btn btn-primary">{{trans('translate.submit')}}</button>
        </form>
    </div>
    <div class="col-md-4">
        <form action="{{ route('username.change') }}" method="POST" id="change_username">
            <h2>Change username</h2><hr style="border-top-color:#3c8dbc"><br><br>
            {{ csrf_field() }}
            <div class='form-group'>
                <label name='new_uname'>New {{trans('translate.username')}}: </label>
                <input type='text' class='form-control' name='new_username' id="new_username">
            </div>
            <button type="submit" class="btn btn-primary">{{trans('translate.submit')}}</button>
        </form>
    </div>
</div>

<script>
  $(function() {

      $('#pass').validate({
        rules: {
          password_confirmation: {
            equalTo: "#password"
          }
        }
      });

      $('#change_username').validate({
        rules: {
          new_username: {
            required: true,
            minlength: 3
          }
        }
      });
  });
</script>

@endsection
