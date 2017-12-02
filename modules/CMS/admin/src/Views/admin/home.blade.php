@extends ('admin::admin.layouts.master')



@section('content')

<?php
  $title = 'title_' . app()->getLocale();
?>

<div class="content">
  <h2>{{ trans('translate.home') }}</h2>
</div>

<section>
  <div class="content">
<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12 ">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ trans('translate.users') }}</span>
              <span class="info-box-number"><?= count($users) ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-file-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ trans('translate.pages') }}</span>
              <span class="info-box-number"><?= count($pages) ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ trans('translate.articles') }}</span>
              <span class="info-box-number"><?= count($articles) ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
                {{ $page_pagination->appends([
                    'pages' => $page_pagination->currentPage(),
                    'articles' => $article_pagination->currentPage()
                  ])->links() }}
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>{{ trans('translate.name_of_page') }}</th>
                    <th>{{ trans('translate.created_by') }}</th>
                    <th>{{ trans('translate.created_at') }}</th>
                    <th>{{ trans('translate.last_update') }}</th>
                  </tr>
                @if (count($pages) > 0 )
                    <?php $i = 0 ;?>
                      @foreach ($page_pagination as $page)
                        <tr>
                          <td>{{ $page->$title }}</td>
                          <?php $user = App\User::findOrFail($page->author_id); ?>
                          <td>{{ $user->name}}</td>
                          <td>{{ $page->created_at }}</td>
                          <td>{{ $page->updated_at }}</td>
                          </tr>
                        <tr>
                     @endforeach
                  @else
                      <tr>
                    <th>{{ trans('translate.no_page_created_yet') }}</th>
                  </tr>
                  @endif
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
               {{ $article_pagination->appends([
                  'articles' => $article_pagination->currentPage(),
                  'pages' => $page_pagination->currentPage()
                ])->links() }}
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>{{ trans('translate.name_of_article') }}</th>
                    <th>{{ trans('translate.created_by') }}</th>
                    <th>{{ trans('translate.created_at') }}</th>
                    <th>{{ trans('translate.last_update') }}</th>
                  </tr>
             @if (count($articles) > 0 )
                <?php $i = 0 ;?>
                @foreach ($article_pagination as $article)
                  <tr>
                    <td>{{ $article->$title }}</td>
                    <?php $user = App\User::findOrFail($article->user_id); ?>
                    <td>{{ $user->name }}</td>
                    <td>{{ $article->created_at }}</td>
                    <td>{{ $article->updated_at }}</td>
                  </tr>
               @endforeach
              @else
                <tr>
                  <th>{{ trans('translate.no_article_created_yet') }}</th>
                </tr>
              @endif
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
      <!-- /.box -->
      </div>
    </div>
  </div>
</section>
			    <!-- /.content -->
@endsection
