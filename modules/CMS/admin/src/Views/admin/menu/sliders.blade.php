@extends ('admin::admin.layouts.master')

@section('css')
  {{-- Revolutuion slider CSS --}}
  <link rel="stylesheet" href="/jollyany/rs-plugin/css/settings.css">
  {{-- Revolution slider JS --}}
  <script type="text/javascript" src="/jollyany/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
  <script type="text/javascript" src="/jollyany/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

@section('content')
<style>
#slideshow .list-group-item { padding : 5px 6px 6px 10px; }
#slideshow div.row { margin: 0px;}
#slideshow div.row div { padding-left: 0px; padding-right: 0px;}

#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
#sortable li span { position: absolute; margin-left: -1.3em; }
</style>

  <div class="content">
    <h2>Sliders</h2>
  </div>

  <div class="container-fluid">
    <div class="row" id="content">
        <div id="notification"></div>
        <div id="colOne" class="col-md-3 col-lg-3" style="padding-right: 0px;">
          @include ('admin::admin.layouts.slider-image-list')
        </div>
        <div id="handler_vertical"></div>
        <div id="colTwo" class="col-md-9 col-lg-9">
            {{-- @include ('admin::admin.layouts.slider-image-edit') --}}
        </div> <!-- /colTwo -->
        <div style="clear: both; display: inline-block;"></div>
    </div> <!-- /row --><!-- /content -->

    <div id="slider_image_preview"> {{-- Slider preview --}}

    </div> {{-- End of slider preview --}}

</div>

  <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
  <script src="//malsup.github.com/jquery.form.js"></script>

@endsection
