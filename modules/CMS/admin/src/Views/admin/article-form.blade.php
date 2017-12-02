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
    <div class="row panel panel-default">

        <!-- <div class="box">
            <div class="box-header with-border" >
              <h3 class="box-title"><strong>{{ $article_title }}</strong></h3>
            </div> -->
            <div class="panel-heading">
            <h3 class="panel-title" style="font-weight:bold;"> {{ $article_title }} </h3>
          </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="row">
                  <div class='col-md-offset-1 col-md-6'>
                    <div class="form-group">
                          <label for="posted" class="control-label col-sm-4">{{trans('translate.posted')}}</label>
                          <div class="col-sm-6">
                              <input type='text' class='form-control' name='start_date' id='posted' value="{{ $article->start_date }}">
                          </div>
                    </div>
                    <div class="form-group">
                          <label for="online" class="control-label col-sm-4">{{trans('translate.online')}}</label>
                          <div class="col-sm-6">
                              <input type='text' class='form-control' id='online' name='end_date' value="{{ $article->end_date }}">
                          </div>
                    </div>
                    <div class='form-group'>
                        <label for="view" class="control-label col-sm-4">{{trans('translate.view')}}</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="view" name='view'>
                                @foreach ($views as $view)
                                  @if ($article->view == $view->name)
                                    <option value="{{$view->name}}" selected="selected">{{$view->name}}</option>
                                  @else
                                    <option value="{{$view->name}}">{{$view->name}}</option>
                                  @endif
                                @endforeach
                             </select>
                         </div>
                    </div>
                  </div>
                  <div class="col-md-5 ">
                    <?php
                        if ($article->archive == 1) {
                            $checked = 'checked';
                        } else {
                            $checked = '';
                        }
                    ?>
                    <div class='form-group'>
                        <label for="nav" class="control-label col-sm-4">{{ trans('translate.archive') }}</label>
                        <input type="checkbox" id="archive" name="archive" {{$checked}}>
                    </div>
                    <div class="form-group">
                      <label for="articles_nav" class="control-label col-sm-4">{{trans('translate.share_this')}}</label>

                     <?php
                           if ($article->sharethis == 1) {
                               $checked = 'checked';
                           } else {
                               $checked = '';
                           }
                       ?>
                     <input type="checkbox" id="share" name="sharethis" {{$checked}}>
                    </div>
                  </div>
              </div> <!-- end of row-->
            </div>
            <!-- /.box-body -->
            <?php $languages = CMS\admin\Language::getLanguages(); ?>

    <!-- OLD TAB -->

        <?php $languages = CMS\admin\Language::getLanguages(); ?>
    <div class="content">
        <ul class="nav nav-tabs">
            @foreach ($languages as $language)
            @if ($language['code'] == $locale)
            <li class="active"><a data-toggle="tab" href="#{{ $language['code'] }}"> {{ $language['name'] }}</a></li>
            @else
            <li><a data-toggle="tab" href="#{{ $language['code'] }}"> {{ $language['name'] }}</a></li>
            @endif
            @endforeach
            <li style="float:right"><a data-toggle="tab" href="#files"><i class="fa fa-paperclip"></i>  {{ trans('translate.files') }}</a></li>
        </ul>

        <div class="tab-content">

            <div id="files" class="content tab-pane fade">

                    @include ('admin::admin.FineUpload.upload-form')

            </div>

            @foreach ($languages as $language)
            @if ($language['code'] == $locale)
            <div id="{{ $language['code'] }}" class="content tab-pane fade in active" >
                @else
                <div id="{{ $language['code'] }}" class="content tab-pane fade">
                    @endif

                    <?php
                    $title = 'title_' . $language['code'];
                    $article_title = $article->$title;

                    $subtitle = 'subtitle_' . $language['code'];
                    $article_subtitle = $article->$subtitle;

                    $author = 'author_' . $language['code'];
                    $article_author = $article->$author;

                    $url = 'url_' . $language['code'];
                    $article_url = $article->$url;
                    ?>

                    <div class="form-group col-md-offset-1 col-md-10" style="text-align: right;">
                        <label for="title_{{$language['code']}}" class="col-md-3 control-label">{{trans('translate.title')}}: </label>
                        <div class="col-md-7">
                            <input type='text' id="title_{{$language['code']}}" name="title_{{$language['code']}}" class='form-control' value='{{ $article_title }}'>
                        </div>
                    </div>
                    <div class="form-group col-md-offset-1 col-md-10" style="text-align: right;">
                        <label for="subtitle_{{$language['code']}}" class="col-md-3 control-label">{{trans('translate.subtitle')}}: </label>
                        <div class="col-md-7">
                            <input type='text' id="subtitle_{{$language['code']}}" name="subtitle_{{$language['code']}}" class='form-control' value='{{$article_subtitle}}'>
                        </div>
                    </div>
                    <div class="form-group col-md-offset-1 col-md-10" style="text-align: right;">
                        <label for="author_{{$language['code']}}" class="col-md-3 control-label">{{trans('translate.author')}}: </label>
                        <div class="col-md-7">
                            <input type='text' id="author_{{$language['code']}}" name="author_{{$language['code']}}" class='form-control' value='{{ $article_author }} '>
                        </div>
                    </div>
                    <div class="form-group col-md-offset-1 col-md-10" style="text-align: right;">
                        <label for="url_{{$language['code']}}" class="col-md-3 control-label">URL auto: <input type="checkbox" name="auto_{{$language['code']}}" id="auto_{{$language['code']}}" /></label>
                        <div class="col-md-7">
                            <input type='text' id='url_{{$language['code']}}' name='url_{{$language['code']}}' class='form-control' value='{{ $article_url}}'>
                        </div>
                    </div>
                    <div class="form-group col-md-12">

                            <?php
                            $content = 'content_' . $language['code'];
                            $article_content = $article->$content;
                            ?>
                            <div id='cke_editor'>
                                <textarea name="content_{{$language['code'] }}" id="content_{{ $language['code'] }}" name="content_{{ $language['code'] }}" rows="10" cols="80">
                                {!! $article_content !!}
                                </textarea>

                                <script>
                                    CKEDITOR.replace('content_{{ $language['code'] }}');
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
                <button type='submit' id='update' class='btn btn-primary'> {{ trans('translate.update') }} </button>
            </span>
             <span style="float:left;margin:10px 35px;" >
                <button type='button' id='delete' data-toggle='modal' data-target='#delete_modal' class='btn btn-danger'>{{ trans('translate.delete') }}</button>
            </span>
        </div>
</form>
          </div>

{{-- MODALS --}}

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">{{ trans('translate.delete') }}</h4>
                </div>
                <div class="modal-body">
                    {{ trans('tranlate.are_you_sure_to_delete') }} {{$article->$title}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_delete_confirmed" class="btn btn-primary" data-article_id="{{$article->id}}">{{ trans('translate.delete') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="cancel_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
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
    </div> --}}

    {{-- editor modal --}}
    <div class="modal fade" id="edit_file_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ trans('translate.change_file') }}</h4>
                </div>
                <div class="modal-body">
                    <div id="edit_modal_body"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('translate.cancel') }}</button>
                    <button type="button" id="btn_file_edit_confirmed"  class="btn btn-primary" data-id="">{{ trans('translate.save') }}</button>
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
