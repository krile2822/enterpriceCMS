

<div class="container p-100-cont">
<div class="row">
  

<?php $media = $article->medias[0]; 
  $path = '/storage/'.$media->storage.'/'.$media->file_name.'.'.$media->extension;
?>
    <div class="col-sm-6 col-md-6 col-lg-6 pb-50 pb-sm-30" >
                      
                    <div class="post-prev-img">
                      <a href="shop-single.html"><img src="{{$path}}" alt="img"></a>
                    </div>

                    <div class="post-prev-title mb-5 text-center">
                      <h3><a class="font-norm a-inv" href="">Phone</a></h3>
                    </div>
                      
                    <div class="shop-price-cont text-center">
                      <strong>$15.00</strong>
                    </div>
                      

                      <form action="{{ route('payment')}}" method='POST' id="order_form">
                    <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table table-striped shopping-cart-table">
                          <thead class="font-poppins">
                            <tr>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td>
                                  <input name="price" id="price" style="width:80px;border-bottom:none;text-align:center;" value='15' data-price="15" readonly>
                                </td>
                              <td>
                                <div>
                                  <input type="number" id="quantity" name="quantity" class="input-border white-bg" style="width: 80px;" min="1" max="100" value="1">
                                </div>
                              </td>
                              <td>
                                <input name="amount" id="amount" style="width:80px;border-bottom:none;text-align:center;" readonly>
                              </td>
                            </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                  
                  </div> 
              
              
              <div class="col-md-4 col-sm-12 col-md-offset-1 mb-50">

                <!-- ADD TO CART -->

                  <div class="row mb-40">
                        {{ csrf_field() }}
                        
                        <div class="col-xs-8 col-sm-6 col-md-6">
                            <div class="pl-15 pl-sm-0 post-prev-more-cont clearfix">
                            </div>
                        </div>
                        <span id="information"></span>
                    </div>
                


                <div class="">
                    <div class="col-md-6 mb-30">
                      <input class="form-control" type="text" name="name" id="first-name" placeholder="First Name*" required>
                    </div>
                    <!-- LAST NAME -->
                    <div class="col-md-6 mb-30">
                      <input class="form-control" type="text" name="last-name" id="last-name" placeholder="Last Name*" required>
                    </div>
                    <!-- COMPANY NAME -->
                    <div class="col-md-12 mb-30">
                      <input class="form-control" type="text" name="company" placeholder="Company Name" >
                    </div>
                    <!-- ADDRESS-->
                    <div class="col-md-12 mb-30">
                      <input class="form-control" type="text" name="address" placeholder="Address*" required>
                    </div>
                    <!-- CITY / TOWN -->
                    <div class="col-md-6 mb-30">
                        <input class="form-control" type="text" name="city" placeholder="City / Town*" required>
                    </div>
                    <!-- ZIP CODE -->
                    <div class="col-md-6 mb-30">
                      <input class="form-control" type="text" name="zip" placeholder="Zip Code*" required>
                    </div>
                    <!-- COUNTRY -->
                    <div class="col-md-12 mb-30">
                      <div class="select-sty4led w-100">
<!--                        <select required="" class="form-control" name="country">
                          <option selected="selected">Your country</option>
                        </select>-->
                          <input class="form-control" type="text" name="country" placeholder="Country" required>
                      </div>
                    </div>
                    <!-- EMAIL -->
                    <div class="col-md-6 mb-30">
                      <input class="form-control" type="email" name="email-address" id="email" placeholder="Email Address*" required>
                    </div>
                    <!-- PHONE -->
                    <div class="col-md-6 mb-30">
                      <input class="form-control" type="tel" name="phone" placeholder="Phone*" required>
                    </div>
                    <div class="col-md-9 mb-30 col-xs-9">
                        <input class="button full-rounded medium gray shop-add-btn" type="submit" id="checkout" value="Checkout">
                    </div>
                    <!-- PHONE -->
                    <div class="col-md-3 mb-30 col-xs-3" style="font-size:25px; margin-top:10px" >
                        <i class="fa fa-paypal"></i>
                        <img id="loader" src="/elementy/images/preloaders/6_32x32.gif" alt="loader" style="margin-top:5px;">
                    </div>
                    <input type="submit" id="hidden_submit">

              </div>
              </div>

              

              </form>
            </div>
          </div>
<script>
    $(function() {

        $('#hidden_submit').hide();
        $('#loader').hide();

        var price = $('#price').data('price');
        var quantity = $('#quantity').val();
        $('#amount').val(price * quantity);

        $('#checkout').on('click', function(event) {
            event.preventDefault();
            $('#hidden_submit').trigger('click');
        });

        $('#quantity').on('click', function() {
            var quantity = $('#quantity').val();
            var amount = price * quantity;
            $('#amount').val(amount);
        });

        $('#quantity').keypress(function(e) {
            if(e.which == 13) {
                e.preventDefault();
                var quantity = $('#quantity').val();
                var amount = price * quantity;
                $('#amount').val(amount);
            }
        });

        $('#order_form').submit(function() {
           $('#loader').show();
           $('.fa-paypal').hide();
        });
    });
</script>

