<form id="slide_image_upload" action="{{ route('slider.image.upload.form') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="file" name="slide_image_form">
  <input type="hidden" name="id" value="{{ $slide->id }}">
  <input type="hidden" id="lang" name="lang">
  <input type="submit" id="hidden_submit">
</form>

<script>
  $(function() {

  $('#hidden_submit').hide();

  var options = {
    target: '', // target element(s) to be updated with server response
    success: showResponse // post-submit callback
  };

  function showRequest(formData, jqForm, options) {
    return true;
  };

  function showResponse(responseText, statusText, xhr, $form) {
    var file = responseText.filename;
    var code = responseText.code;
    var lang = responseText.lang;
    var src = responseText.src;
    var btn = responseText.btn;
    $('#img_' + lang).attr('src', src);
    if (btn == 1) {
      $('#delete_button_' + lang).html('<button style="display:block" id="btn_delete_img" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteImageModal" data-filename="' + file + '" data-lang="' + code + '"><span class="glyphicon glyphicon-trash"></span></button>');
    }
    $('#colOne').load('{{ route('refresh.slide.list') }}');
    $('#mdl_file_form').modal('hide');
  };

  $('#slide_image_upload').submit(function() {
    $(this).ajaxSubmit(options);
    // !!! Important !!!
    // always return false to prevent standard browser submit and page navigation
    return false;
  });

  $('.btn_save_slide_image').on('click', function(event) {
    event.preventDefault();
    $('#hidden_submit').trigger('click');
  });
});
</script>
