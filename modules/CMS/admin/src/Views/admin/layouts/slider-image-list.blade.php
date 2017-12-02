<?php $images = CMS\admin\SlideShowImage::getALlImages();
  $name = 'filename_' . app()->getLocale();
?>
  <div id="banners" class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Slideshow module</h3>
  </div>
  <div class="panel-body">
    <ul id="slideshow" class="list-group sortable sortable-disabled">
      {{-- <span id="new-slide-item"></span> --}}
        @foreach($images as $slide)
        <li class="list-group-item sortable-handle" id="{{ $slide->id }}" data-id="{{ $slide->id }}">
            <div class="row">
              <div class="col-md-7" >
                @if ($slide->$name == null)
                  <img class="banner_image_thumb" style="width:25px;margin-left:5%;" src="/images/no_image2.png" alt="no-image">
                @else
                  <img class="banner_image_thumb" style="width:50px;" src="/storage/rev_slider/images/{{ $slide->$name }}" alt="image">
                @endif
              </div>
              <div class="col-md-5 pull-right">
                <span class="banner_btn edit btn btn-default btn-xs" data-id="{{ $slide->id }}"><span class="glyphicon glyphicon-edit"></span></span>
                <span class="banner_btn item btn btn-default btn-xs" data-id_slideshow="{{ $slide->id }}"><span class="glyphicon glyphicon-list"></span></span>
                <span class="banner_btn duplicate btn btn-primary btn-xs" title="Duplicate Slider" data-id_slideshow="{{ $slide->id }}"><span class="glyphicon glyphicon-duplicate"></span></span>
                <span class="banner_btn btn btn-danger btn-xs" data-id="{{ $slide->id }}" data-toggle="modal" data-target="#mdl_delete_slide">
                           <span class="glyphicon glyphicon-trash"></span>
                </span>
                @if ($slide->online == true)
                  <span class="banner_btn publish btn btn-success btn-xs" data-id="{{ $slide->id }}" data-status="{{ $slide->online }}">
                  <span id="publish_{{ $slide->id }}" class="glyphicon glyphicon-eye-open"></span>
                @else
                  <span class="banner_btn publish btn btn-warning btn-xs" data-id="{{ $slide->id }}" data-status="{{ $slide->online }}">
                  <span id="publish_{{ $slide->id }}" class="glyphicon glyphicon-eye-close"></span>
                @endif
              </span>
              <span class="banner_btn preview btn btn-info btn-xs" data-id="{{ $slide->id }}"><span class="glyphicon glyphicon-sunglasses"></span></span>
            </div>
          </div>
        </li>
      @endforeach
      </ul>
      <span class="banner_btn insert btn btn-primary pull-right " id="insert_banner">
<span class="glyphicon glyphicon-plus-sign"></span> {{ trans('translate.add_image') }} </span>
    </div>
  </div>


  <div class="modal fade" id="mdl_delete_slide" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="">{{ trans('translate.delete') }}</h4>
        </div>
        <div class="modal-body">
          {{trans('trans.do_you_want_to_delete_element')}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.close') }}</button>
          <button type="button" class="btn btn-primary btn_delete_slide">{{ trans('translate.delete') }}</button>
        </div>
      </div>
    </div>
  </div>

<script>
  $(function() {

    var token = "{{ Session::token() }}";

    $(".sortable").sortable({
        update: function () {
            var slider_ids = $(".sortable").sortable("toArray");
            $.ajax({
                method: "POST",
                url: '{{route("slider.sort")}}',
                data: {ids: slider_ids, _token: token}
            }).done(function(msg) {
            });
        }
    });
    $( ".sortable" ).disableSelection();

  $('.edit').on('click', function() {
    var id = $(this).data('id');
    $('#colTwo').load("{{ route('get.slide.options') }}", {
      id: id,
      _token: token
    });
  });

  $('.preview').on('click', function() {
    var id = $(this).data('id');
    $('#slider_image_preview').load("{{ route('slider.preview') }}", {
      id: id, _token: token
    });
  });

  $('.item').on('click', function() {
    var id = $(this).attr('data-id_slideshow');
    $('#colTwo').load("{{ route('get.slide.item') }}", {
      image: id,
      _token: token
    });
  });

  $("#insert_banner").on('click', function() {
    $("#colOne").load('{{ route('new.slider.image') }}');
  });

  $('#mdl_delete_slide').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    $('.modal-footer .btn_delete_slide').attr('data-id', id);
  });

  $('.btn_delete_slide').on('click', function() {
    var id = $('#mdl_delete_slide').find('.btn_delete_slide').attr('data-id');
    $.ajax({
      method: 'POST',
      url: '{{ route('delete.slider.image') }}',
      data: {
        slider_id: id,
        _token: token
      }
    }).done(function(msg) {
      if (msg['message'] == 'success') {
        $("#colOne").load('{{ route('get.slides') }}');
        $("#colTwo").html("The slider image has been successfully deleted!");
      }
    });
    $('#mdl_delete_slide').modal('hide');
    $(".modal-backdrop").remove();
  })

  $(document).on('click', '.publish', function(event) {
    event.preventDefault();
    var id = $(this).attr('data-id');
    var status = $(this).attr('data-status');
    $.ajax({
      method: 'POST',
      url: '{{ route('slide.image.publish') }}',
      data: {
        id: id,
        status: status,
        _token: token
      }
    }).done(function(msg) {
        if (status == 0) {
          $('#publish_' + id).parent()['0'].dataset.status = msg['status'];
          $('#publish_' + id).parent().removeClass('btn-warning');
          $('#publish_' + id).parent().addClass('btn-success');
          $('#publish_' + id).removeAttr('class');
          $('#publish_' + id).attr('class', 'glyphicon glyphicon-eye-open');
        } else {
          $('#publish_' + id).parent()['0'].dataset.status = msg['status'];
          $('#publish_' + id).parent().removeClass('btn-success');
          $('#publish_' + id).parent().addClass('btn-warning');
          $('#publish_' + id).removeAttr('class');
          $('#publish_' + id).attr('class', 'glyphicon glyphicon-eye-close');
        }
    });
  });

});
  </script>
