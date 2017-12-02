<!-- CONTAINER -->
         <!-- <div class="container p-140-cont">
            <div class="row"> -->
              
          @foreach ($page_articles as $article)
            <!-- CONTENT -->
            <div class="col-sm-8 blog-main-posts">
          
              <!-- Post Item carousel -->
              <div class="wow fadeIn pb-90" >
                  
                <!-- CAOUSEL  -->
                <div class="owl-plugin fullwidth-slider owl-carousel owl-bg-black owl-pag-2 owl-arrows-bg post-prev-img" >
                
                  <!-- ITEM -->  
                  @foreach ($article->medias as $media)
                  <?php $path = '/storage/'.$media->storage.'/'.$media->file_name.'.'.$media->extension; ?> 
                  <div class="item m-0">  
                    <div>
                      <img alt="about us" src="{{$path}}">
                    </div>
                  </div>
                  @endforeach
                  
                  
                </div>
                  
                <div class="post-prev-title">
                  <h3 class="post-title-big"><a href="{{$page->url_en . "/" .$article->url_en}}">{{$article->title_en}}</a></h3>
                </div>
                  
                <div class="post-prev-info">
                  {{$article->created_at}}<span class="slash-divider">/</span>{{$article->author_en}}<span class="slash-divider">/</span> {{$article->subtitle_en}}
                </div>
                  
                <div class="mb-30">
                  {!!$article->content_en!!}
                </div>
                  
                <div class="post-prev-more-cont clearfix">
                 
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


            @if (count($page_articles) == 1)
              <!-- SIDEBAR -->
            <div class="col-sm-4 col-md-3 col-md-offset-1">
              <!-- WIDGET -->
              <div class="widget">
                
                <h5 class="widget-title2">Posts</h5>
                
                <div class="widget-body">
                  <ul class="clearlist widget-menu font-poppins">
                    @foreach ($page->articles as $post)
                    <li>
                      <a href="/{{$page->url_en.'/'.$post->url_en}}" title="">{{$post->title_en}}</a>
                    </li>
                    @endforeach
                  </ul>
                </div>
                
              </div>  
            </div>
            @endif

            @endforeach

            
          <!-- </div>
          </div> -->