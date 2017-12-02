<div id='ajax-loader'>
    <img src='/images/ajax-loader.gif'/>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Slideshow items</h3>
  </div>
  <div class="panel-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ trans('translate.item') }}</th>
          <th>&nbsp;</th>
          <th>{{ trans('translate.class') }}</th>
          <th>X</th>
          <th>Y</th>
          <th>{{ trans('translate.speed') }}</th>
          <th>{{ trans('translate.start') }}</th>
          <th>{{ trans('translate.endeasing') }}</th>

        </tr>
      </thead>
      @if (count($items) >= 1)
          @foreach ($items as $item)
          <tbody>
            <tr>
              <td>{{ $item->text_en }}</td>
              <td>
                <span class="banner_btn item_edit btn btn-default btn-xs" data-id="{{ $item->id }}" data-id_slideshow="{{ $slideshow_image_id }}">
                                    <span class="glyphicon glyphicon-edit"></span>
                </span>
                <span title="Duplicate Item" class="banner_btn duplicate_item btn btn-primary btn-xs" data-id_item="{{ $item->id }}">
                                    <span class="glyphicon glyphicon-duplicate"></span>
                </span>
                <span class="banner_btn btn btn-danger btn-xs" title="Delete item"  data-id_item="{{ $item->id }}" data-toggle="modal" data-target="#delete_modal">
                                    <span class="glyphicon glyphicon-trash"></span>
                </span>
                @if ($item->online == 1)
                <span class="banner_btn publish_item btn btn-success btn-xs" data-id_item="{{ $item->id }}" data-status="{{ $item->online }}">
                    <span id="publish_item_{{ $item->id }}" class="glyphicon glyphicon-eye-open"></span>
                </span>
                  @else
                    <span class="banner_btn publish_item btn btn-warning btn-xs" data-id_item="{{ $item->id }}" data-status="{{ $item->online }}">
                        <span id="publish_item_{{ $item->id }}" class="glyphicon glyphicon-eye-close"></span>
                    </span>
                  @endif

              </td>
              <td>
                <a href="#" class="editable_class" data-name="class" data-value="very_big_white" data-type="select" data-pk="{{ $item->id }}" data-url="{{ route('slide.item.editable') }}" data-title="Class">{{ $item->class }}</a>
              </td>
              <td>
                <a href="#" class="editable" data-name="x" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('slide.item.editable') }}" data-title="Update speed">{{ $item->x }}</a>
              </td>
              <td>
                <a href="#" class="editable" data-name="y" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('slide.item.editable') }}" data-title="Update speed">{{ $item->y }}</a>
              </td>
              <td>
                <a href="#" class="editable" data-name="speed" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('slide.item.editable') }}" data-title="Update speed">{{ $item->speed }}</a>
              </td>
              <td>
                <a href="#" class="editable" data-name="start" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('slide.item.editable') }}" data-title="Update speed">{{ $item->start }}</a>

              </td>
              <td>
                <a href="#" class="editable_easing" data-name="easing" data-value="Power0.easeIn" data-type="select" data-pk="{{ $item->id }}" data-url="{{ route('slide.item.editable') }}" data-title="Easing">{{ $item->easing }}</a>
              </td>
            </tr>
            <!-- Delete Modal -->
          </tbody>
        @endforeach
      @else
        <tbody>
          <tr style="background: none;">
            <td> {{ trans('translate.no_item_added') }} </td>
          </tr>
        </tbody>
      @endif
    </table>
    <span class="banner_btn new_slide_item btn btn-default" data-id_slide="{{ $slideshow_image_id }}"><span class="glyphicon glyphicon-plus-sign"></span>{{ trans('translate.add_item') }}</span>
  </div>
</div>
{{-- When click on button delete, pass the id of the item --}}
<div class="modal fade delete-modal" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="">{{ trans('delete') }}</h4>
      </div>
      <div class="modal-body">
        {{ trans('translate.do_you_want_to_delete_element') }}</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.close') }}</button>
        <button type="button" class="btn btn-primary delete_item" >{{ trans('translate.delete') }}</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">



  $(function() {
    var token = '{{ Session::token() }}';

    $('.editable').editable({
      ajaxOptions: {
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        // dataType: 'json' //assuming json response
       },
    });

     $(".editable_class").editable({
       ajaxOptions: {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          // dataType: 'json' //assuming json response
       },
       <?php $classes = app()->config->get('slider_rev.slideshow_div_classes'); ?>
       value: 'very_big_white',
         source: [
                <?php foreach ($classes as $key => $class) { ?>
                  {value: '{{ $key }}', text: '{{ $class }}'},
                <?php } ?>

            ]
     });

     $(".editable_easing").editable({
       ajaxOptions: {
         headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        // dataType: 'json' //assuming json response
       },
       <?php $eases = app()->config->get('slider_rev.slideshow_easing_options'); ?>
       value: 'Bounce.easeIn',
         source: [
              <?php foreach ($eases as $key => $ease) { ?>
               {value: '{{ $key }}', text: '{{ $ease }}'},
               <?php  } ?>
            ]
     });

     $('.new_slide_item').on('click', function() {
       var slideshow_id = $(this).attr('data-id_slide');
       //$('#ajax-loader').show();
       $('#colTwo').load('{{ route('new.image.item') }}', {
         id: slideshow_id,
          _token: token
       }, function(responseText) {
        //  $('#ajax-loader').hide();
       });
     });

     $(document).on('click', '.publish_item', function(event) {
       event.preventDefault();
       var id = $(this).attr('data-id_item');
       var status = $(this).attr('data-status');
       $.ajax({
         method: 'POST',
         url: '{{ route('slide.image.item.publish') }}',
         data: {
           id: id,
           status: status,
           _token: token
         }
       }).done(function(msg) {
         //console.log(msg);
           if (status == 0) {
             $('#publish_item_' + id).parent()['0'].dataset.status = msg['status'];
             $('#publish_item_' + id).parent().removeClass('btn-warning');
             $('#publish_item_' + id).parent().addClass('btn-success');
             $('#publish_item_' + id).removeAttr('class');
             $('#publish_item_' + id).attr('class', 'glyphicon glyphicon-eye-open');
           } else {
             $('#publish_item_' + id).parent()['0'].dataset.status = msg['status'];
             $('#publish_item_' + id).parent().removeClass('btn-success');
             $('#publish_item_' + id).parent().addClass('btn-warning');
             $('#publish_item_' + id).removeAttr('class');
             $('#publish_item_' + id).attr('class', 'glyphicon glyphicon-eye-close');
           }
       });
     });

     $('#delete_modal').on('show.bs.modal', function (event) {
          var id = $(event.relatedTarget).data('id_item');
          $('#delete_modal .modal-footer .delete_item').attr('data-delete_item_id', id);
     });

     $('.delete_item').on('click', function(event) {
         event.preventDefault();
          /* ?????? $(this).data(delete_item_id) always the first clicked id ???????? */
          var item_id = $(this).attr('data-delete_item_id');

                      /* ajax megvalositas */
          // $.ajax({
          //     method: 'POST',
          //     url: '{{ route('delete.image.item') }}',
          //     data: {
          //       id: item_id, _token: token
          //     }
          // }).done(function(msg) {
          //   if (msg['message'] == 'success') {
          //     var slideshow_id = msg['slide_id'];
          //     $('#colTwo').load('{{ route('get.slide.item') }}', {image: slideshow_id, _token:token});
          //   }
          // });
          // $('#delete_modal').modal('hide');
          // $(".modal-backdrop").remove();
                      /* .load megvalositas */
          $('#colTwo').load('{{ route('delete.image.item') }}' , {
              id: item_id,
              _token: token
          }, function() {
                  $('#delete_modal').modal('hide');
                  $(".modal-backdrop").remove();
              });
          });

          $('.item_edit').on('click', function() {
              var id = $(this).data('id');
              $('#colTwo').load('{{ route('get.item.properties') }}', {id: id, _token: token});
          });

  });
</script>
