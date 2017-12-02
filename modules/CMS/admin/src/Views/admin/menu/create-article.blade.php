<?php
$locale = app()->getLocale();
$article_views = app()->config->get('theme.article_views');
?>
<!-- <div class="content">
    <h3><strong>{{ trans('translate.create_new_article') }}</strong></h3>
</div> -->
<form action="{{ route('article.store')}}" method="post">
    {{csrf_field() }}
    <input type='hidden' name="parent" value='{{$page_id}}'>
    <div class="row panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title" style="font-weight:bold;"> {{ trans('translate.create_new_article') }}</h3>
          </div>
          <div class="panel-body">
        <div class="col-md-5">
             <div class="form-group">
                <label for="posted" class="col-md-6 control-label">{{trans('translate.posted')}}</label>
                <div class="col-md-6">
                    <input type='text' class='form-control' name='start_date' id='posted'>
                </div>
            </div>
            <div class="form-group">
                <label for="online" class="col-md-6 control-label">{{trans('translate.online')}}</label>
                <div class="col-md-6">
                    <input type='text' class='form-control' id='online' name='end_date'>
                </div>
            </div>
            <div class="form-group">
                <label for="view" class="col-md-6 control-label">{{trans('translate.view')}}</label>
                <div class="col-md-6">
                    <select class="form-control" id="view" name='view'>
                       @foreach ($views as $view)
                                    <option value="{{$view->name}}">{{$view->name}}</option>
                                @endforeach
                    </select>
                </div>
            </div>
        </div> <!-- end first row -->
        <div class="col-md-offset-1 col-md-5">
            <div class="form-group row">
                <label for="dsp_nav" class="col-md-6 control-label">{{trans('translate.archive')}}</label>
                <div class="col-md-1">
                    <input type="checkbox" id="archive" name='archive'>
                </div>
            </div>
            <div class="form-group row">
                <label for="dsp_articles_nav" class="col-md-6 control-label">{{trans('translate.share_this')}}</label>
                <div class="col-md-1">
                    <input type="checkbox" name='sharethis' id="share">
                </div>
            </div>
        </div> <!-- /row -->
    </div>
</div>
    <!-- </div> -->
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
        </ul>

        <div class="tab-content">
            @foreach ($languages as $language)
            @if ($language['code'] == $locale)
            <div id="{{ $language['code'] }}" class="content tab-pane fade in active">
                @else
                <div id="{{ $language['code'] }}" class="content tab-pane fade">
                    @endif
                    <div class="form-group col-md-12">
                        <label for="title_{{$language['code']}}" class="col-md-2 control-label">{{trans('translate.title')}}: </label>
                        <div class="col-md-10">
                            <input type='text' id="title_{{$language['code']}}" name="title_{{$language['code']}}" class='form-control'>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="subtitle_{{$language['code']}}" class="col-md-2 control-label">{{trans('translate.subtitle')}}: </label>
                        <div class="col-md-10">
                            <input type='text' id="subtitle_{{$language['code']}}" name="subtitle_{{$language['code']}}" class='form-control'>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="author_{{$language['code']}}" class="col-md-2 control-label">{{trans('translate.author')}}: </label>
                        <div class="col-md-10">
                            <input type='text' id="author_{{$language['code']}}" name="author_{{$language['code']}}" class='form-control'>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="url_{{$language['code']}}" class="col-md-2 control-label">URL auto: <input type="checkbox" name="auto_{{$language['code']}}" id="auto_{{$language['code']}}" /></label>
                        <div class="col-md-10">
                            <input type='text' id='url_{{$language['code']}}' name='url_{{$language['code']}}' class='form-control'>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="title_{{$language['code']}}" class="col-md-2 control-label">{{ trans('translate.content') }}: </label>
                        <div class="col-md-10">
                            <div id='cke_editor'>
                                <textarea name="content_{{$language['code'] }}" id="content_{{ $language['code'] }}" name="content_{{ $language['code'] }}" rows="10" cols="80">
                                </textarea>

                                <script>
                                    CKEDITOR.replace('content_{{ $language['code'] }}');
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div style="clear:both; height:60px;">
            <span style="float:right;margin:10px 0;" >
                <button type='submit' class='btn btn-primary'> {{trans('translate.save')}}</button>
            </span>
        </div>
    </div>
</div>
</form>

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
    });
</script>
