<?php
$locale = app()->getLocale();
$title = 'title_' . $locale;
$article_title = $article->$title;
?>
<body>
<h3><strong style="color:black;font-family: 'Times New Roman';">{{ $article_title }}</strong></h3>
<form action="{{route('article.update', ['id' => $article->id])}}" method="post">
    {{csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="posted" class="col-md-6 control-label">{{trans('translate.posted')}}</label>
                <div class="col-md-6">
                    <input type='text' class='form-control' name='date_posted' id='posted' value="{{ $article->date_posted }}">
                </div>
            </div>
            <div class="form-group">
                <label for="online" class="col-md-6 control-label">{{trans('translate.online')}}</label>
                <div class="col-md-6">
                    <input type='text' class='form-control' id='online' name='start_date' value="{{ $article->start_date }}">
                </div>
            </div>
            <div class="form-group">
                <label for="view" class="col-md-6 control-label">{{trans('translate.view')}}</label>
                <div class="col-md-6">
                    <select class="form-control" id="view" name='view'>
                        <?php
                        for ($i = 1; $i < 5; $i++) {
                            echo ' <option value=" ' . $i . '">' . $i . '</option> ';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div> <!-- end first row -->
        <div class="col-md-offset-1 col-md-5">
            <?php
                if ($article->archive == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
            ?>
            <div class="form-group row">
                <label for="nav" class="col-md-6 control-label">{{ trans('translate.archive') }}</label>
                <div class="col-md-1">
                    <input type="checkbox" id="archive" name="archive" {{$checked}}>
                </div>
            </div>

            <?php
                if ($article->sharethis == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
            ?>
            <div class="form-group row">
                <label for="articles_nav" class="col-md-6 control-label">{{trans('translate.share_this')}}</label>
                <div class="col-md-1">
                    <input type="checkbox" id="share" name="sharethis" {{$checked}}>
                </div>
            </div>
        </div>
    </div><!-- end of row -->

    <?php $languages = CMS\admin\Language::getLanguages(); ?>

    <!-- OLD TAB -->

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

                    <div class="form-group col-md-12">
                        <label for="title_{{$language->code}}" class="col-md-2 control-label">{{trans('translate.title')}}: </label>
                        <div class="col-md-10">
                            <input type='text' id="title_{{$language->code}}" name="title_{{$language->code}}" class='form-control' value='{{ $article_title }}'>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="subtitle_{{$language->code}}" class="col-md-2 control-label">{{trans('translate.subtitle')}}: </label>
                        <div class="col-md-10">
                            <input type='text' id="subtitle_{{$language->code}}" name="subtitle_{{$language->code}}" class='form-control' value='{{$article_subtitle}}'>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="author_{{$language->code}}" class="col-md-2 control-label">{{trans('translate.author')}}: </label>
                        <div class="col-md-10">
                            <input type='text' id="author_{{$language->code}}" name="author_{{$language->code}}" class='form-control' value='{{ $article_author }} '>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="url_{{$language->code}}" class="col-md-2 control-label">URL auto: <input type="checkbox" name="auto_{{$language->code}}" id="auto_{{$language->code}}" /></label>
                        <div class="col-md-10">
                            <input type='text' id='url_{{$language->code}}' name='url_{{$language->code}}' class='form-control' value='{{ $article_url }}'>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="title_{{$language->code}}" class="col-md-2 control-label">Content: </label>
                        <div class="col-md-10">
                            <?php
                            $content = 'content_' . $language->code;
                            $article_content = $article->$content;
                            ?>
                            <div id='cke_editor'>
                                <textarea name="content_{{$language->code }}" id="content_{{ $language->code }}" name="content_{{ $language->code }}" rows="10" cols="80">
                                {!! $article_content !!}
                                </textarea>

                                <script>
                                    CKEDITOR.replace('content_{{ $language->code }}');
                                </script>
                            </div>
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
</body>
<script>
    $(function () {

        $("#posted").datepicker({
            dateFormat: 'yyyy-mm-dd',
            weekStart: 1,
            todayHighlight: true
        });

        $("#online").datepicker({
            dateFormat: 'yy-mm-dd',
            weekStart: 1,
            todayHighlight: true
        });

        var token = '{{ Session::token() }}';

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
                    $("#response").html("");
                 }
            });
        });
    });
</script>
