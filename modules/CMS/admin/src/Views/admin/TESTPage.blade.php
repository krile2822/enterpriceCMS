<?php
$locale = app()->getLocale();
$page_views = app()->config->get('theme.page_views');
$title = 'title_' . $locale;
$page_title = $page->$title;
$all_page = CMS\admin\Page::all();
$page_articles = $page->articles;
?>

<form action="{{route('page.update', ['id' => $page->id])}}" method="post">
{{csrf_field() }}
{{ method_field('PUT') }}
<div class="row">

    <div class="box">
        <div class="box-header with-border" >
          <h3 class="box-title"><strong>{{ $page_title }}</strong></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="row">
            <div class="col-offset-1 col-md-6">
                <div class="form-group">
                    <label for="posted" class="control-label col-md-5">{{trans('translate.parent')}}</label>
                    <div class="col-md-7">
                        <select class="form-control" id="id_parent" name="parent_id">
                            <option value='0'> </option>
                            @foreach ($all_page as $parent)
                            <option value='{{$parent->id}}'> {{ $parent->$title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="view" class="control-label col-md-5">{{trans('translate.view')}}</label>
                    <div class="col-md-7">
                          <select class="form-control" id="view" name="view">
                            @foreach ($page_views as $view)
                              @if ($page->view == $view)
                                <option value="{{$view}}" selected>{{$view}}</<option>
                              @else
                                <option value="{{$view}}">{{$view}}</<option>
                              @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="access_level" class="control-label col-md-5">{{trans('translate.access_group')}}</label>
                    <div class="col-md-7">
                        <select class="form-control" id="hozzaferes">
                          <option>Admin</option>
                          <option>Editor</option>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="article_ordering" class="control-label col-md-5">{{trans('translate.article_ordering')}}</label>
                    <div class="col-md-7">
                        <select class="form-control" id="ordering" name='article_ordering'>
                            <option value='1'>Order</option>
                            <option value='0'>Reverse order</option>
                            <!-- REMOVED FROM REQUEST BECAUSE IT MUST BE BOOLEAN IN THE DATABASE
                            <option>Date ascending</option>
                            <option>Date descending</option>
                            -->
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="article_ordering" class="control-label col-md-5">{{trans('translate.article_ordering')}}</label>
                    <div class="col-md-7">
                       <select class="form-control" id="ordering" name='article_ordering'>
                         <option value='1'>Order</option>
                         <option value='0'>Reverse order</option>
                                         <!-- REMOVED FROM REQUEST BECAUSE IT MUST BE BOOLEAN IN THE DATABASE
                                         <option>Date ascending</option>
                                         <option>Date descending</option>
                                     -->
                                 </select>
                             </div>
                </div>
                <div class="form-group">
                    <label for='per_page' class='control-label col-md-5'>{{trans('translate.per_page')}}</label>
                    <div class="col-md-7">
                       <input type='text' class='form-control' id="per_page" name='per_page' value='{{ $page->per_page }}'>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php if ($page->appears == 1) {  $appears = 'checked';  } else {  $appears = '';  }  ?>
                  <div class="form-group">
                      <label for="nav" class="control-label col-md-7">{{ trans('translate.disp_in_nav') }}</label>
                      <input type="checkbox" id="appears" name="appears" {{$appears}}>
                  </div>
                  <div class="form-group">
                      <?php if ($page->articles_nav == 1) { $articles_nav = 'checked'; } else { $articles_nav = ''; } ?>
                      <label for="articles_nav" class="control-label col-md-7">{{trans('translate.disp_article_in_nav')}}</label>
                      <input type="checkbox" id="articles_nav" name='articles_nav' {{$articles_nav}}>
                  </div>
                  <div class="form-group">
                      <?php if ($page->bc == 1) { $bc = 'checked'; } else { $bc = ''; } ?>
                      <label for="bc" class="control-label col-md-7">{{trans('translate.show_bc')}}</label>
                      <input type="checkbox" id="bc" name='bc' {{$bc}}>
                  </div>
                  <div class="form-group">
                      <?php if ($page->featured ==1 ) { $featured = 'checked'; } else { $featured = ''; } ?>
                      <label for="featured" class="control-label col-md-7">{{trans('translate.featured')}}</label>
                      <input type='checkbox' id="featured" name='featured' {{$featured}}>
                  </div>
                  <div class="form-group">
                      <?php $languages = CMS\admin\Language::getLanguages(); ?>
                      <label for="languages" class="control-label col-md-7">{{trans('translate.content_language')}}</label>
                      <div style='float:left'> <select id='language' name='page_langs' class='form-control'>
                          <?php $lang = $page->page_langs ?>
                          <option value='all'> All </option>
                          @foreach ($languages as $language)
                            @if ($lang == $language->code && $lang != 'all')
                              <option value='{{ $language->code }}' selected>{{ $language->name }}</option>
                            @else
                              <option value='{{ $language->code }}' >{{ $language->name }}</option>
                            @endif
                          @endforeach
                      </select>
                  </div>
                </div>
          </div>
      </div>
</div>

<!-- TAB CONTENT -->

<div class="content">
<ul class="nav nav-tabs">
    @foreach ($languages as $language)
    @if ($language->code == $locale)
    <li class="active"><a data-toggle="tab" href="#{{ $language->code }}"> {{ $language->name }}</a></li>
    @else
    <li><a data-toggle="tab" href="#{{ $language->code }}"> {{ $language->name }}</a></li>
    @endif
    @endforeach
    <li><a data-toggle='tab' href='#meta'> Meta </a></li>
</ul>
<div class="col-md-12">
    <div class="tab-content">

        <div id="meta" class="content tab-pane fade">
            <ul class="nav nav-tabs">
                @foreach ($languages as $language)
                @if ($language->code == $locale)
                <li class="active"><a data-toggle="tab" href="#desc_{{ $language->code }}"> {{ $language->code }}</a></li>
                @else
                <li><a data-toggle="tab" href="#desc_{{ $language->code }}"> {{ $language->code }}</a></li>
                @endif
                @endforeach
            </ul>

            <div class='tab-content'>
                @foreach ($languages as $language)
                @if ($language->code == $locale)
                <div id="desc_{{ $language->code }}" class="content tab-pane fade in active">
                    @else
                    <div id="desc_{{ $language->code }}" class="content tab-pane fade">
                        @endif
                        <div class="form-group col-md-12">
                            <label for="description_{{$language->code}}" class="col-md-2 control-label">Description: </label>
                            <div class="col-md-10">
                                <?php $desc = 'description_' . $language->code; $page_desc = $page->$desc; ?>
                                <input type='text' name="description_{{$language->code}}" id="description_{{$language->code}}" class='form-control' value='{{ $page->$desc}} '>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @foreach ($languages as $language)
            @if ($language->code == $locale)
            <div id="{{ $language->code }}" class="content tab-pane fade in active">
                @else
                <div id="{{ $language->code }}" class="content tab-pane fade">
                    @endif
                    <div class="form-group col-md-12">
                        <label for="title_{{$language->code}}" class="col-md-5 control-label">{{trans('translate.title')}}: </label>
                        <div class="col-md-7">
                            <?php $title = 'title_' . $language->code; $page_title = $page->$title; ?>
                            <input type='text' name="title_{{$language->code}}" id="title_{{$language->code}}" class='form-control' value='{{ $page_title}} '>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="url_{{$language->code}}" class="col-md-5 control-label">URL auto: <input type="checkbox" name="auto_{{$language->code}}" id="auto_{{$language->code}}" /></label>
                        <div class="col-md-7">
                            <?php $url = 'url_' . $language->code; $page_url = $page->$url; ?>
                            <input type='text' id='url_{{$language->code}}' name='url_{{$language->code}}' class='form-control' value='{{$page_url}}'>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div style="clear:both; height:60px;">
        <span style="float:right;margin:10px 0;" >
            <button type='submit' class='btn btn-primary'> Update</button>
        </span>
        <span style="float:left;margin:10px 35px;" >
            <button type='button' id='delete' data-toggle='modal' data-target='#delete_modal' class='btn btn-danger'> Delete </button>
        </span>
    </div>
</form>

</div> <!-- /panel-body -->
</div> <!-- /panel -->

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Delete</h4>
        </div>
        <div class="modal-body">
            Are you sure to delete {{$page->$title}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btn_delete_confirmed" class="btn btn-primary" data-id_page="{{$page->id}}">Delete</button>
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
            <button type="button" id="btn_cancel_confirmed" data-id_page="page_id" class="btn btn-primary">Cancel</button>
        </div>
    </div>
</div>
</div>

<script>

var token = '{{ Session::token() }}';

$('#btn_delete_confirmed').on("click", function(event){
   var id = $(this).data('id_page');
   $.ajax({
    url: "{{ route ('page.delete') }}",
    method: 'POST',
    data: {id: id, _token: token }
}).done(function(msg) {
    if(msg['delete'] == 'success') {
        $('#delete_modal').modal('hide');
        $("#tree2").fancytree('getTree').reload();
        $('.modal-backdrop').remove();
        $('#response').html("The page removed successfully!");
    }
});

});

</script>
