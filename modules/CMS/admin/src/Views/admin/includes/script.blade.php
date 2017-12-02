<script id="reload">

  $(function(){
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
                $("#user_table").load(location.href+" #user_table>*");
                $('#ajax-loader').hide();
                $('#reload').load('{{ route('refresh.JS') }}');
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
