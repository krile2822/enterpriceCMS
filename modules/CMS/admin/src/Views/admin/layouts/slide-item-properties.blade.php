<?php $item = CMS\admin\SlideShowItem::findOrFail($id); $locale = app()->getLocale(); ?>
<form action="{{ route('slide.item.edit') }}" role="form" id="frm_item" name="frm_item" enctype="multipart/form-data" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
  <input type="hidden" name="item_id" value="{{ $item->id }}">
  <div id="mainPanel" class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('translate.edit_item') }}</h3>
    </div>
    <div class="panel-body">

      <div class="col-lg-2">
        <div class="form-group col-lg-12">
          @if ($item->type == 1)
            <label class="radio-inline text-radio"><input type="radio" name="type" value="1" checked="checked">{{ trans('translate.text') }}</label>
            <label class="radio-inline image-radio"><input type="radio" name="type" value="2" >{{ trans('translate.image') }}</label>
          @else
            <label class="radio-inline text-radio"><input type="radio" name="type" value="1">{{ trans('translate.text') }}</label>
            <label class="radio-inline image-radio"><input type="radio" name="type" value="2" checked="checked">{{ trans('translate.image') }}</label>
          @endif
        </div>

        <div class="bs-example img-fields col-lg-12" id="image_field" data-example-id="thumbnails-with-custom-content" style="display: none;">
          <div class="thumbnail">
            @if ($item->filename != null)
              <img data-holder-rendered="true" class="img-fields" src="/storage/rev_slider/items/{{ $item->filename }}" style="display:none;">
            @else
              <img data-holder-rendered="true" class="img-fields" src="/images/no_photo.png" style="display:none;">
            @endif
            <div class="caption">
              <p style="text-align:center">
                <span style="width:50px" class="btn btn-primary item_file_form img-fields" data-toggle="modal" data-target="#mdl_item_form" style="display: none;">
                  <i class="glyphicon glyphicon-plus-sign"></i>
                </span>
              </p>
            </div>
          </div>
        </div>

      </div>
      <?php $langs = CMS\admin\Language::getLanguages();?>
      <div class="col-lg-4">
        <div class="bs-example bs-example-tabs col-lg-12" data-example-id="togglable-tabs">

          <ul class="nav nav-tabs" role="tablist">

            @foreach($langs as $lang)
              @if ($lang['code'] == $locale)
                <li role="presentation" class="active"><a href="#{{ $lang['code'] }}" id="{{ $lang['code'] }}-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">{{ $lang['code'] }}</a></li>
              @else
                <li role="presentation"><a href="#{{ $lang['code'] }}" id="{{ $lang['code'] }}-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">{{ $lang['code'] }}</a></li>
              @endif
            @endforeach

          </ul>

          <div id="myTabContent" class="tab-content">
            @foreach ($langs as $lang)
              <?php $link = 'href_' . $lang['code']; $text = 'text_' . $lang['code']?>
              @if ($lang['code'] == $locale)
                <div role="tabpanel" class="tab-pane fade active in" id="{{ $lang['code'] }}" aria-labelledby="{{ $lang['code'] }}-tab">
              @else
                  <div role="tabpanel" class="tab-pane fade" id="{{ $lang['code'] }}" aria-labelledby="{{ $lang['code'] }}-tab">
              @endif
                <div class="form-group text-fields ">
                  <label for="x">{{ trans('translate.text') }}</label>
                  <input type="text" name="text_{{ $lang['code'] }}" value="{{ $item->$text }}" id="text_{{ $lang['code'] }}" placeholder="text_{{ $lang['code'] }}" maxlength="255" class="form-control text-fields">
                </div>
                <div class="form-group 2">
                  <label for="x">{{ trans('translate.link') }}</label>
                  <input type="text" name="href_{{ $lang['code'] }}" value="{{ $item->$link }}" id="href_{{ $lang['code'] }}" placeholder="href_{{ $lang['code'] }}" maxlength="255" class="form-control">
                </div>
              </div>
            @endforeach


          </div>
        </div>
        <div class="form-group col-lg-6">
          <label for="x">X - {{ trans('translate.position') }}</label>

          <div class="input-group">
            <input type="text" name="x" value="{{ $item->x }}" id="x" placeholder="X" maxlength="10" class="form-control x-field">
            <span class="input-group-btn">
                         <button type="button" class="btn btn-default x-left x-position" data-x_position="left"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span></button>
            <button type="button" class="btn btn-default x-center x-position" data-x_position="center"><span class="glyphicon glyphicon-align-center" aria-hidden="true"></span></button>
            <button type="button" class="btn btn-default x-left x-position" data-x_position="right"><span class="glyphicon glyphicon-align-right" aria-hidden="true"></span></button>
            </span>
          </div>

          <div class="h-offset" style="display:none;">
            <label for="hoffset">{{ trans('translate.horizontla_offset') }}</label>

            <input type="text" name="hoffset" value="0" id="hoffset" placeholder="hoffset" maxlength="10" class="form-control">
          </div>
        </div>

        <div class="form-group col-lg-6">
          <label for="y">Y - {{ trans('translate.position') }}</label>
          <div class="input-group">
            <input type="text" name="y" value="{{ $item->y }}" id="y" placeholder="Y" maxlength="10" class="form-control y-field">
            <span class="input-group-btn">
                       <button type="button" class="btn btn-default y-top y-position" data-y_position="top"><span class="glyphicon glyphicon-object-align-top" aria-hidden="true"></span></button>
            <button type="button" class="btn btn-default y-horizontal y-position" data-y_position="center"><span class="glyphicon glyphicon-object-align-horizontal" aria-hidden="true"></span></button>
            <button type="button" class="btn btn-default y-bottom y-position" data-y_position="bottom"><span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"></span></button>
            </span>
          </div>

          <div class="v-offset" style="">
            <label for="voffset">{{ trans('translte.vertical_offset') }}</label>
            <input type="text" name="voffset" value="0" id="voffset" placeholder="voffset" maxlength="10" class="form-control">
          </div>
        </div>


      </div>

      <?php $div_class = app()->config->get('slider_rev.slideshow_div_classes'); ?>
      <div class="col-lg-4">
        <div class="form-group col-lg-5">
          <label for="class">{{ trans('translate.class') }}</label>
          <select name="class" class="form-control" id="class" placeholder="Class">
            @foreach ($div_class as $key => $div)
              @if ($div == $item->class)
                <option value="{{ $key }}" selected="selected"> {{ $div }} </option>
              @else
                <option value="{{ $key }}" selected="selected"> {{ $div }} </option>
              @endif
            @endforeach
          </select>
        </div>
        <div class="form-group col-lg-3">
          <label for="speed">{{ trans('translate.speed') }}</label>

          <input type="text" name="speed" value="{{ $item->speed }}" id="speed" placeholder="speed" maxlength="5" class="form-control">

        </div>

        <div class="form-group col-lg-3">
          <label for="start">{{ trans('translate.start') }}</label>

          <input type="text" name="start" value="{{ $item->start }}" id="start" placeholder="start" maxlength="5" class="form-control">

        </div>

        <div class="form-group col-lg-3">
          <label for="start">{{ trans('translate.depth') }}</label>

          <select name="depth" id="depth" placeholder="depth" value="0" class="form-control">
            @for ($i = 0; $i <= 10; $i++)
              <option value="{{ $i }}"> {{ $i }} </option>
            @endfor
          </select>
        </div>

        <?php $eases = app()->config->get('slider_rev.slideshow_easing_options'); ?>
        <div class="form-group col-lg-7">
          <label for="class">{{ trans('translate.animation') }}</label>
          <select name="easing" class="form-control" id="easing" placeholder="Easing">
            @foreach ($eases as $key => $ease)
              @if ($ease == $item->easing)
                <option value="{{ $key }}" selected="selected"> {{ $ease }} </option>
              @else
                <option value="{{ $key }}"> {{ $ease }} </option>
              @endif
            @endforeach
          </select>
        </div>

        <div class="form-group col-lg-7">
          <label for="x">{{ trans('translate.endeasing') }}</label>
          <select name="endeasing" class="form-control" id="easing" placeholder="End easing">
            @foreach ($eases as $key => $ease)
              @if ($ease == $item->easing)
                <option value="{{ $key }}" selected="selected"> {{ $ease }} </option>
              @else
                <option value="{{ $key }}"> {{ $ease }} </option>
              @endif
            @endforeach
          </select>
        </div>

        <div class="form-group col-lg-4">
          <label for="y">{{ trans('translate.endspeed') }}</label>
            <input type="text" name="endspeed" value="" id="endspeed" placeholder="endspeed" maxlength="15" class="form-control">
        </div>

        {{-- <div class="form-group col-lg-12">
          <label for="speed">Customin</label>
          <input type="text" name="customin" value="" id="customin" placeholder="customin" maxlength="255" class="form-control">
        </div>

        <div class="form-group col-lg-12">
          <label for="start">Customout</label>
          <input type="text" name="customout" value="" id="customout" placeholder="customout" maxlength="255" class="form-control">
        </div> --}}
      </div>
    </div>
    <div class="panel-footer">
      <button name="delete" type="button" id="btn_delete" data-id_item="{{ $item->id }}" class="confirm btn btn-danger pull-left" data-toggle="modal" data-target="#delete_modal" style="margin-right:5px">{{ trans('translate.delete') }}</button>
      <button type="submit" id="btn_save" value="true" class="btn btn-primary ">{{ trans('translate.save') }}</button>
    </div>
  </div>
</form>


<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="">{{ trans('translate.delete') }}</h4>
      </div>
      <div class="modal-body">
        {{ trans('translate.do_you_want_to_delete_element') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.close') }}</button>
        <!-- <button type="button" id="btn_delete_confirmed" class="btn btn-primary delete_item" data-id_item="64">Delete</button> -->
        <button type="button" id="delete_item" class="btn btn-primary delete_item" >{{ trans('translate.delete') }}</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="mdl_item_form" tabindex="-1" role="dialog" aria-labelledby="saveImageModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        @include ('admin::admin.includes.mini-upload-item-image')
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.close') }}</button>
          <button type="button" class="btn btn-primary btn_save_slide_image">{{ trans('translate.save') }}</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(function() {

      var token = "{{ Session::token() }}";

      /***** If the item is an image the image radio button is active *****/
      var image = $('.image-radio').children().attr('checked');
      if (image == 'checked') {
        $('.img-fields').show();
        $(".text-fields").hide();
      } else {
        $('.img-fields').hide();
        $(".text-fields").show();
      }
      /*********************************************************************/
      $(".text-radio").click(function(){
          $(".img-fields").hide();
          $(".text-fields").show();
      });

      $(".image-radio").click(function(){
          $(".img-fields").show();
          $(".text-fields").hide();
      });

      $('#delete_modal').on('show.bs.modal', function(event) {
          var itemID = $(event.relatedTarget).data('id_item');
          $('#delete_item').attr('data-id_item', itemID);
      });

      // delete item with delete button, not trash button
      $('#delete_item').on('click', function() {
          var itemID = $(this).attr('data-id_item');
          $('#colTwo').load('{{ route('delete.image.item') }}', {
              id: itemID, _token: token
          });
      });

      $('.btn_save_slide_image').click(function() {
          $('#submit_item_image').trigger('click');
      });

      /* X - Y postition scripts */
      var x = isNaN($('.x-field').val());
      var y = isNaN($('.y-field').val());

      if(x){ $('.h-offset').show(); }else{ $('.h-offset').hide(); }
      if(y){ $('.v-offset').show(); }else{ $('.v-offset').hide(); }

      $(".x-field").keyup(function(){
            var x = isNaN($('.x-field').val());
            if(x){ $('.h-offset').show(); }else{ $('.h-offset').hide(); }
      });

      $(".y-field").keyup(function(){
            var y = isNaN($('.y-field').val());
            if(y){ $('.v-offset').show(); }else{ $('.v-offset').hide(); }
      });

      $(".x-position").click(function(){
          var x_position = $(this).data('x_position');
          $('.x-field').val(x_position);
          var x = isNaN($('.x-field').val());
          if(x){ $('.h-offset').show(); }else{ $('.h-offset').hide(); }
      });

      $(".y-position").click(function(){
          var y_position = $(this).data('y_position');
          $('.y-field').val(y_position);
          var y = isNaN($('.y-field').val());
          if(y){ $('.v-offset').show(); }else{ $('.v-offset').hide(); }
      });
     /* X - Y postition scripts */

    var options = {
         target:       '', //current_tab,   // target element(s) to be updated with server response
          success:       showResponse  // post-submit callback
    };

    function showResponse(responseText, statusText, xhr, $form) {
      var id = responseText.id;
      $('#colTwo').load("{{ route('get.slide.item') }}", {
        image: id,
        _token: token
      });
    };

    $("#frm_item").submit(function() {
          $(this).ajaxSubmit(options);
          return false;
    });

	$(".delete_item").click(function (e) {
        // e.preventDefault();
        // var  id_item = $(this).data('id_item');
        // var  id_slideshow = '54';
        // $("#colTwo").load('http://cms.dev.tippnet.rs/en/app_revolution/admin/slideshow/delete_ax/', {
        //     func:'delete_item',
        //     id_item: id_item,
        //     id_slideshow:id_slideshow,
        //     'ci_csrf_token' :''
        // });
        $('#delete_modal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
	});

	$(".item_file_form").click( function(event){
        event.preventDefault();
        var id = $(this).data('id'),
            db_field = $(this).data('db_field'),
            func = $(this).data('func'),
            id_item = $(this).data('id_item'),
            image = $(this).data('image');

        $(".upload-modal").load('http://cms.dev.tippnet.rs/en/app_revolution/admin/slideshow/file_form/', {func:func, id: id, db_field: db_field,id_item: id_item, image:image, 'ci_csrf_token' :''});
    });
});
</script>
