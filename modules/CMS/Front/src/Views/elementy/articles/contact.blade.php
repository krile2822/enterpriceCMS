<?php 
$email = CMS\admin\Settings::where('name', 'email_address_for_feedback')->first(); 
$address = CMS\admin\Settings::where('name', 'address')->first();
$phone = CMS\admin\Settings::where('name', 'phone_number')->first();
?>

<!-- GOOGLE MAP -->
        <div class="page-section">
          <div class="container-fluid">
            <div class="row row-sm-fix">
              <div data-address="{{$address->content}}" id="google-map"></div>
            </div>
          </div>
        </div>

        <!-- CONTACT INFO SECTION 1  -->
        <div id="contact-link" class="page-section p-100-cont bg-gray">
          <div class="container">
            <div class="row">
            
              <div class="col-md-4 col-sm-6">
                <div class="cis-cont">
                  <div class="cis-icon">
                    <div class="icon icon-basic-map"></div>
                  </div>
                  <div class="cis-text">
                    <h3>Address</h3>
                    <p>{{$address->content}}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="cis-cont">
                  <div class="cis-icon">
                    <div class="icon icon-basic-mail"></div>
                  </div>
                  <div class="cis-text">
                    <h3>Email</h3>
                    <p><a href="{{$email->content}}">{{$email->content}}</a></p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="cis-cont">
                  <div class="cis-icon">
                    <div class="icon icon-basic-smartphone"></div>
                  </div>
                  <div class="cis-text">
                    <h3>Call Us</h3>
                    <p>{{$phone->content}}</p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>        
        </div> 