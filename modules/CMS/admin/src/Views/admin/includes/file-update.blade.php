<form id="file_update" action="{{route('article.file.update')}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type="hidden" name='media_id' id="media_id" value="{{$media->id}}">
<div class="row">
      @if ( CMS\admin\Media::isImage($media->extension) )
        <div class="col-md-3 content">
          <?php $src = '/storage/' . $media->storage . '/' . $media->file_name . '.' . $media->extension; ?>
          <img id="edit_img" src="{{$src}}" alt="img" width="100%" style="margin-bottom: 8px;">
        </div>
      @else
        <div class="col-md-3 content">
          <img id="edit_img" src="/images/text-file-icon.png" alt="img" width="100%" style="margin-bottom: 8px;">
        </div>
      @endif
    <div class="col-md-8">
        <ul class="nav nav-tabs">
          <?php
            $locale = app()->getLocale();
            $langs = CMS\admin\Language::getLanguages();
           ?>

           @foreach ($langs as $lang)
            @if ($lang['code'] == $locale)
                <li class="active"><a data-toggle="tab" href="#file_{{$lang['code']}}">{{$lang['name']}}</a></li>
            @else
                <li><a data-toggle="tab" href="#file_{{$lang['code']}}">{{$lang['name']}}</a></li>
            @endif
          @endforeach
        </ul>

        <div class="tab-content content">
          @foreach ($langs as $lang)
            <?php
              $title = 'title_' . $lang['code'];
              $appears = 'appears_' . $lang['code'];
              if ($media->$appears == true) {
                $checked = 'checked';
              } else {
                $checked = '';
              }
             ?>
            @if ($lang['code'] == $locale)
              <div id="file_{{$lang['code']}}" class="tab-pane fade in active">
            @else
              <div id="file_{{$lang['code']}}" class="tab-pane fade">
            @endif
              <div class="form-group">
                <label for="file_title_{{$lang['code']}}">{{ trans('translate.title') }}: </label>
                <input type="text" name="file_title_{{$lang['code']}}" class="form-control" value="{{$media->$title}}">
              </div>

              <div class="form-group">
                <label for="file_appears_{{$lang['code']}}">{{ trans('translate.appears_in') }} {{$lang['name']}}: </label>
                <input type="checkbox" name="file_appears_{{$lang['code']}}" {{$checked}}>
              </div>
            </div>
          @endforeach

        </div>
    </div>

  </div>
  <button type="submit" name="media_edit" id="hidden_submit" value="form_submit"></button>

</form>

<script>
  $(function() {


        var options = {
          target:        '',   // target element(s) to be updated with server response
          //beforeSubmit:  showRequest,  // pre-submit callback
          success:       showResponse  // post-submit callback
      };

      // bind to the form's submit event


      function showRequest(formData, jqForm, options) {
        return true;
      }

      // post-submit callback
      function showResponse(responseText, statusText, xhr, $form)  {
        $('#edit_file_modal').modal('hide');
      }

        $('#file_update').submit(function() {
           $(this).ajaxSubmit(options);

            // !!! Important !!!
            // always return false to prevent standard browser submit and page navigation
            return false;
        });


    $('#hidden_submit').hide();

    $('#btn_file_edit_confirmed').on('click', function(event) {
      $('#hidden_submit').trigger('click');
    });

        //jQuery Form

    //end of jQuery Form
  });
</script>
