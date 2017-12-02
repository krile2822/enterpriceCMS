<form action="{{ route('slide.image.edit') }}" id="frm_slide" enctype="multipart/form-data" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
  <input type="hidden" name="id" value="{{ $slide->id }}">
  <!-- <div class="ui-widget ui-widget-content ui-corner-all"  style="display: inline-block;"> -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('translate.slideshow_image_edit') }}</h3>
    </div>
    <?php $langs = CMS\admin\Language::getLanguages();?>
    <div class="panel-body">
      <div class="bs-example slide-images" data-example-id="thumbnails-with-custom-content">
        <div class="row">
          @foreach ($langs as $lang)
             <?php $filename = 'filename_' . $lang['code']; ?>
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail" id="thumbnail_{{ $lang['code'] }}">
                @if ($slide->$filename == null)
                    <img data-holder-rendered="true" id="img_filename_{{$lang['code']}}" class="img-fileds" height="150" width="" border="0" src="/images/no_photo.png">
                @else
                  <?php $src = '/storage/rev_slider/images/' . $slide->$filename ?>
                    <img data-holder-rendered="true" id="img_filename_{{$lang['code']}}" class="img-fileds" height="150" width="" border="0" src="{{ $src }}">
                @endif

                <div class="caption row">
                  <div class="col-sm-12 col-lg-6 col-md-6">
                    <div id="delete_button_filename_{{ $lang['code'] }}">
                      @if ($slide->$filename != NULL)
                        <button style="display:block" id="btn_delete_img" type="button" class="btn btn-danger delete_{{ $lang['code'] }}" data-toggle="modal" data-target="#deleteImageModal" data-filename="{{ $slide->$filename }}" data-lang="{{ $lang['code'] }}">
                          <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      @endif
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-6 col-md-6">
                    <span id="slide_image_upload_form" class="btn btn-primary open-file-modal pull-right img-fileds" data-toggle="modal" data-target="#mdl_file_form" data-db_field="filename_{{ $lang['code'] }}" data-id="{{ $slide->id }}">{{ trans('translate.upload_image') }} {{ $lang['code'] }}</span>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <label>{{ trans('translate.name') }}: </label>
          <input type="text" name="title" value="{{ $slide->title }}" id="title" class="form-control max-250" maxlength="255" size="10">
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <label>{{ trans('translate.date_start') }}: </label>
          <input type="text" name="date_on" value="{{ $slide->date_on }}" id="date_on" class="form-control max-250" maxlength="255" size="10">
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <label>{{ trans('translate.date_stop') }}: </label>
          <input type="text" name="date_off" value="{{ $slide->date_off }}" id="date_off" maxlength="255" class="form-control max-250" size="10">
        </div>
      </div>
      <?php $trans = app()->config->get('slider_rev.transition_options');?>
      <div class="col-lg-3">
        <div class="form-group">
          <label>{{ trans('translate.transition') }}: </label>
          <select name="transition" class="form-control" value="{{ $slide->transition }}">
            @foreach ($trans as $key => $tran)
              @if ($tran == $slide->transition)
              <option value="{{ $key }}" selected="selected">{{ $tran }} </option>
            @else
              <option value="{{ $key }}">{{ $tran }} </option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <label>{{ trans('translate.slotamount') }}: </label>
          <select name="slotamount" class="form-control" value="{{ $slide->slotamount }}">
            @for ($i=0; $i <= 10 ; $i++)
              @if ($i == $slide->slotamount)
                <option value="{{ $i }}" selected="selected">{{ $i }} </option>
              @else
                <option value="{{ $i }}">{{ $i }} </option>
              @endif
            @endfor
          </select>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <label>{{ trans('translate.masterspeed') }}: [ms]</label>
          <input type="text" name="masterspeed" value="{{ $slide->masterspeed }}" id="masterspeed" maxlength="255" class="form-control max-250" size="10">
        </div>

      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <label>{{ trans('translate.delay') }}: [ms]</label>
          <input type="text" name="delay" value="{{ $slide->delay }}" id="delay" class="form-control max-250" maxlength="5" size="5">
        </div>

      </div>
    </div>
    <div class="panel-footer">
      <div class="row">
        <div class="col-md-6">
          {{-- <a href="#" class=" btn btn-warning" id="delete_slide_image" ref="{{ $slide->id}}">Delete</a> --}}
        </div>
        <div class="col-md-6">
          <button type="submit" id="btn_save" value="true" class="btn btn-primary pull-right">{{ trans('translate.save') }}</button>
          <button type="submit" id="btn_save_and_preview" value="true" style="margin-right:5px;" class="btn btn-primary pull-right">{{ trans('translate.save_and_preview') }}</button>

        </div>
      </div>

    </div>
  </div>
</form>

<div class="modal fade" id="mdl_file_form" tabindex="-1" role="dialog" aria-labelledby="saveImageModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        @include ('admin::admin.includes.mini-upload-form')
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.close') }}</button>
          <button type="button" class="btn btn-primary btn_save_slide_image">{{ trans('translate.save') }}</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteImageModal" tabindex="-1" role="dialog" aria-labelledby="deleteImageModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="deleteImageModalLabel">{{ trans('translate.delete') }}</h4>
      </div>
      <div class="modal-body">
        {{ trans('translate.do_you_want_to_delete_element') }} </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.close') }}</button>
        <button type="button" class="btn btn-primary btn_delete_slide_image" data-id="{{ $slide->id }}">{{ trans('translate.delete') }}</button>
      </div>
    </div>
  </div>
</div>

<script>

$(function() {

  var token = "{{ Session::token() }}";

  $('#date_on').datepicker({
    dateFormat: 'yy-mm-dd',
    weekStart: 1,
    todayHighlight: true
  });;

  $('#date_off').datepicker({
    dateFormat: 'yy-mm-dd',
    weekStart: 1,
    todayHighlight: true
  });;

  // $(document).on('click','#slide_image_upload_form' , function(event) {
  //     var slideID = $(this).data('id');
  //     var file_lang = $(this).data('db_field');
  //     $('#mdl_file_form').on('show.bs.modal', function() {
  //         $('.btn_save_slide_image').attr('data-lang', file_lang);
  //     });
  // });

  $()

  $('#mdl_file_form').on('show.bs.modal', function(event) {
    var file_lang = $(event.relatedTarget).data('db_field');
    $('#lang').attr('value', file_lang);
  });

  $('#btn_delete_img').on('click', function() {
    var id = "{{ $slide->id }}";
    var file = $(this).data('filename');
    var lang = $(this).data('lang');
  });

  $('#deleteImageModal').on('show.bs.modal', function(event) {
    var file = $(event.relatedTarget).data('filename');
    var lang = $(event.relatedTarget).data('lang');

    $('.btn_delete_slide_image').attr('data-file', file);
    $('.btn_delete_slide_image').attr('data-lang', lang);
  })

  $('.btn_delete_slide_image').on('click', function() {
    var id = $(this).data('id');
    var file = $(this).data('file');
    var lang = $(this).data('lang');
    $.ajax({
      method: 'POST',
      url: '{{ route('delete.slide.image') }}',
      data: {
        id: id, file: file, lang: lang, _token: token
      }
    }).done(function(msg) {
      $('#img_filename_' + msg['code']).attr('src', '/images/no_photo.png');
      var delBtn = $('div#delete_button_filename_' + msg['code'])[0].children;
      $(delBtn).remove();
    });
    $('#colOne').load('{{ route('refresh.slide.list') }}');
    $('#deleteImageModal').modal('hide');
    $(".modal-backdrop").remove();
  });

  $('#btn_save').on('click', function() {
    $('#frm_slide').submit(function() {
      $(this).ajaxSubmit(options);
      // !!! Important !!!
      // always return false to prevent standard browser submit and page navigation
      return false;
    });

    var options = {
      target: '', // target element(s) to be updated with server response
      //success: showResponse // post-submit callback
    };
  });
});
</script>
