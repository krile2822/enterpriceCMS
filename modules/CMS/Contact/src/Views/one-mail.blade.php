<div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Read Mail</h3>

      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <div class="mailbox-read-info">
          <h5>From: {{ $mail->name}} ({{ $mail->email }})
            <span class="mailbox-read-time pull-right"><?= $mail->created_at->toDayDateTimeString(); ?></span></h5>
        </div>
        <!-- /.mailbox-read-info -->
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message" style="text-align: justify; padding: 25px 50px 0px 50px;">
          <p>{{ $mail->message }}</p>

        </div>
        <!-- /.mailbox-read-message -->
      </div>
      <!-- /.box-body -->
      <!-- /.box-footer -->

      <!-- /.box-footer -->
    </div>
    <!-- /. box -->
</div>