@extends ('front::elementy.master')

@section ('static_media')
<!-- STATIC MEDIA IMAGE -->
        <div class="sm-img-bg" style="background-image: url(/elementy/images/main_image5.png)">
          <div class="container sm-content-cont text-center">
            <div class="sm-cont-middle">

            </div>
          </div>
        </div>  

@endsection

@section('page')

@include ('front::elementy.layouts.capabilies')
@include ('front::elementy.layouts.clients')

@endsection