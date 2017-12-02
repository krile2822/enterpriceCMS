@extends ('front::elementy.master')

@section ('page')
        <!-- PAGE TITLE SMALL -->
        <div class="page-title-cont page-title-small bg-gray" style="background: url('/elementy/images/bg-services.jpg')">
          <div class="relative container align-left">
            <div class="row">
              
              <div class="col-md-8">
                <h1 class="page-title">{{$page->title_en}}</h1>
              </div>
              
              <!-- <div class="col-md-4">
                <div class="breadcrumbs font-poppins">
                  <a class="a-inv" href="index.html">home</a><span class="slash-divider">/</span><span class="bread-current">page title small</span>
                </div>
              </div> -->
              
            </div>
          </div>
        </div>
  <?php ?>

   @if ($page->module_name)
      
      @foreach ($page_articles as $article)
        
              @if ($article->module == 'theme')
              
                @include ('front::elementy.articles.' . $article->view, ['article' => $article])
              
              @else 
               
                 @include ($article->module  . '::' . $article->view)

              @endif
          
      @endforeach

  @else
  
      @if (count($page_articles) == 1)
      <div class="container p-140-cont">
        <div class="row">      
            @include('front::elementy.articles.' . $page_articles[0]->view)
        </div>
      </div>
      @endif

  @endif
@endsection