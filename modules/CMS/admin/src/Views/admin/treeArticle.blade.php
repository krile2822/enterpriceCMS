<?php
$locale = app()->getLocale();
$article_views = app()->config->get('theme.article_views');
$title = 'title_' . $locale;
$article_title = $article->$title;
?>
<body>
<form action="{{route('article.update', ['id' => $article->id])}}" method="post">
    {{csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">

        <div class="box">
            <div class="box-header with-border" >
              <h3 class="box-title"><strong>{{ $article_title }}</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table>
                <tbody>
                <tr>
                  <td style="width: 25%">
                      <label for="posted" class="control-label">{{trans('translate.posted')}}</label>
                  </td>
                  <td style="width: 25%">

                    <input type='text' class='form-control' name='date_posted' id='posted' value="{{ $article->date_posted }}">

                  </td>
                  <td style="width: 25%" class="col-md-2">
                      <?php
                          if ($article->archive == 1) {
                              $checked = 'checked';
                          } else {
                              $checked = '';
                          }
                      ?>
                      <label for="nav" class="control-label">{{ trans('translate.archive') }}</label>
                  </td>
                  <td style="width: 25%">
                      <input type="checkbox" id="archive" name="archive" {{$checked}}>
                  </td>
                </tr>
                <tr>
                  <td><label for="online" class="col-md-8 control-label">{{trans('translate.online')}}</label></td>
                  <td>
                  <div class="col-md-8">
                  <input type='text' class='form-control' id='online' name='start_date' value="{{ $article->start_date }}">
                  </div></td>
                  <td>
                   <label for="articles_nav" class="col-md-8 control-label">{{trans('translate.share_this')}}</label>
                  </td>
                  <?php
                if ($article->sharethis == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
            ?>
                  <td><div class="col-md-2"><input type="checkbox" id="share" name="sharethis" {{$checked}}></div></td>
                </tr>
                <tr>
                  <td> <label for="view" class="col-md-8 control-label">{{trans('translate.view')}}</label></td>
                  <td>
                  <div class="col-md-8">
                  <select class="form-control" id="view" name='view'>
                        @foreach ($article_views as $view)
                            <option value="{{$view}}">{{$view}}</option>
                        @endforeach
                    </select>
                </div>
                    </td>

                </tr>

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <?php $languages = CMS\admin\Language::getLanguages(); ?>

    <!-- OLD TAB -->

        <?php $languages = CMS\admin\Language::getLanguages(); ?>
    <div class="content">
        <ul class="nav nav-tabs">
            @foreach ($languages as $language)
            @if ($language->code == $locale)
            <li class="active"><a data-toggle="tab" href="#{{ $language->code }}"> {{ $language->name }}</a></li>
            @else
            <li><a data-toggle="tab" href="#{{ $language->code }}"> {{ $language->name }}</a></li>
            @endif
            @endforeach
            <li style="float:right"><a data-toggle="tab" href="#files"><i class="fa fa-paperclip"></i>  Files</a></li>
        </ul>

        <div class="tab-content">

            <div id="files" class="content tab-pane fade">

                    @include ('admin::admin.FineUpload.upload-form')

            </div>

            @foreach ($languages as $language)
            @if ($language->code == $locale)
            <div id="{{ $language->code }}" class="content tab-pane fade in active" >
                @else
                <div id="{{ $language->code }}" class="content tab-pane fade">
                    @endif

                    <?php
                    $title = 'title_' . $language->code;
                    $article_title = $article->$title;

                    $subtitle = 'subtitle_' . $language->code;
                    $article_subtitle = $article->$subtitle;

                    $author = 'author_' . $language->code;
                    $article_author = $article->$author;

                    $url = 'url_' . $language->code;
                    $article_url = $article->$url;
                    ?>

                    <div class="form-group col-md-offset-1 col-md-10" style="text-align: right;">
                        <label for="title_{{$language->code}}" class="col-md-3 control-label">{{trans('translate.title')}}: </label>
                        <div class="col-md-7">
                            <input type='text' id="title_{{$language->code}}" name="title_{{$language->code}}" class='form-control' value='{{ $article_title }}'>
                        </div>
                    </div>
                    <div class="form-group col-md-offset-1 col-md-10" style="text-align: right;">
                        <label for="subtitle_{{$language->code}}" class="col-md-3 control-label">{{trans('translate.subtitle')}}: </label>
                        <div class="col-md-7">
                            <input type='text' id="subtitle_{{$language->code}}" name="subtitle_{{$language->code}}" class='form-control' value='{{$article_subtitle}}'>
                        </div>
                    </div>
                    <div class="form-group col-md-offset-1 col-md-10" style="text-align: right;">
                        <label for="author_{{$language->code}}" class="col-md-3 control-label">{{trans('translate.author')}}: </label>
                        <div class="col-md-7">
                            <input type='text' id="author_{{$language->code}}" name="author_{{$language->code}}" class='form-control' value='{{ $article_author }} '>
                        </div>
                    </div>
                    <div class="form-group col-md-offset-1 col-md-10" style="text-align: right;">
                        <label for="url_{{$language->code}}" class="col-md-3 control-label">URL auto: <input type="checkbox" name="auto_{{$language->code}}" id="auto_{{$language->code}}" /></label>
                        <div class="col-md-7">
                            <input type='text' id='url_{{$language->code}}' name='url_{{$language->code}}' class='form-control' value='{{ $article_url}}'>
                        </div>
                    </div>
                    <div class="form-group col-md-12">

                            <?php
                            $content = 'content_' . $language->code;
                            $article_content = $article->$content;
                            ?>
                            <div id='cke_editor'>
                                <textarea name="content_{{$language->code }}" id="content_{{ $language->code }}" name="content_{{ $language->code }}" rows="10" cols="80">
                                {!! $article_content !!}
                                </textarea>

                                <script type="text/javascript">
                                    CKEDITOR.replace('content_{{ $language->code }}');
                                </script>
                            </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
<!-- END OF OLD TAB -->

        <div style="clear:both; height:60px;">
            <span style="float:right;margin-right:30px;" >
                <button type='submit' id='update' class='btn btn-primary'> Update </button>
            </span>
             <span style="float:left;margin:10px 35px;" >
                <button type='button' id='delete' data-toggle='modal' data-target='#delete_modal' class='btn btn-danger'> Delete </button>
            </span>
        </div>
</form>
          </div>







<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">Delete</h4>
                </div>
                <div class="modal-body">
                    Are you sure to delete {{$article->$title}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_delete_confirmed" class="btn btn-primary" data-article_id="{{$article->id}}">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancel_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">Modal cancel title</h4>
                </div>
                <div class="modal-body">
                    Cancel confirm
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_cancel_confirmed"  class="btn btn-primary">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- editor modal --}}
    <div class="modal fade" id="edit_file_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit File</h4>
                </div>
                <div class="modal-body">
                    <div id="edit_modal_body"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_file_edit_confirmed"  class="btn btn-primary" data-id="">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of editor modal --}}
</body>
<script>
    $(function () {

        $("#posted").datepicker({
            dateFormat: 'yy-mm-dd',
            weekStart: 1,
            todayHighlight: true
        });

        $("#online").datepicker({
            dateFormat: 'yy-mm-dd',
            weekStart: 1,
            todayHighlight: true
        });

        var token = '{{ Session::token() }}';

        $(document).on('click', '#img', function() {
          var id = $(this).data('id');
          var src = $(this).data('file');

          $("#edit_modal_body").load( "{{ route('get.media.for.edit') }}", {id: id, _token: token} );

        });

        $('#btn_delete_confirmed').on('click', function() {
           var article_id = $(this).data('article_id');
           $.ajax({
               url: "{{ route('article.delete') }}",
               method: "POST",
               data: {id: article_id, parent: "{{$parent_id}}", _token: token}
           }).done(function(msg) {
                if(msg['delete'] == 'success') {
                    $('#delete_modal').modal('hide');
                    $("#tree2").fancytree('getTree').reload();
                    $(".modal-backdrop").remove();
                    $("#response").html("The article removed successfully!");
                 }
            });
        });


    });
</script>
