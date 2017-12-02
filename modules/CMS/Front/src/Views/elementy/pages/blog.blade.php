@extends ('front::elementy.master')

@section ('page')
        <!-- PAGE TITLE SMALL -->
        <div class="page-title-cont page-title-small bg-gray">
          <div class="relative container align-left">
            <div class="row">
              
              <div class="col-md-8">
                <h1 class="page-title">Blog</h1>
              </div>
              
              <div class="col-md-4">
                <div class="breadcrumbs font-poppins">
                  <a class="a-inv" href="index.html">home</a><span class="slash-divider">/</span><span class="bread-current">page title small</span>
                </div>
              </div>
              
            </div>
          </div>
        </div>
  <?php ?>

  <div class="container p-140-cont">
    <div class="row">      
        @include('front::elementy.articles.blog-list')
    </div>
  </div>

@endsection