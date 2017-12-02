@extends ('admin::admin.layouts.master')

@section ('content')
<?php $emails = CMS\Contact\Email::getEmails(); ?>
<section class="content-header">
      <h1>Emails</h1>
</section>

<section class="content">
      <div class="row">
        
        <div class="col-md-5">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  @foreach ($emails as $mail)
                  <?php $msg = substr($mail->message, 0, 80); ?> 
                  <tr>
                    <td class="mailbox-name"><a href="" data-id="{{$mail->id}}" class="selected_mail">{{ $mail->name }}</a></td>
                    <td class="mailbox-subject"> {{ $msg }}... 
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?= $mail->created_at->diffForHumans(); ?></td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            {{ $emails->links() }}
          </div>
          <!-- /. box -->
        </div>
          
          <div id="email"></div>
          
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

<script>
    $(function() {
        var token = '{{ Session::token() }}';
        
        $('.selected_mail').on('click', function(e){
           e.preventDefault();
           var id = $(this).data('id');
           
           $('#email').load("{{ route('get.selected.mail') }}", {id: id, _token: token});
        });
    });
</script>

@endsection

