<!-- <div class="contact_form">
        <div id="message"></div>
        <h3>Contact us:</h3>
        <form id="contact" action="{{route('email.send')}}" method="post">
          <input type="text" name="name" id="name" class="form-control" placeholder="Name">
          <input type="text" name="email" id="email" class="form-control" placeholder="Email Address">
          <textarea class="form-control" name="message" id="message" rows="6" placeholder="Message"></textarea>
          <button type="submit" value="SEND" id="submit" class="btn btn-primary pull-right">Send</button>
        </form>
    </div> --><!-- end contact-form -->
            <div class="container p-100-cont">
              <!-- CONTACT INFO -->
              <div class="col-md-4 mb-30">
                <h3 class="mt-0">Leave a message</h3>
              </div>

              <!-- CONTACT FORM -->
              <div class="col-md-8">
                <div class="relative">
                  <form id="contact-form" action="{{route('email.send')}}" method="POST" novalidate="novalidate">
                   {{csrf_field()}}
                    <div class="row">
                    
                      <div class="col-md-12">
                        <div class="row">
                    
                          <div class="col-md-6 mb-23">
                            <!-- <label>Your name *</label> -->
                            <input type="text" value="" data-msg-required="Please enter your name" maxlength="100" class="form-control " name="name" id="name" placeholder="Name" required="" aria-required="true">
                          </div>
                           
                          <div class="col-md-6 mb-23">
                            <!-- <label>Your email address *</label> -->
                            <input type="email" value="" data-msg-required="Please enter your email address" data-msg-email="Please enter a valid email address" maxlength="100" class="form-control " name="email" id="email" placeholder="Email" required="" aria-required="true">
                          </div>
                        
                        </div>
                      </div>
                    
                      <div class="col-md-12">
                        <!-- <label>Message *</label> -->
                        <textarea maxlength="5000" data-msg-required="Please enter your message" rows="4" class="form-control " name="message" id="message" placeholder="Message" required="" aria-required="true"></textarea>
                        
                        <div id="hide_at_send" class="text-right text-xxs-center">
                          <input type="submit" value="SEND MESSAGE" class="button medium rounded gray font-open-sans mt-40" data-loading-text="Loading...">
                        </div>

                        <div id="loader" class="text-right text-xxs-center" style="margin-top:25px">
                          <img src="/elementy/images/5.gif" alt="loader">
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </form>	
                  
                  <div class="alert alert-success animated pulse hidden" id="contactSuccess">
                    Thanks, your message has been sent to us.
                  </div>
                 
                  <div class="alert alert-danger animated shake hidden" id="contactError">
                    <strong>Error!</strong> There was an error sending your message.
                  </div>
                  
                </div>
              </div>
            </div>

<script>
window.onload = function() {

  $('#loader').hide();

  var token = '{{Session::token()}}';

  $('#contact-form').on('submit', function(e) {
      e.preventDefault();
      $('#hide_at_send').hide();
      $('#loader').show();
      $('')
      var email = $('#email').val();
      var name = $('#name').val();
      var message = $('#message').val();
      $.ajax({
          url: '{{route("email.send")}}',
          method: 'POST',
          data: {
              name: name, email: email, message: message, _token: token
          },
          success:function(data) {
            if (data['msg'] == 'success') {
              $('#contactSuccess').removeClass('hidden');
            } else {
              $('#contactError').removeClass('hidden');
            }
            $('#contact-form')[0].reset();
            $('#loader').hide();
            $('#hide_at_send').show();            
          }     
      });
  });

};
</script>