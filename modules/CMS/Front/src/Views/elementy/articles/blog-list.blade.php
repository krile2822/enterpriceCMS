<!-- CONTAINER -->          
@foreach ($page_articles as $article)
 <?php 
    if (count($article->medias) != 0) 
      $path = '/storage/'.$article->medias[0]->storage.'/'.$article->medias[0]->file_name.'.'.$article->medias[0]->extension; 
 ?>
          <div class='col-sm-8'>

            <!-- CONTENT -->
            <!-- blogpost1 -->
            <div class="col-sm-12 blog-main-posts">
          
              <!-- Post Item carousel -->
              <div class="wow fadeIn pb-90" >
                  
                <!-- CAOUSEL  -->
                <div class="post-prev-img">
                  <a href="{{$page->url_en.'/'.$article->url_en}}"><img src="{{$path}}" alt="img"></a>
                </div>
                  
                <div class="post-prev-title">
                  <h3 class="post-title-big"><a href="{{$page->url_en.'/'.$article->url_en}}">{{$article->title_en}}</a></h3>
                </div>
                  
                <div class="post-prev-info">
                  {{$article->created_at}}<span class="slash-divider">/</span>{{$article->author_en}}<span class="slash-divider">/</span> {{$article->subtitle_en}}
                </div>
                  
                <div class="mb-30">
                  {!!$article->content_en!!}
                </div>
                  
                <div class="post-prev-more-cont clearfix">
                  <div class="post-prev-more left">
                    <a href="blog-single-sidebar-right.html" class="font-poppins">Read More</a>
                  </div>
                  <div class="right" >
                    <a href="blog-single-sidebar-right.html#comments" class="post-prev-count"><span aria-hidden="true" class="icon_comment_alt"></span><span class="icon-count">21</span></a>
                    <a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel" class="post-prev-count"><span aria-hidden="true" class="icon_heart_alt"></span><span class="icon-count">53</span></a>
                    <a href="#" class="post-prev-count dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
                      <span aria-hidden="true" class="social_share"></span>
                    </a>
                    <ul class="social-menu dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="#"><span aria-hidden="true" class="social_facebook"></span></a>
                      </li>
                      <li><a href="#"><span aria-hidden="true" class="social_twitter"></span></a></li>
                      <li><a href="#"><span aria-hidden="true" class="social_dribbble"></span></a></li>
                    </ul>
                  </div>
                </div>
              
              </div>
            </div>
          
        </div>
@endforeach
        <!-- SIDEBAR -->
            <!-- <div class="col-sm-4 col-md-3 col-md-offset-1"> -->
              <!-- WIDGET -->
             <!--  <div class="widget">
                  <form class="form-search widget-search-form" action="page-search-results.html" method="get">
                    <input type="text" name="q" class="input-search-widget" placeholder="Search">
                    <button type="submit" title="Start Search">
                      <span aria-hidden="true" class="icon_search"></span>
                    </button>
                  </form>
                </div>
            </div>
 -->