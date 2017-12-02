@extends ('admin::admin.layouts.master')

@section ('content')
  <div class="content">
      <h2>Users</h2>
  </div>

  @if(auth()->user()->is_admin)
      <div class='col-md-1'>
          <div>
              <a class='btn btn-app' data-toggle='modal' data-target='#create_modal'><i class='fa fa-plus'></i>{{ trans('translate.add_user') }}</a>
          </div>
      </div>
  @endif

  <div class="content" style="position: relative">
      <div id='ajax-loader'>
          <img src='/images/ajax-loader.gif'/>
      </div>

    <div class="col-md-offset-1 col-md-8">
      <div class="box">
        <div class="box-body no-padding">
          <table id="user_table" class="table">
            <tbody>
              <tr>
                <th class="center">{{ trans('translate.username') }}</th>
                <th class="center">{{ trans('translate.email_address') }}</th>
                <th class="center">{{ trans('translate.role') }}</th>
                <th class="center"></th>
              </tr>
              @foreach ($users as $user)
                <tr style="text-align: center">
                  <td id="name-{{$user->id}}" >{{ $user->name }}</td>
                  <td id="email-{{$user->id}}">{{ $user->email }}</td>
                  @if ($user->is_admin === 1)
                  <td>{{ trans('translate.admin')}}</td>
                  @else
                  <td>{{ trans('translate.user') }}</td>
                  @endif


                  @if (auth()->user()->is_admin)
                  <td>
                  <span id="{{ $user->id }}"></span>
                  <a id="e" data-toggle='modal' data-target='#edit_modal' >
                    <i class="fa fa-pencil-square-o"></i>
                  </a>
                  <a data-toggle="confirmation" data-id="{{ $user->id }}" data-placement="top" class="delete_confirm">
                    <i class="fa fa-trash-o"></i>
                  </a>
                  </td>
                  @endif

              </tr>
            @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>


  <div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="">{{ trans('translate.create_new_user') }}</h4>
                  </div>
                  <div class="modal-body">
                      <form id="add_user">
                        <div class="form-group">
                          <label class="control-label"> {{ trans('translate.username') }} </label>
                          <input type='text' id="name" data-name="name" class="form-control" />
                        </div>
                        <div class="form-group">
                          <label class="control-label"> {{ trans('translate.email') }} </label>
                          <input type='email' id="email" data-mail="email" class="form-control" />
                        </div>
                        <div class="form-group">
                          <label class="control-label"> {{ trans('translate.password') }} </label>
                          <input type='password' id="pass" data-pass="password" class="form-control" />
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.close') }}</button>
                      <button type="button" id="btn_create_confirm" class="btn btn-primary">{{ trans('translate.create') }}</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="">{{ trans('translate.edit_user') }}</h4>
                  </div>
                  <div class="modal-body">
                      <form id="edit_user">

                        <div class="form-group">
                          <label class="control-label"> {{ trans('translate.username') }} </label>
                          <input type='text' id="edit_name" data-name="edit_name" class="form-control" />
                        </div>
                        <div class="form-group">
                          <label class="control-label"> {{ trans('translate.email') }} </label>
                          <input type='email' id="edit_email" data-name="edit_name" class="form-control" />
                        </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.close') }}</button>
                      <button type="button" id="btn_edit_confirm" class="btn btn-primary">{{ trans('translate.create') }}</button>
                  </div>
              </div>
          </div>
      </div>

  </div> <!-- end of content -->

  <script id="reload">

    $(function(){
      init();

      function init() {
        $('[data-toggle=confirmation]').confirmation({

          rootSelector: '[data-toggle=confirmation]',
          onConfirm: function(event) {
            var id = $(this)[0].id;

            $.ajax({
                method: 'POST',
                url: "{{ route('user.delete') }}",
                data : {id: id, _token: token}
            }).done(function(msg) {
                if (msg['message'] == 'OK') {
                    $('#name-' + msg['id']).parent().remove();
                } else {
                    console.log('error');
                }
            });
          }
        });
      }


      var token = "{{ Session::token() }}"

      $('#btn_create_confirm').on('click', function() {
          $('#create_modal').modal('hide');
          $('#ajax-loader').show();

          var name = $('#name').val();
          var email = $('#email').val();
          var pass = $('#pass').val();

          $.ajax({
              method: "POST",
              url: "{{ route('user.add') }}",
              data: {name: name, email: email, password: pass, _token: token}
          }).done(function(msg) {
              if(msg['message'] == "OK") {
                  $("#user_table").load(location.href+" #user_table>*", function() {
                    init();
                  });
                  $('#ajax-loader').hide();
                  console.log('user created');
              } else {
                  console.log('error');
              }
          });
      });

      var id;

      $(document).on('click', '#e', function() {

          var id = $(this).siblings()[0].getAttribute('id');
          window.id = id;
          var username = $('#name-' + id).text();
          var email = $('#email-' + id).text();

          $('#edit_name').val(username);
          $('#edit_email').val(email);
      });

      $('#btn_edit_confirm').on('click', function() {
          var new_name = $('#edit_name').val();
          var new_email = $('#edit_email').val();
          var id = window.id;
          $.ajax({
              method: 'POST',
              url: '{{ route("user.modify") }}',
              data: {id: id ,new_name: new_name, new_email: new_email, _token: token}
          }).done(function(msg) {
              if (msg['message'] = 'OK') {
                  $('#edit_modal').modal('hide');
                  $('#name-' + msg['id']).text(msg['new_name']);
                  $('#email-' + msg['id']).text(msg['new_email']);
              } else {
                  console.log("Error");
              }
          });
      });

      /*  DELETE FUNCTION WITHOUT CINFIRM MODAL */

      // $(document).on('click', '#d', function() {
      //     var id = $(this).siblings()[0].getAttribute('id');

      //     $.ajax({
      //         method: 'POST',
      //         url: "{{ route('user.delete') }}",
      //         data : {id: id, _token: token}
      //     }).done(function(msg) {
      //         if (msg['message'] == 'OK') {
      //             $('#name-' + msg['id']).parent().remove();
      //         } else {
      //             console.log('error');
      //         }
      //     })
      // });

    });
  </script>
@endsection
