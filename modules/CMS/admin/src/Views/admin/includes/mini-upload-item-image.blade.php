<form id="add_item_image" action="{{ route('add.item.image') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type='hidden' value='{{ $item->id }}' name='item_id'>
  <input type='file' name='item_image'>
  <input type='submit' id='submit_item_image' style="display:none;">
</form>

<script>
$(function() {

    var options = {
         target:       '', //current_tab,   // target element(s) to be updated with server response
           success:       hideModal  // post-submit callback
    };

    function hideModal(responseText, statusText, xhr, $form) {
      $('#mdl_item_form').modal('hide');
      $('.modal-backdrop').remove();
    };

    $('#add_item_image').submit(function() {
      $(this).ajaxSubmit(options);
      return false;
    });

});
</script>
